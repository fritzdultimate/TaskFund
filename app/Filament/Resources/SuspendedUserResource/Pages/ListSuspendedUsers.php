<?php

namespace App\Filament\Resources\SuspendedUserResource\Pages;

use App\Filament\Resources\SuspendedUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuspendedUsers extends ListRecords
{
    protected static string $resource = SuspendedUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
