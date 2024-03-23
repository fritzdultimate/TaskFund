<?php

namespace App\Filament\Resources\SuspendedUserResource\Pages;

use App\Filament\Resources\SuspendedUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSuspendedUser extends CreateRecord
{
    protected static string $resource = SuspendedUserResource::class;
}
