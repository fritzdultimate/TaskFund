<?php

namespace App\Filament\Resources;

use App\Enums\TaskStatus;
use App\Filament\Resources\TaskHallResource\Pages;
use App\Filament\Resources\TaskHallResource\RelationManagers;
use App\Models\TaskHall;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
