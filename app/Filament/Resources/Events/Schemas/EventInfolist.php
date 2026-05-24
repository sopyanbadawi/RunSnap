<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Detail Informai Acara')
                    ->columns(1)

                    ->schema([
                        
                                TextEntry::make('name')
                                    ->label('Nama Acara')
                                    ->weight('bold'),
                                TextEntry::make('tanggal')
                                    ->label('Tanggal Pelaksanaan')
                                    ->date('d F Y'),
                                TextEntry::make('lokasi')
                                    ->label('Lokasi')
                                    ->placeholder('-'),
                                TextEntry::make('eo.name')
                                    ->label('Dibuat Oleh/EO'),
                            
                    ]),      
            
                Section::make('Media & Publikasi')
                ->schema([
                    ImageEntry::make('banner_image')
                        ->label('Banner Acara')
                        ->disk('public')
                ])
            ]);

    }
}
