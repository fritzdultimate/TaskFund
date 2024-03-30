<?php

namespace App\Filament\Resources;

use App\Enums\TransactionStatus;
use App\Filament\Resources\PendingWithdrawalResource\Pages;
use App\Filament\Resources\PendingWithdrawalResource\RelationManagers;
use App\Models\PendingWithdrawal;
use App\Traits\HandleWithdrawalResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendingWithdrawalResource extends Resource
{
    use HandleWithdrawalResource;
    // protected static ?string $model = PendingWithdrawal::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Pending Withdrawals';
    protected static ?string $modelLabel = 'Pending Withdrawals';



    public static function getEloquentQuery(): Builder {
        return parent::getEloquentQuery()->where('status', TransactionStatus::PENDING)->latest();
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
            'index' => Pages\ListPendingWithdrawals::route('/'),
            'create' => Pages\CreatePendingWithdrawal::route('/create'),
            'edit' => Pages\EditPendingWithdrawal::route('/{record}/edit'),
        ];
    }
}
