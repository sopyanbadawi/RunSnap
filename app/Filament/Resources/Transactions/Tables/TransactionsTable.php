<?php

namespace App\Filament\Resources\Transactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Transaction;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(Transaction::with('user')) // Eager load relasi user untuk menghindari N+1
            ->columns([
                TextColumn::make('id')
                    ->label('TX ID')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => "#TX-{$state}"),
                TextColumn::make('user.name')
                    ->label('Nama Pengguna')
                    ->searchable(),
                TextColumn::make('external_id')
                    ->label('EXTERNAL ID/PG')
                    ->copyable(),
                TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                         'completed' => 'success',
                         'pending' => 'warning',
                         'failed' => 'danger',
                         'expired' => 'danger',
                        default => 'primary',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                         'completed' => 'Berhasil',
                         'pending' => 'Proses',
                         'failed' => 'Gagal',
                         'expired' => 'Kedaluwarsa',
                        default => ucfirst($state),
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'completed' => 'Completed',
                        'pending' => 'Pending',
                        'failed' => 'Failed',
                    ]),
            ])
            
            ->actions([
                // Tombol Klik Mata untuk memicu Pop-Up Detail / Modal
                ViewAction::make()
                    ->label('Klik')
                    ->modalHeading('Detail Item Pembelian')
                    ->slideOver(true), // Ubah ke true jika ingin pop-up muncul dari kanan samping
            ]);
    }
}
