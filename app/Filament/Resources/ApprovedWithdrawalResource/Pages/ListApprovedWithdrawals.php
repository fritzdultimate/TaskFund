<?php

namespace App\Filament\Resources\ApprovedWithdrawalResource\Pages;

use App\Filament\Resources\ApprovedWithdrawalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApprovedWithdrawals extends ListRecords
{
    protected static string $resource = ApprovedWithdrawalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
