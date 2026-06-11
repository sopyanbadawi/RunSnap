<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Transaction;
use Carbon\Carbon;

class AdminProfitChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Keuntungan Bersih (Biaya Layanan)';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $activeFilter = $this->filter ?? 'month';

        $labels = [];
        $data = [];

        switch ($activeFilter) {
            case 'today':
                $labels = ['00:00', '06:00', '12:00', '18:00', '23:59'];
                $data = [
                    Transaction::where('status', 'completed')->whereDate('created_at', Carbon::today())->whereBetween('created_at', [Carbon::today(), Carbon::today()->addHours(6)])->count() * 2500,
                    Transaction::where('status', 'completed')->whereDate('created_at', Carbon::today())->whereBetween('created_at', [Carbon::today()->addHours(6), Carbon::today()->addHours(12)])->count() * 2500,
                    Transaction::where('status', 'completed')->whereDate('created_at', Carbon::today())->whereBetween('created_at', [Carbon::today()->addHours(12), Carbon::today()->addHours(18)])->count() * 2500,
                    Transaction::where('status', 'completed')->whereDate('created_at', Carbon::today())->whereBetween('created_at', [Carbon::today()->addHours(18), Carbon::today()->endOfDay()])->count() * 2500,
                ];
                break;

            case 'week':
                $labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                for ($i = 6; $i >= 0; $i--) {
                    $date = Carbon::now()->startOfWeek()->addDays(6 - $i);
                    $data[] = Transaction::where('status', 'completed')
                        ->whereDate('created_at', $date)
                        ->count() * 2500;
                }
                break;

            case 'month':
            default:
                for ($i = 5; $i >= 0; $i--) {
                    $month = Carbon::now()->startOfMonth()->subMonths($i);
                    $labels[] = $month->translatedFormat('M Y');
                    $data[] = Transaction::where('status', 'completed')
                        ->whereMonth('created_at', $month->month)
                        ->whereYear('created_at', $month->year)
                        ->count() * 2500;
                }
                break;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Keuntungan Bersih Admin (Rp)',
                    'data' => $data,
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(255, 106, 61, 0.2)', // Warna orange brand
                    'borderColor' => 'rgb(255, 106, 61)',
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Hari Ini',
            'week' => 'Minggu Ini',
            'month' => 'Per Bulan',
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
