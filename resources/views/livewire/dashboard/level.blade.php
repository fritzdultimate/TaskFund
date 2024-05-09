<div class="flex flex-col bg-slate-100 w-full min-h-full mb-16 pb-[100px]">
    <x-dashboard.header
        title="Level"
    >
        <x-slot:rightLink>
            {{-- right link --}}        
        </x-slot:rightLink>
    </x-dashboard.header>

    <div class="flex flex-col px-3 pt-5 mb-16">
        @foreach ($this->levels as $level)
            <div class="{{ $level->is_current ? 'bg-[#5362B2]' : 'bg-[#53B2AC]' }} px-3 py-4 flex flex-col rounded-xl mb-3">
                <h3 class="capitalize text-slate-100 font-bold flex justify-center">
                    {{ $level->name }}
                </h3>
                <h4 class="capitalize text-slate-100 font-normal flex justify-center text-xs py-2">Your identity</h4>

                <div>

                    <h5 class="flex text-slate-100 font-normal text-xs">Daily Tasks: {{ $level->daily_tasks }}</h5>
                    <h5 class="flex text-slate-100 font-normal text-xs">Profit per Task: {{ number_format($level->profit_per_task, 2) }}</h5>
                    <h5 class="flex text-slate-100 font-normal text-xs">Price: {{ number_format($level->capital, 2) }}</h5>

                </div>

                @if($level->is_current)

                <div class="flex flex-col items-end w-full text-slate-100 font-normal text-xs">
                    <span>Effective Date</span>
                    <span>2024-01-23-2025</span>
                </div>
                @else
                    <div class="flex flex-col items-end w-full text-slate-300 font-normal text-xs">
                        <button 
                            @disabled($level->id < auth()->user()->level_id) 
                            class="{{  $level->id < auth()->user()->level_id ? 'disabled' : '' }} disabled:opacity-50 bg-white rounded-3xl text-[#53B2AC] font-semibold text-[10px] px-3 py-1"
                        >
                            {{ $level->id > auth()->user()->level_id ? 'Upgrade' : 'Downgrade' }}
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    @include('livewire.partials.footer')
</div>