<div class="bg-slate-100 w-full min-h-full pb-[100px] font-poppins">
    <style>
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: initial !important;
        }
        .select2.select2-container{
            width: 100% !important;
        }
    </style>
    <x-dashboard.header
        title="Wallet"
    >
        <x-slot:rightLink>
            {{-- right link --}}        
        </x-slot:rightLink>
    </x-dashboard.header>

    <div class="py-5">
        <div class="w-96 m-auto bg-red-100 rounded-xl relative text-white transition-transform transform ">
           
            <img class="object-cover w-full h-full rounded-xl z-[-1] absolute" src="{{ asset('img/card-bg.png') }}" />
        
            <div class="w-full p-10 h-full flex flex-col justify-center">
                <div class="flex justify-between">
                    <div class="w-full">
                        <h4 class="font-medium tracking-widest text-center text-xl md:text-2xl">
                            {{  format_currency(auth()->user()->balance) }}
                        </h4>
                        <p class="text-sm font-light text-center">
                            Balance
                        </p>
                    </div>
                </div>
                
                <div class="pt-6 pr-6 flex justify-center">
                    <div class="flex justify-between gap-4">
                        <div class="">
                            <a href="{{ route('deposit') }}" class="bg-white whitespace-nowrap text-sm rounded-xl px-5 py-2 ring-1 border-blue-500 border-2 ring-white font-poppins  text-blue-950" href="">
                                Deposit
                            </a>
                        </div>
                        <div class="">
                            <a href="{{ route('withdrawal') }}" class="bg-white whitespace-nowrap text-sm rounded-xl px-5 py-2 ring-1 border-blue-500 border-2 ring-white font-poppins  text-blue-950" href="">
                                Withdrawal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="w-full flex py-4" wire:ignore>
        <div class="w-full">
            <div class="relative right-0">
              <nav id="taskTypes" x-ref="taskTypes" class="relative space-x-2 justify-center items-center flex task-types"  role="tablist">
                
                    <button 
                    {{-- x-on:click="changeTab('Deposit')" --}}
                    data-hs-tab="#deposit-records" 
                    {{-- key="{{ strtolower($type->name) }}"  --}}
                    {{-- id="{{ strtolower($type->name) }}"  --}}
                    @class(['active hs-tab-active:bg-[#4657AD] hs-tab-active:text-white bg-white py-1 px-2 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700']) type="button" 
                    role="tab"
                    >
                        <span class="ml-1">Deposit Records</span>
                    </button>

                    <button 
                    {{-- x-on:click="changeTab('Withdrawal')" --}}
                    data-hs-tab="#withdrawal-records" 
                    {{-- key="{{ strtolower($type->name) }}"  --}}
                    {{-- id="{{ strtolower($type->name) }}"  --}}
                    @class(['hs-tab-active:bg-[#4657AD] hs-tab-active:text-white bg-white py-1 px-2 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700']) type="button" 
                    role="tab"
                    >
                        <span class="ml-1">Withdrawal Records</span>
                    </button>
              </nav>
            </div>
          </div> 
    </div>

    <div>
        <div id="deposit-records" role="tabpanel" aria-labelledby="deposit-records" class="p-5">
           
            @forelse ($this->deposits as $deposit)
                <div class="flex flex-col bg-white mb-2 p-5 shadow-sm rounded-md">
                    <div class="flex flex-row justify-between border-b p-2 pb-3">
                        <span class="text-sm">
                            {{ $deposit->date }}
                        </span>
                        <span class="text-sm">
                            {{ $deposit->created_at }}
                        </span>
                    </div>
                    <div class="flex flex-row justify-between p-2">
                        <span class="text-lg font-poppins">
                            {{ $deposit->amount_formatted }}
                        </span>
                        <span class="{{ $deposit->status_color }}">
                            {{ ucfirst($deposit->status) }} Payment
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center">
                    No Records yet
                </div>
            @endforelse
          </div>
          <div id="withdrawal-records" class="hidden p-5" role="tabpanel" aria-labelledby="withdrawal-records">
            
            @forelse($this->withdrawals as $withdrawal)
            <div class="flex flex-col bg-white mb-2 p-5 shadow-sm rounded-md">
                <div class="flex flex-row justify-between border-b p-2 pb-3">
                    <span class="text-sm">
                        {{ $withdrawal->date }}
                    </span>
                    <span class="text-sm">
                        {{ $withdrawal->created_at }}
                    </span>
                </div>
                <div class="flex flex-row justify-between p-2">
                    <span class="text-lg font-poppins">
                        {{ $withdrawal->amount_formatted }}
                    </span>
                    <span class="{{ $withdrawal->status_color }}">
                        {{ ucfirst($withdrawal->status) }} Withdraw
                    </span>
                </div>
            </div>
            @empty
            <div class="text-center">
                No Records yet
            </div>
            @endforelse
          </div>
    </div>

</div>
