<?php

namespace App\Filament\Resources\DeclinedWithdrawalResource\Pages;

use App\Filament\Resources\DeclinedWithdrawalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeclinedWithdrawal extends EditRecord
{
    protected static string $resource = DeclinedWithdrawalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
