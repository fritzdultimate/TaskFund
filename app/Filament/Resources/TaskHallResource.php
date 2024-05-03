<?php

namespace App\Filament\Resources;

use App\Enums\TaskStatus;
use App\Filament\Resources\TaskHallResource\Pages;
use App\Filament\Resources\TaskHallResource\RelationManagers;
use App\Models\TaskHall;
use App\Services\TaskService;
use App\Traits\RecordUtils;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class TaskHallResource extends Resource
{
    use RecordUtils;

    protected static ?string $model = TaskHall::class;

    protected static ?string $navigationLabel = 'Submitted Tasks';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // public static function getEloquentQuery(): Builder {
        // return parent::getEloquentQuery()->where('status', TaskStatus::PROCESSING);
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function handleTaskAction ($record, $action) { 
        $taskService = new TaskService;

        $response = match($action) {
            'approve' => $taskService->approveTask($record->id),
            'decline' => $taskService->declineTask($record->id),
            'process' => $taskService->processTask($record->id),
            'delete' => $taskService->deleteTask($record->id),
        };

        static::showResponse($response);
        return null;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.username'),
                TextColumn::make('user.level.name'),
                ImageColumn::make('Task Icon')
                ->state(fn (TaskHall $record) => asset($record->task->type->image)),
                TextColumn::make('task.type.name'),

               
                // TextColumn::make('status'),
                ViewColumn::make('attachments')->view('tables.columns.attachments-list'),
                // ImageColumn::make('attachments')
                // ->checkFileExistence(false)
                //     ->circular()
                //     ->stacked()
                //     ->limit(2)
                //     ->ring(5)
                //     ->limitedRemainingText(size:'lg')
                //     ,
                    
                TextColumn::make('created_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                ActionGroup::make([
                    ActionGroup::make([
                        Action::make('Approve Submission')
                            ->action(fn(TaskHall $record) => 
                                static::handleTaskAction($record, 'approve')
                            )
                            ->color('success')
                            // ->label('')
                            ->requiresConfirmation()
                            ->visible(fn() => self::shouldBeVisibleInTab(['processing']))
                        ,
                        Action::make('Decline Submission')
                            ->action(fn(TaskHall $record) => 
                                // static::declineTask($record)
                                static::handleTaskAction($record, action:'decline')
                            )
                            ->color('warning')
                            ->requiresConfirmation()
                            ->visible(fn() => self::shouldBeVisibleInTab(['processing']))
                            ,
                       
                    ])->dropdown(false),
                    Action::make('Delete Task')
                        ->action(fn(TaskHall $record) => 
                            self::handleTaskAction($record, 'delete')
                        )
                        ->color('danger')
                        ->requiresConfirmation()
                ])
                ->label('actions')
                ->icon('heroicon-m-ellipsis-vertical')
                ->size(ActionSize::Small)
                ->color('primary')
                ->button('primary'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl('');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskHalls::route('/'),
            'create' => Pages\CreateTaskHall::route('/create'),
            'edit' => Pages\EditTaskHall::route('/{record}/edit'),
        ];
    }
}
