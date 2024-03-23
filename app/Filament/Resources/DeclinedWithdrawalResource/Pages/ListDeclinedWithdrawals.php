<?php

namespace App\Filament\Resources\DeclinedWithdrawalResource\Pages;

use App\Filament\Resources\DeclinedWithdrawalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDeclinedWithdrawals extends ListRecords
{
    protected static string $resource = DeclinedWithdrawalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
