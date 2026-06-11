<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->label('Nama Event'),
                DatePicker::make('tanggal')
                    ->required(),
                TextInput::make('lokasi'),
                TextInput::make('user_id')
                    ->required()
                    ->label('ID Pembuat')
                    ->numeric(),
                FileUpload::make('banner_image')
                    ->disk('public')
                    ->visibility('public')
                    ->image()
                    ->required()
                    ->label('Gambar Banner'),
                Select::make('is_published')
                    ->label('Status Persetujuan')
                    ->options(['true' => 'Disetujui', 'false' => 'Belum Disetujui / Ditolak'])
                    ->default('false')
                    ->required(),
                \Filament\Forms\Components\Textarea::make('rejection_reason')
                    ->label('Alasan Penolakan')
                    ->helperText('Isi alasan penolakan jika event ditolak, agar fotografer dapat memperbaikinya.')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }
}
