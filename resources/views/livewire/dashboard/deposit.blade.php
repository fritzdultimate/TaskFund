<div class="bg-slate-100 h-full w-full" x-data="deposit">
    <div 
    class="flex bg-white py-3 w-full items-center"
    @if(session()->has('deposit-success'))
        x-init="$wire.dispatch('deposit-success', {{ json_encode(session('deposit-success')) }})"
    @endif
    @if(session()->has('cancelled'))
    x-init="$wire.dispatch('cancelled', {{ json_encode(session('cancelled')) }})"
    @endif
    >
        <div class="basis-[10%]">

            <div class="mr-auto" id="returnBack"></div>
        </div>
        <h1 class="text-slate-800 font-semibold text-xl text-center w-full basis-full">
            Deposit
        </h1>
        <div class="ml-auto px-4 text-xs basis-[10%]">
            History
        </div>
    </div>


   

    <div class="flex flex-col">
        <div class="px-[20px]">

            <div class="text-center flex gap-1 justify-center items-center py-4">
                <div>
                    Balance:
                </div>
                <div class="text-green-500 text-lg font-bold">
                    ₦{{ number_format(auth()->user()->balance, 2) }}
                </div>
            </div>

            <form x-on:submit.prevent="deposit" class="flex md:w-[400px] md:pt-[24px] p-[24px] bg-white rounded-[32px] flex-col items-start gap-4 text-slate-500">
                <div class="w-full">
                    <div class="flex flex-col gap-2 md:self-stretch w-full">
                        <label for="amount" class="text-[16px] font-semibold leading-5 text-slate-700">Amount</label>
                        <input x-model="amount" type="text" id="amount" name="amount" placeholder="Please Enter Deposit Amount" aria-label="amount" aria-invalid="false" autocomplete="disabled" autocorrect="off" autocapitalize="off" class="md:py-[12px] py-1 px-6 rounded-3xl border border-white text-sm bg-[white!important] h-[48px]  ring-1 ring-blue-50 focus:!ring-2 focus:ring-blue-200 outline-none">
                        {{-- <div class="text-red-600 text-sm">
                            @error('email') <span class="error">{{ $message }}</span> @enderror 
                        </div> --}}
                    </div>
                  
                </div>
    
                <div class="flex gap-4 self-stretch items-start w-full">
                    <button class="h-[48px] flex w-full py-2 px-[24px] justify-center items-center bg-[#4657AD] rounded-3xl text-white font-semibold hover:bg-blue-900" wire:loading.class="bg-blue-500" wire:loading.class.remove="bg-[#4657AD]" wire:loading.attr="disabled">
                        <span class="text-" wire:loading.remove wire:target='deposit'>
                            Proceed
                        </span>
                        <div wire:loading wire:target='deposit'>
                            <i class="uil uil-spinner justify-center items-center flex text-sm text-white mr-2 font-bold animate-spin"></i>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@script
    <script>
        Alpine.data('deposit', () => ({
            amount: @entangle('amount'),
            minimumAmount: @js($minimumDepositAmount),
            async deposit(){
                if(!this.amount || !this.amount.trim()) return Notiflix.Notify.Failure('Please enter amount');
                if(+this.amount < +this.minimumAmount) return Notiflix.Notify.Failure('The minimum amount is ₦ ' + this.minimumAmount);
                response = await @this.deposit();

                if(!response || !'message' in response) return;

                if(!response.success) return Notiflix.Notify.Failure(response.message);
            },
            init(){
                @this.on('deposit-success', (response) => {
                    Notiflix.Notify.Success(response.message);
                });

                @this.on('cancelled', (response) => {
                    Notiflix.Notify.Failure(response.message);
                });
            }
        }));
    </script>
   
@endscript
