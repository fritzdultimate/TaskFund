<?php

namespace App\Filament\Resources\DepositResource\Pages;

use App\Enums\TransactionStatus;
use App\Filament\Resources\DepositResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListDeposits extends ListRecords
{
    protected static string $resource = DepositResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'Processing' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', TransactionStatus::PROCESSING)),
            // 'Completed' => Tab::make()
            //     ->modifyQueryUsing(fn (Builder $query) => $query->where('state', TransactionStatus::COMPLETED)),
        ];
    }
}
