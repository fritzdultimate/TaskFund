<?php

namespace App\Livewire\Dashboard;

namespace App\Livewire\Dashboard;

use App\Enums\ReferralLevels;
use App\Models\Referral;
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
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('livewire.layouts.dashboard')]
#[Title('Task room for enterpreneurs')]

class Teams extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public $activeTabIdx;
    public $activeLevel;
    public $type;

    public function changeTab($tabIdx){
        $this->activeTabIdx = $tabIdx;
        // dd($this->activeTabIdx);
        $this->activeLevel = $tabIdx == 1 ? null : $tabIdx - 1;

        unset($this->referrals);
    }

    #[Computed]
    public function referrals(){
        return Referral::active()
        ->when($this->activeLevel, fn($query) => $query->where('level', $this->activeLevel));
    }

    public function table(Table $table): Table
    {
        return $table
        ->query($this->referrals)
        ->columns([
            Tables\Columns\TextColumn::make('referred.username')
            ->label('User')
            ->searchable(),
           
             // Tables\Columns\TextColumn::make('referred.total_deposited'),
            Tables\Columns\TextColumn::make('referred.total_deposited')
                ->label('Deposits')
                ->money('NGN')
                ->sortable(),
        
            
                Tables\Columns\TextColumn::make('referred.total_withdrawal')
                    ->label('Withdrawals')
                    ->money('NGN')
                    ->sortable(),

                Tables\Columns\TextColumn::make('referred.total_rebates')
                    ->label('Rebates')
                    ->money('NGN')
                    ->sortable(),
              
                Tables\Columns\TextColumn::make('referred.task_referral_commission')
                    ->label('Commission')
                    ->money('NGN')
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
    
    public function render()
    {
        $tabs = [
            [
                'idx' => 1,
                'label' => 'All'
            ],
            [
                'idx' => 2,
                'label' => 'Level 1'
            ],
            [
                'idx' => 3,
                'label' => 'Level 2'
            ],
            [
                'idx' => 4,
                'label' => 'Level 3'
            ],
        ];

        $this->activeTabIdx = $tabs[0]['idx'];

        return view('livewire.dashboard.teams', [
            'tabs' => $tabs,
            'teamBenefits' => format_currency(auth()->user()->task_referral_commission + auth()->user()->referral_bonus),
        ]);
    }
}
