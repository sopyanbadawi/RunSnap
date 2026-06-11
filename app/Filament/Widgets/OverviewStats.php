<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Photo;

class OverviewStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('TOTAL PENDAPATAN', 'Rp ' . number_format(Transaction::where('status', 'completed')->sum('total_price'), 0, ',', '.'))
                ->description('Total uang kotor masuk')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('KEUNTUNGAN BERSIH', 'Rp ' . number_format(Transaction::where('status', 'completed')->count() * 2500, 0, ',', '.'))
                ->description('Dari biaya layanan')
                ->descriptionIcon('heroicon-m-wallet')
                ->color('warning'),

            Stat::make('TOTAL RUNNERS', User::where('role', 'runner')->count() . ' User')
                ->description('Pelari terdaftar')
                ->descriptionIcon('heroicon-m-user-group'),

            Stat::make('TOTAL FOTO', Photo::count() . ' File')
                ->description('Foto diunggah')
                ->descriptionIcon('heroicon-m-camera'),
                
        ];
    }
}
