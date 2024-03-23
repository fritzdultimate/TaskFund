<?php

namespace App\Traits;

use App\Enums\TransactionStatus;
use App\Models\Withdrawal;
use App\Models\Withdrawals;
use App\Services\WithdrawalService;
use Closure;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

trait HandleWithdrawalResource
{

    use RecordUtils;

    public static function getnavigationIcon(): string
    {
        return 'heroicon-o-wallet';
    }



    public static function getModel(): string
    {
        return Withdrawal::class;
    }

    public static function getNavigationGroup(): string
    {
        return 'Withdrawals';
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->count();
    }

    public function handleWithdrawalResourceMount()
    {
        dd(strtolower(static::getModel()));
    }

    public static function handleWithdrawalAction($record, $action)
    {
        $withdrawalService = new WithdrawalService;

        $response = match ($action) {
            'approve' => $withdrawalService->approveWithdrawal($record->id),
            'decline' => $withdrawalService->declineWithdrawal($record->id),
            'delete' => $withdrawalService->deleteWithdrawal($record->id),
        };

        static::showResponse($response);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.username')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('username copied'),
                TextColumn::make('wallet.mainWallet.ticker_symbol')
                    ->label('Wallet'),
                TextColumn::make('wallet.address')
                    ->label('User wallet address')
                    ->copyable()
                    ->copyMessage('User wallet address copied'),
                TextColumn::make('amount')
                    ->searchable()
                    ->money('USD'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => TransactionStatus::getColor($state)),

                TextColumn::make('created_at')
                    ->label('Date'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                ActionGroup::make([
                    ActionGroup::make([
                        Action::make('approve')
                            ->action(
                                fn (Withdrawal $record) =>
                                static::handleWithdrawalAction($record, action: 'approve')
                            )
                            ->color('success')
                            ->visible(fn () => self::shouldBeVisibleIn(['pending', 'process'])),

                        Action::make('decline')
                            ->action(
                                fn (Withdrawal $record) =>
                                static::handleWithdrawalAction($record, action: 'decline')
                            )
                            ->color('warning')
                            ->visible(fn () => self::shouldBeVisibleIn(['pending', 'processing'])),
                    ])->dropdown(false),
                    Action::make('delete')
                        ->action(
                            fn (Withdrawal $record) =>
                            static::handleWithdrawalAction($record, action: 'delete')
                        )
                        ->color('danger')
                        ->requiresConfirmation()
                ])
                    ->label('actions')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size(ActionSize::Small)
                    ->color('success')
                    ->outlined()
                    ->button(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship(name: 'user', titleAttribute: 'username')
                    // ->searchable()
                    // ->preload()
                    ->disabled(true)
                    ->native(false),
                // Select::make('main_wallet_id')
                //     ->relationship(name: 'mainWallet', titleAttribute: 'name')
                //     ->searchable()
                //     ->preload()
                //     ->native(false),
                Select::make('userWallet')
                    ->label('Withdrawal address')
                    ->options(function (Withdrawal $record) {
                        return $record->user->wallets->reduce(function ($carry = [], $value) {
                            $carry[$value->id] = strtoupper($value->mainWallet->symbol) . ' : ' . $value->address;
                            return $carry;
                        });
                    })
                    // ->getOptionLabelUsing(fn ($value): ?string => dd($value))
                    // ->default(fn(Withdrawals $record) => dd($record->id))
                    // ->relationship(name: 'Wallet', titleAttribute: 'name')
                    ->searchable()
                    ->native(false),

                TextInput::make('amount'),
                DateTimePicker::make('created_at')
                    ->label('Withdrawal Date')
            ]);
    }
}
