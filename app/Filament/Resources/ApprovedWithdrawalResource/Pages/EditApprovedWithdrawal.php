<?php

namespace App\Filament\Resources\ApprovedWithdrawalResource\Pages;

use App\Filament\Resources\ApprovedWithdrawalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApprovedWithdrawal extends EditRecord
{
    protected static string $resource = ApprovedWithdrawalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
