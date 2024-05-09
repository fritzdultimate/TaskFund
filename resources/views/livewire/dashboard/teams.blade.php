<div key="{{ $activeTabIdx }}" class="bg-slate-100 w-full min-h-full pb-[100px]" x-data="teams">
    <style>
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: initial !important;
        }

        .select2.select2-container {
            width: 100% !important;
        }
    </style>
    <x-dashboard.header title="My Team">
        {{-- <x-slot:rightLink>
            <a href="{{ route('teams') }}">
                Team
            </a>
        </x-slot:rightLink> --}}
    </x-dashboard.header>

    <div style="background: linear-gradient(45deg, #5362b2, #29d)" class=" h-[127px] grid grid-cols-2 text-white">
        <div class="flex items-center flex-col h-full justify-center">
            <h1 class="text-2xl font-poppins">
                {{-- {{ $this->totalLevelTasks }} --}}
                {{ $this->referrals->count() }}
            </h1>
            <div class="flex flex-col">
                <span class="text-sm">
                    Team size
                </span>
                {{-- <span>

                </span> --}}
            </div>
        </div>
        <div class="flex items-center flex-col h-full justify-center">
            <h1 class="text-2xl font-poppins">
                {{ $teamBenefits }}
            </h1>
            <div class="flex flex-col">
                <span class="text-sm">
                    Team Benefits
                </span>
            </div>
        </div>
    </div>

    <div class="w-full flex py-4" wire:ignore>
        <div class="w-full">
            <div class="relative right-0">
                <nav id="taskTypes" x-ref="taskTypes" class="relative space-x-2 justify-center items-center flex task-types"  role="tablist">
                    @foreach ($tabs as $tab)
                        <button 
                        x-on:click="changeTab('{{ strtolower($tab['idx']) }}')"
                        data-hs-tab="#content" 
                        {{-- key="{{ strtolower($status) }}" 
                        id="{{ strtolower($status) }}"  --}}
                        @class(['active' => $activeTabIdx == $tab['idx'], 'hs-tab-active:bg-[#4657AD] hs-tab-active:text-white bg-white py-1 px-4 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700']) type="button" 
                        role="tab"
                        >
                            <span class="ml-1">{{ ucFirst($tab['label']) }}</span>
                        </button>
                    @endforeach
                  </nav>
            </div>
        </div>
    </div>

    <div>
        <div id="content" role="tabpanel" aria-labelledby="content" class="p-5">
           <div>
            {{ $this->table }}
           </div>
        </div>
        <div id="level2-records" class="hidden p-5" role="tabpanel" aria-labelledby="level2-records">
            <div class="flex flex-row justify-between text-slate-600">
                <div class="flex items-center flex-col h-full justify-center">
                    <div class="flex flex-col">
                        <span class="text-xs">
                            Amount Recharged
                        </span> 
                    </div>
                    <h1 class="text-xl font-poppins ">
                        {{-- {{ $level2AmountRecharged }} --}}
                    </h1>
                </div>
                <div class="flex items-center flex-col h-full justify-center">
                    <div class="flex flex-col">
                        <span class="text-xs">
                            Total Recharges
                        </span> 
                    </div>
                    <h1 class="text-xl font-poppins">
                        {{-- {{ $level2RechargeCount }} --}}
                    </h1>
                </div>
            </div>
        </div>
        <div id="level3-records" class="hidden p-5" role="tabpanel" aria-labelledby="level3-records">
            <div class="flex flex-row justify-between text-slate-600">
                <div class="flex items-center flex-col h-full justify-center">
                    <div class="flex flex-col">
                        <span class="text-xs">
                            Amount Recharged
                        </span> 
                    </div>
                    <h1 class="text-xl font-poppins ">
                        {{-- {{ $level3AmountRecharged }} --}}
                    </h1>
                </div>
                <div class="flex items-center flex-col h-full justify-center">
                    <div class="flex flex-col">
                        <span class="text-xs">
                            Total Recharges
                        </span> 
                    </div>
                    <h1 class="text-xl font-poppins ">
                        {{-- {{ $level3RechargeCount }} --}}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    Alpine.data('teams', () => ({
        async changeTab(tabIdx){
            Notiflix.Loading.Dots('', { 'svgColor' : 'aliceblue' });
                       
            let response = await @this.changeTab(tabIdx);

            Notiflix.Loading.Remove();

            $wire.$refresh();
        },
    }));
</script>
@endscript