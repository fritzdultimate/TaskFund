<?php

namespace App\Filament\Resources\TaskHallResource\Pages;

use App\Filament\Resources\UserTaskResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserTasks extends ListRecords
{
    protected static string $resource = UserTaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
