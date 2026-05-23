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
                TextInput::make('eo_id')
                    ->required()
                    ->numeric(),
                FileUpload::make('banner_image')
                    ->disk('public')
                    ->visibility('public')
                    ->image()
                    ->required()
                    ->label('Gambar Banner'),
                Select::make('is_published')
                    ->label('Diterbitkan')
                    ->options(['true' => 'Benar', 'false' => 'Salah'])
                    ->default('false')
                    ->required(),
            ]);
    }
}
