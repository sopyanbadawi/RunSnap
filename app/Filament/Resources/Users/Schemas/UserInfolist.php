<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;

class UserInfolist
{
    public static function schema(): array
    {
        return [
            TextEntry::make('name')
                ->label('Nama Lengkap'),
                
            TextEntry::make('email')
                ->label('Email'),
                
            TextEntry::make('role')
                ->label('Peran')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'admin' => 'danger',
                    'fotografer' => 'warning',
                    'runner' => 'success',
                    default => 'gray',
                }),
                
            TextEntry::make('created_at')
                ->label('Terdaftar Pada')
                ->dateTime('d M Y H:i'),
                
            // Hapus tanda miring ganda (//) di bawah ini jika Anda jadi menggunakan fitur Blokir:
            // IconEntry::make('is_blocked')
            //     ->label('Status Blokir')
            //     ->boolean()
            //     ->trueIcon('heroicon-o-x-circle')
            //     ->falseIcon('heroicon-o-check-circle')
            //     ->trueColor('danger')
            //     ->falseColor('success'),
        ];
    }
}