<?php

namespace App\Filament\Resources\SuspendedUserResource\Pages;

use App\Filament\Resources\SuspendedUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSuspendedUser extends EditRecord
{
    protected static string $resource = SuspendedUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
