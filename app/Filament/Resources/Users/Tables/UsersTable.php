<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Filters\SelectFilter;
class UsersTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_blocked')
                    ->label('Status Blokir')
                    ->boolean()
                    ->trueIcon('heroicon-o-x-circle')
                    ->falseIcon('heroicon-o-check-circle')
                    ->trueColor('danger')
                    ->falseColor('success'),
                    
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                    
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                    
                TextColumn::make('role')
                    ->label('Peran')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'fotografer' => 'warning',
                        'runner' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('verification_status')
                    ->label('Status Verifikasi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'verified' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                        'unverified' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                    
                TextColumn::make('created_at')
                    ->label('Terdaftar Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Filter Peran')
                    ->options([
                        'runner' => 'Runner',
                        'fotografer' => 'Fotografer',
                        'admin' => 'Admin',
                    ]),
                SelectFilter::make('verification_status')
                    ->label('Status Verifikasi')
                    ->options([
                        'unverified' => 'Belum Verifikasi',
                        'pending' => 'Menunggu Verifikasi',
                        'verified' => 'Terverifikasi',
                        'rejected' => 'Ditolak',
                    ]),
            ])
             ->actions([ 
                 ViewAction::make(),
                 EditAction::make(),

                 \Filament\Tables\Actions\Action::make('verify')
                     ->label('Setujui Verifikasi')
                     ->icon('heroicon-o-check')
                     ->color('success')
                     ->visible(fn ($record) => $record->role === 'fotografer' && $record->verification_status === 'pending')
                     ->requiresConfirmation()
                     ->action(fn ($record) => $record->update(['verification_status' => 'verified'])),
                     
                 \Filament\Tables\Actions\Action::make('reject')
                     ->label('Tolak Verifikasi')
                     ->icon('heroicon-o-x-mark')
                     ->color('danger')
                     ->visible(fn ($record) => $record->role === 'fotografer' && $record->verification_status === 'pending')
                     ->form([
                         \Filament\Forms\Components\Textarea::make('rejection_reason')
                             ->label('Alasan Penolakan')
                             ->required(),
                     ])
                     ->action(fn ($record, array $data) => $record->update([
                         'verification_status' => 'rejected',
                         'rejection_reason' => $data['rejection_reason'],
                     ])),

                 DeleteAction::make(),
             ])
             ->bulkActions([
                 BulkActionGroup::make([
                     DeleteBulkAction::make(),
                 ]),
             ]);
    }
}