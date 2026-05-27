<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Penjualan Foto';

    protected function getData(): array
    {
        $activeFilter = $this->filter ?? 'month';

        // Menyiapkan kontainer data kosong
        $labels = [];
        $data = [];

        switch ($activeFilter) {
            case 'today':
                // 📅 MODE PER HARI (Berdasarkan Jam)
                $labels = ['00:00', '06:00', '12:00', '18:00', '23:59'];
                
                // Menarik data transaksi real-time per jam hari ini
                $data = [
                    Transaction::where('status', 'success')->whereDate('created_at', Carbon::today())->whereBetween('created_at', [Carbon::today(), Carbon::today()->addHours(6)])->sum('total_price'),
                    Transaction::where('status', 'success')->whereDate('created_at', Carbon::today())->whereBetween('created_at', [Carbon::today()->addHours(6), Carbon::today()->addHours(12)])->sum('total_price'),
                    Transaction::where('status', 'success')->whereDate('created_at', Carbon::today())->whereBetween('created_at', [Carbon::today()->addHours(12), Carbon::today()->addHours(18)])->sum('total_price'),
                    Transaction::where('status', 'success')->whereDate('created_at', Carbon::today())->whereBetween('created_at', [Carbon::today()->addHours(18), Carbon::today()->endOfDay()])->sum('total_price'),
                ];
                break;

            case 'week':
                // 📅 MODE PER MINGGU (Berdasarkan Nama Hari)
                $labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                
                // Melakukan looping untuk mengambil pendapatan 7 hari ke belakang di minggu ini
                for ($i = 6; $i >= 0; $i--) {
                    $date = Carbon::now()->startOfWeek()->addDays(6 - $i);
                    $data[] = Transaction::where('status', 'success')
                        ->whereDate('created_at', $date)
                        ->sum('total_price');
                }
                break;

            case 'month':
            default:
                // 📅 MODE PER BULAN (Berdasarkan tanggal atau bulan berjalan)
                $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'];
                
                // Mengambil data akumulasi bulanan RunSnap Anda saat ini
                $data = [
                    Transaction::where('status', 'success')->whereMonth('created_at', 1)->whereYear('created_at', 2026)->sum('total_price'),
                    Transaction::where('status', 'success')->whereMonth('created_at', 2)->whereYear('created_at', 2026)->sum('total_price'),
                    Transaction::where('status', 'success')->whereMonth('created_at', 3)->whereYear('created_at', 2026)->sum('total_price'),
                    Transaction::where('status', 'success')->whereMonth('created_at', 4)->whereYear('created_at', 2026)->sum('total_price'),
                    Transaction::where('status', 'success')->whereMonth('created_at', 5)->whereYear('created_at', 2026)->sum('total_price'),
                ];
                break;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Tren Penjualan Foto (Rupiah)',
                    'data' => $data,
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.2)', // Warna hijau transparan agar senada dengan sukses
                    'borderColor' => 'rgb(34, 197, 94)', // Warna hijau solid
                    'tension' => 0.3, // Membuat lengkungan garis grafik menjadi halus/smooth
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
