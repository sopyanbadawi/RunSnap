<?php

namespace App\Filament\Resources\Events\Pages;

use App\Filament\Resources\Events\EventResource;
use Filament\Resources\Pages\CreateRecord;
use Override;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    #[Override]
    protected function getCreatedNotificationMessage(): ?string
    {
        return 'Event baru berhasil dibuat';
    }

    protected function getRedirectUrl(): string
     {
         return $this->getResource()::getUrl('index');
     }
}
