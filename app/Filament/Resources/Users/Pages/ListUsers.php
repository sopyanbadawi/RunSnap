<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(), // Menampilkan tombol "New User" di pojok kanan atas
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->label('Semua Pengguna'),
            'pending' => Tab::make('Menunggu Verifikasi')
                ->label('Menunggu Verifikasi')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', 'fotografer')->where('verification_status', 'pending'))
                ->badge(UserResource::getModel()::where('role', 'fotografer')->where('verification_status', 'pending')->count())
                ->badgeColor('warning'),
            'fotografer' => Tab::make('Fotografer')
                ->label('Semua Fotografer')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', 'fotografer')),
            'runner' => Tab::make('Runner')
                ->label('Semua Runner')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', 'runner')),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'fotografer';
    }
}