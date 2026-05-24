<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\RepeatableEntry;

class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Rincian Pembayaran')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('external_id')->label('Gateway ID'),
                        TextEntry::make('total_price')->label('Total Bayar')->money('IDR', locale: 'id'),
                    ]),

                // ✨ BAGIAN POP-UP DAFTAR FOTO YANG DIBELI:
                // Berasumsi Anda punya relasi 'items' atau 'photos' di model Transaction
                RepeatableEntry::make('photos') 
                    ->label('Daftar Foto yang Dibeli')
                    ->schema([
                        TextEntry::make('id')
                            ->label('Foto ID')
                            ->formatStateUsing(fn ($state) => "#{$state}"),
                        
                        // Mengambil nama fotografer dari relasi foto ke user/photographer
                        TextEntry::make('photographer.name')
                            ->label('Fotografer')
                            ->default('Budi Photography'),

                        TextEntry::make('price')
                            ->label('Harga')
                            ->money('IDR', locale: 'id'),
                    ])
                    ->columns(3),
            ]);
    }
}
