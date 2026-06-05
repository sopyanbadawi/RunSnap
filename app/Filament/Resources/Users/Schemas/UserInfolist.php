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

            \Filament\Infolists\Components\ImageEntry::make('ktp_image')
                ->label('Foto KTP')
                ->disk('public')
                ->visibility('public')
                ->visible(fn ($record) => $record->role === 'fotografer' && $record->ktp_image),
            
            TextEntry::make('verification_status')
                ->label('Status Verifikasi')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'verified' => 'success',
                    'pending' => 'warning',
                    'rejected' => 'danger',
                    'unverified' => 'gray',
                    default => 'gray',
                })
                ->visible(fn ($record) => $record->role === 'fotografer'),

            TextEntry::make('rejection_reason')
                ->label('Alasan Penolakan')
                ->visible(fn ($record) => $record->role === 'fotografer' && $record->verification_status === 'rejected'),
                
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