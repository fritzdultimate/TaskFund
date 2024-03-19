<?php

namespace App\Filament\Resources\UserTaskResource\Pages;

use App\Filament\Resources\UserTaskResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserTask extends CreateRecord
{
    protected static string $resource = UserTaskResource::class;
}
