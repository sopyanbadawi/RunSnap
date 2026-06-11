<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class PaymentCallbackController extends Controller
{
    public function handle(Request $request)
    {
        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key') ?? env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production') ?? env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        try {
            // Inisialisasi notifikasi dari Midtrans (otomatis membaca php://input)
            $notif = new \Midtrans\Notification();

            $transactionStatus = $notif->transaction_status;
            $type = $notif->payment_type;
            $orderId = $notif->order_id;
            $fraudStatus = $notif->fraud_status;

            // Cari transaksi berdasarkan external_id
            $transaction = Transaction::where('external_id', $orderId)->first();

            if (!$transaction) {
                return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
            }

            // Update status transaksi berdasarkan notifikasi dari Midtrans
            if ($transactionStatus == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraudStatus == 'challenge') {
                        $transaction->update(['status' => 'pending']);
                    } else {
                        $transaction->update(['status' => 'completed']);
                    }
                }
            } else if ($transactionStatus == 'settlement') {
                $transaction->update(['status' => 'completed']);
            } else if ($transactionStatus == 'pending') {
                $transaction->update(['status' => 'pending']);
            } else if ($transactionStatus == 'deny') {
                $transaction->update(['status' => 'failed']);
            } else if ($transactionStatus == 'expire') {
                $transaction->update(['status' => 'expired']);
            } else if ($transactionStatus == 'cancel') {
                $transaction->update(['status' => 'failed']);
            }

            return response()->json(['message' => 'Berhasil memproses Webhook Midtrans', 'status' => $transactionStatus]);

        } catch (\Exception $e) {
            \Log::error('Midtrans Webhook Error: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Error: ' . $e->getMessage()], 500);
        }
    }
}
