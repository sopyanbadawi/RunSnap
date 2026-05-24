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
            ])
             ->actions([ 
                 ViewAction::make(),
                 EditAction::make(),
                 DeleteAction::make(),
             ])
             ->bulkActions([
                 BulkActionGroup::make([
                     DeleteBulkAction::make(),
                 ]),
             ]);
    }
}