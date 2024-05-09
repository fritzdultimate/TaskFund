<div class="bg-slate-100 w-full pb-[100px]" x-data="fundPassword">
    <style>
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: initial !important;
        }
        .select2.select2-container{
            width: 100% !important;
        }
    </style>
    <x-dashboard.header
        title="Withdrawal"
    >
        <x-slot:rightLink>
            <a href="{{ route('wallet') }}">
                History
            </a>
        </x-slot:rightLink>
    </x-dashboard.header>


   

    <div class="flex flex-col pt-[50px]">
        <div class="px-[20px]">
            <form x-on:submit.prevent="requestWithdrawal" class="flex md:w-[70%] lg:w-[60%] xl:w-[50%] md:pt-[24px] p-[24px] bg-white rounded-[32px] flex-col items-start gap-4 text-slate-500 mx-auto">
                <div class="w-full">
                    <div>

                        <div class="flex flex-col gap-2 md:self-stretch w-full" wire:ignore>
                            <label for="bank" class="text-[16px] font-semibold leading-5 text-slate-700">Withdrawal Method</label>
                            <select  id="bank" name="bank" placeholder="Please Enter A Real Name" aria-label="bank" aria-invalid="false" autocomplete="disabled" autocorrect="off" autocapitalize="off" class="md:py-[12px] py-1 px-6 rounded-3xl border border-white text-sm bg-[white!important] h-[48px]  ring-1 ring-blue-50 focus:!ring-2 focus:ring-blue-200 outline-none">
                                <option></option>
                                @foreach ($this->banks as $idx => $bank)
                                    <option value="{{ $bank->id }}" data-id="{{ $bank->id }}">
                                        {{ $bank->account_number_masked }} - {{ $bank->bank_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-red-600 text-sm">
                            @error('withdrawalMethodId') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                    </div>
                  
                </div>

                <div class="flex flex-col gap-2 self-stretch">
                    <label for="fundPassword" class="text-[14px] font-bold leading-5 text-slate-900">
                        Withdrawal Amount
                    </label>
                    
                    <div>
                        <ul class="flex flex-wrap gap-2 justify-between items-center" wire:ignore>
                            <template x-for="amount in availableAmounts">
                                <li x-on:click="setAmount" class="border withdrawal-amounts p-2 rounded text-sm font-semibold hover:cursor-pointer" x-text="amount"></li>
                            </template>
                        </ul>
                    </div>
                    <div class="text-red-600 text-sm">
                        @error('withdrawalAmount')
                            <span class="error">{!! $message !!}</span> 
                        @enderror
                    </div>

                </div>
                               
    
                <div class="flex flex-col gap-2 self-stretch">
                    <label for="fundPassword" class="text-[14px] font-bold leading-5 text-slate-900">
                        Enter Fund Password
                    </label>
                    
                    <div class="w-full flex flex-row relative rounded-3xl border border-white text-sm bg-[white!important] h-[48px]  ring-1 ring-blue-50 focus-within:!ring-2 focus-within:ring-blue-200 outline-none overflow-hidden" x-data="{visiblePassword: false}">
                        <input id="fundPassword" x-model="fundPassword" :type="visiblePassword ? 'text' : 'password'" placeholder="Enter fund password" class="basis-[95%] px-6 outline-none border-none">
                        <i x-on:click="visiblePassword = !visiblePassword" :class="visiblePassword ? 'uil-eye' : 'uil-eye-slash'" class="uil h-full  justify-center items-center flex text-sm text-slate-800 font-bold cursor-pointer fill-slate-800 p-2"></i>
                    </div>
                    <div class="text-red-600 text-sm">
                        @error('fundPassword')
                            <span class="error">{!! $message !!}</span> 
                        @enderror
                    </div>

                </div>

                <div class="flex gap-4 self-stretch items-start w-full">
                    <button class="h-[48px] flex w-full py-2 px-[24px] justify-center items-center bg-[#4657AD] rounded-3xl text-white font-semibold hover:bg-blue-900" wire:loading.class="bg-blue-500" wire:loading.class.remove="bg-[#4657AD]" wire:loading.attr="disabled">
                        <span class="text-" wire:loading.remove wire:target='requestWithdrawal'>
                            Proceed
                        </span>
                        <div wire:loading wire:target='requestWithdrawal'>
                            <i class="uil uil-spinner justify-center items-center flex text-sm text-white mr-2 font-bold animate-spin"></i>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles-top')
    <link rel="stylesheet" href="{{ asset('libs/select2.min.css') }}">
    <script defer src="{{ asset('libs/select2.min.js') }}"></script>
@endpush

@script
    <script>
        Alpine.data('fundPassword', () => ({
            availableAmounts : @js($availableAmounts),
            withdrawalAmount: @entangle('withdrawalAmount'),
            fundPassword: @entangle('fundPassword'),
            withdrawalMethodId: @entangle('withdrawalMethodId'),
            userHasLinkedBankAccount : @js($userHasLinkedBankAccount),

           
            async requestWithdrawal(){
                
                // if(!this.withdrawalAmount) re

                let response = await @this.requestWithdrawal();

                
                if(!response || !('message' in response)) return false;
                
    
                if(!response.success) return Notiflix.Notify.Failure(response.message);

                Notiflix.Notify.Success(response.message);

                setTimeout(() => {
                    location.href = "{{ route('wallet', ['type' => 'withdrawal']) }}";
                }, 2000);

            },
            setAmount(){
                let amounts = [... document.querySelectorAll('.withdrawal-amounts')];
                let clickedEl = event.currentTarget;

                let amount = +clickedEl.textContent.trim();

                if(!amount || !this.availableAmounts.includes(+amount)) return Notiflix.Notify.Failure('Invalid withdraw amount');

                this.withdrawalAmount = amount;
                
                amounts.forEach((el) => {
                    return  el == event.currentTarget 
                    ? el.classList.add('active') 
                    : el.classList.remove('active');
                });
            },
            ConfirmBankPopUp(){
                location.href = "{{ route('bank-card') }}";
            },
            cancelBankPopUp(){

            },
            init(){
                if(!this.userHasLinkedBankAccount) {
                    Notiflix.Confirm.Show('Link Bank', 'You have not linked a bank yet. Please link it first', 'Confirm', 'Dismiss', this.ConfirmBankPopUp, this.cancelBankPopUp);
                }
                // alert('hey');
            //    console.log(this.availableAmounts);
            $('#bank').select2({
                    placeholder: 'Please select bank',
                    selectionCssClass: '!md:py-[12px] !py-1 !px-6 !rounded-3xl !border !flex !items-center !border-white !text-sm bg-[white!important] !h-[48px] !ring-1 !ring-blue-50 !focus:!ring-2 !focus:ring-blue-200 !outline-none',
                    // dropdownCssClass: '!bg-red-600',
                });
                
                $('#bank').on('select2:select',  (e) => {
                    let data = e.params.data;
                    console.log(data);
                    this.withdrawalMethodId = data.id;
                    // this.bankIdx = data.element.dataset.idx;
                });
            }
        }));
    </script>
   
@endscript
