<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuspendedUserResource\Pages;
use App\Filament\Resources\SuspendedUserResource\RelationManagers;
use App\Models\SuspendedUser;
use App\Traits\HandleUserResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuspendedUserResource extends Resource
{
    use HandleUserResource;
    protected static ?string $navigationLabel = 'Suspended Users';

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder {
        return parent::getEloquentQuery()->where('is_suspended', true)->latest();
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
            'index' => Pages\ListSuspendedUsers::route('/'),
            'create' => Pages\CreateSuspendedUser::route('/create'),
            'edit' => Pages\EditSuspendedUser::route('/{record}/edit'),
        ];
    }
}
