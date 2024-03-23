<?php

namespace App\Traits;

use App\Filament\Pages\NewsLetter;
use App\Filament\Resources\SuspendedUserResource;
use App\Filament\Resources\UseresourceResource\RelationManagers\WalletsRelationManager;
use App\Filament\Resources\UserResource;
use App\Models\Investment;
use App\Models\User;
use App\Services\InvestmentService;
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
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HandleUserResource {
    
    use RecordUtils;


    public static function getnavigationIcon(): string
        {
            return 'heroicon-o-banknotes';
        }

    public static function getModel(): string
    {
        return User::class;
    }

    public static function getNavigationGroup(): string
    {
        return 'Members';
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->count();
    }

   

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('username'),
                TextInput::make('email'),
                TextInput::make('inviter'),
                TextInput::make('country'),
                TextInput::make('total_invested'),
                TextInput::make('total_earning'),
                TextInput::make('total_commission'),
                TextInput::make('total_withdrawal'),
                // TextInput::make('inviter_code'),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('username')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('balance')
                    ->money('USD'),
                TextColumn::make('total_earning')
                    ->money('USD'),
                TextColumn::make('total_withdrawal')
                    ->money('USD'),
                TextColumn::make('email_verified_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                Action::make('dashboard')
                    ->action(function (User $user) {

                        auth('web')->login($user);

                        session()->put('view_details', [
                            'referrer_page' => self::getUrl(),
                            'user_id' => auth('web')->id(),
                            'admin_id' => auth('admin')->id(),
                        ]);
                        to_route('user.dashboard');
                    }),
                Action::make('send email')
                    ->action(function (User $user) {
                        return redirect(NewsLetter::getUrl(['user_id' => $user->id]));
                    }),
                Action::make('suspend')
                    ->requiresConfirmation()
                    ->action(function(User $user){

                        $user->update(['is_suspended' => true]);

                        Notification::make()
                            ->title('success')
                            ->body('User suspended succesfully')
                            ->icon('heroicon-o-check-circle')
                            ->iconColor('success')
                            ->send();

                            // ->body()
                        // ->delete
                    })
                    ->visible(function(){
                        return self::getUrl() == UserResource::getUrl();
                    }),
                    Action::make('unsuspend')
                    ->requiresConfirmation()
                    ->action(function(User $user){

                        $user->update(['is_suspended' => false]);

                        Notification::make()
                            ->title('success')
                            ->body('User unsuspended succesfully')
                            ->icon('heroicon-o-check-circle')
                            ->iconColor('success')
                            ->send();

                            // ->body()
                        // ->delete
                    })
                    ->visible(function(){
                        return self::getUrl() == SuspendedUserResource::getUrl();
                    }),
                DeleteAction::make()
                    ->requiresConfirmation()
                    ->action(function(User $user){

                        $user->delete();

                        Notification::make()
                            ->title('success')
                            ->body('User deleted succesfully')
                            ->icon('heroicon-o-check-circle')
                            ->iconColor('success')
                            ->send();

                            // ->body()
                        // ->delete
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // WalletsRelationManager::class
        ];
    }
}