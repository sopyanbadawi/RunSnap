<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
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
                                TextEntry::make('rejection_reason')
                                    ->label('Alasan Penolakan')
                                    ->color('danger')
                                    ->visible(fn ($record) => $record->is_published === 'false' && !empty($record->rejection_reason)),
                            
                    ]),      
            
                Section::make('Media & Publikasi')
                ->schema([
                    ImageEntry::make('banner_image')
                        ->label('Banner Acara')
                        ->state(function ($record) {
                            if (! $record->banner_image) {
                                return null;
                            }
                            return asset('storage/' . $record->banner_image);
                        }),

                    RepeatableEntry::make('photos')
                        ->label('Foto-Foto Event')
                        ->schema([
                            ImageEntry::make('watermark_path')
                                ->label('Preview (Watermark)')
                                ->state(function ($record) {
                                    if (!$record) return null;
                                    $path = \Illuminate\Support\Facades\Storage::disk('public')->exists($record->watermark_path)
                                        ? $record->watermark_path
                                        : $record->original_path;
                                    return asset('storage/' . $path);
                                }),
                            ImageEntry::make('original_path')
                                ->label('Foto Asli')
                                ->state(function ($record) {
                                    if (!$record || !$record->original_path) {
                                        return null;
                                    }
                                    return asset('storage/' . $record->original_path);
                                }),
                            TextEntry::make('price')
                                ->label('Harga')
                                ->money('IDR', locale: 'id'),
                            TextEntry::make('is_processed_ai')
                                ->label('Status Deteksi AI')
                                ->badge()
                                ->color(fn ($state): string => $state ? 'success' : 'gray')
                                ->formatStateUsing(fn ($state) => $state ? 'Selesai' : 'Pending'),
                        ])
                        ->columns(4)
                ])
            ]);

    }
}
