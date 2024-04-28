<?php

namespace App\Filament\Resources\TaskHallResource\Pages;

use App\Filament\Resources\TaskHallResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaskHall extends EditRecord
{
    protected static string $resource = TaskHallResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
