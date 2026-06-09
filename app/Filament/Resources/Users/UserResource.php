<?php

namespace App\Filament\Resources\Users;

use App\Models\User;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use App\Filament\Resources\Users\Pages;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Schemas\UserInfolist;
use App\Filament\Resources\Users\Tables\UsersTable;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    // Mengubah ikon di sidebar (opsional)
protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';
    
    // 1. Mengubah teks di menu sidebar kiri
    protected static ?string $navigationLabel = 'Data Pengguna';
    
    // 2. Mengubah judul utama halaman (bentuk jamak)
    protected static ?string $pluralModelLabel = 'Daftar Pengguna';
    
    // 3. Mengubah teks pada tombol tambah (misal: "New Pengguna" menjadi "Tambah Pengguna")
    protected static ?string $modelLabel = 'Pengguna';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('role', 'fotografer')->where('verification_status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('role', 'fotografer')->where('verification_status', 'pending')->exists() ? 'warning' : 'gray';
    }


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema(UserForm::schema());
    }   
    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema(UserInfolist::schema());
    }
    public static function table(Table $table): Table
    {
        return UsersTable::table($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    
}