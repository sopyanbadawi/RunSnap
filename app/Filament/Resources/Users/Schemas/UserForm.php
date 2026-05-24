<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function schema(): array
    {
        return [
            TextInput::make('name')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(255),
                
            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),
                
            TextInput::make('password')
                ->label('Password')
                ->password()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create')
                ->maxLength(255),
                
            Select::make('role')
                ->label('Peran (Role)')
                ->options([
                    'runner' => 'Runner',
                    'fotografer' => 'Fotografer',
                    'admin' => 'Admin',
                ])
                ->required(),
                
            // Hapus tanda miring ganda (//) di bawah ini jika Anda jadi menggunakan fitur Blokir:
            // Toggle::make('is_blocked')
            //     ->label('Blokir Akun Pengguna')
            //     ->onColor('danger')
            //     ->offColor('success'),
        ];
    }
}