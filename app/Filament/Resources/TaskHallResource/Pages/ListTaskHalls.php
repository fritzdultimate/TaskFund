<?php

namespace App\Filament\Resources\TaskHallResource\Pages;

use App\Enums\TaskStatus;
use App\Filament\Resources\TaskHallResource;
use App\Models\TaskHall;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTaskHalls extends ListRecords
{
    protected static string $resource = TaskHallResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Processing' => Tab::make()
            ->badge(TaskHall::query()->where('status', TaskStatus::PROCESSING)->count())
            ->badgeColor('success'),
            'Pending' => Tab::make()
                ->badge(TaskHall::query()->where('status', TaskStatus::PENDING)->count())
                ->badgeColor('success')
                ->modifyQueryUsing(function(Builder $query) {
                    // redirect(ApprovedDepositsResource::getUrl());
                    return $query->where('status', TaskStatus::PENDING);
                }),
            'Completed' => Tab::make()
            ->badge(TaskHall::query()->where('status', TaskStatus::COMPLETED)->count())
            ->badgeColor('success')
                ->modifyQueryUsing(function(Builder $query) {
                    // redirect(DeclinedDepositsResource::getUrl());
                    return $query->where('status', TaskStatus::COMPLETED);
                }),
            'Declined' => Tab::make()
                ->badge(TaskHall::query()->where('status', TaskStatus::DECLINED)->count())
                ->badgeColor('success')
                ->modifyQueryUsing(function(Builder $query) {
                    // redirect(DeclinedDepositsResource::getUrl());
                    return $query->where('status', TaskStatus::DECLINED);
                }),
        ];
    }
}
