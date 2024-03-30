<?php

namespace App\Filament\Resources;

use App\Enums\TransactionStatus;
use App\Filament\Resources\DeclinedWithdrawalResource\Pages;
use App\Filament\Resources\DeclinedWithdrawalResource\RelationManagers;
use App\Models\DeclinedWithdrawal;
use App\Traits\HandleWithdrawalResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeclinedWithdrawalResource extends Resource
{
    use HandleWithdrawalResource;
    // protected static ?string $model = DeclinedWithdrawal::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Declined Withdrawals';
    protected static ?string $modelLabel = 'Declined Withdrawals';

    public static function getEloquentQuery(): Builder {
        return parent::getEloquentQuery()->where('status', TransactionStatus::DECLINED)->latest();
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
            'index' => Pages\ListDeclinedWithdrawals::route('/'),
            'create' => Pages\CreateDeclinedWithdrawal::route('/create'),
            'edit' => Pages\EditDeclinedWithdrawal::route('/{record}/edit'),
        ];
    }
}
