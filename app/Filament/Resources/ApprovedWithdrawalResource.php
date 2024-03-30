<?php

namespace App\Filament\Resources;

use App\Enums\TransactionStatus;
use App\Filament\Resources\ApprovedWithdrawalResource\Pages;
use App\Filament\Resources\ApprovedWithdrawalResource\RelationManagers;
use App\Models\ApprovedWithdrawal;
use App\Traits\HandleWithdrawalResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApprovedWithdrawalResource extends Resource
{
    use HandleWithdrawalResource;

    // protected static ?string $model = ApprovedWithdrawal::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Approved Withdrawals';
    protected static ?string $modelLabel = 'Approved Withdrawals';


    public static function getEloquentQuery(): Builder {
        return parent::getEloquentQuery()->where('status', TransactionStatus::APPROVED)->latest();
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
            'index' => Pages\ListApprovedWithdrawals::route('/'),
            'create' => Pages\CreateApprovedWithdrawal::route('/create'),
            'edit' => Pages\EditApprovedWithdrawal::route('/{record}/edit'),
        ];
    }
}
