<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Event;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(Event::with('eo')) // Eager load relasi EO untuk menghindari N+1
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Acara')
                    ->searchable(),
                TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('lokasi')
                    ->searchable(),
                TextColumn::make('eo.name')
                    ->label('Dibuat Oleh')
                    ->sortable(),
                    ImageColumn::make('banner_image')
                    ->label('Banner')
                    ->state(function ($record) {
                        // Jika kolom database kosong atau berisi null, kembalikan null
                        if (! $record->banner_image) {
                            return null;
                        }
                        return asset('storage/' . $record->banner_image);
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('is_published')
                    ->label('Status Verifikasi')
                    ->badge()
                    ->formatStateUsing(function (string $state, Event $record): string {
                        if ($state === 'true') return 'Approved';
                        return $record->rejection_reason ? 'Rejected' : 'Pending';
                    })
                    ->color(function (string $state, Event $record): string {
                        if ($state === 'true') return 'success';
                        return $record->rejection_reason ? 'danger' : 'warning';
                    }),
            ])
            ->filters([
                \Filament\Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                \Filament\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Event $record) {
                        $record->update(['is_published' => 'true', 'rejection_reason' => null]);
                        \Filament\Notifications\Notification::make()->title('Event disetujui!')->success()->send();
                    })
                    ->visible(fn (Event $record): bool => $record->is_published === 'false'),
                
                \Filament\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        \Filament\Forms\Components\Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required(),
                    ])
                    ->action(function (Event $record, array $data) {
                        $record->update([
                            'is_published' => 'false',
                            'rejection_reason' => $data['rejection_reason'],
                        ]);
                        \Filament\Notifications\Notification::make()->title('Event ditolak!')->danger()->send();
                    })
                    ->visible(fn (Event $record): bool => $record->is_published === 'true' || empty($record->rejection_reason)),
                
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
                \Filament\Actions\RestoreAction::make(),
                \Filament\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                    \Filament\Actions\RestoreBulkAction::make(),
                    \Filament\Actions\ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}
