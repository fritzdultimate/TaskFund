<?php

namespace App\Filament\Resources\PendingWithdrawalResource\Pages;

use App\Filament\Resources\PendingWithdrawalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendingWithdrawal extends EditRecord
{
    protected static string $resource = PendingWithdrawalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
