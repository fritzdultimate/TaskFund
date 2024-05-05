<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListUser extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                Tables\Columns\TextColumn::make('level.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
                Tables\Columns\TextColumn::make('firstname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lastname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('balance')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_earning')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_withdrawal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_suspended')
                    ->boolean(),
                Tables\Columns\TextColumn::make('legal_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('referrer_username')
                    ->searchable(),
                Tables\Columns\TextColumn::make('referral_bonus')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_deposited')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('task_referral_commission')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.dashboard.list-user');
    }
}
