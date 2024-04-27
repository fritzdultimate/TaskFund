<div class="bg-slate-100 h-full w-full" x-data="realName">
    <style>
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: initial !important;
        }
    </style>
    <div class="flex bg-white py-3 w-full items-center">
        <div class="basis-[10%] absolute">
            <div class="mr-auto" id="returnBack"></div>
        </div>
        <h1 class="text-slate-800 font-semibold text-xl text-center w-full basis-full">
            Link Bank Account
        </h1>
        
    </div>


   

    <div class="flex flex-col pt-[50px]">
        <div class="px-[20px]">
            <template x-if="isAdd">
                <form x-on:submit.prevent="saveDetails" class="flex md:w-[70%] lg:w-[60%] xl:w-[50%] md:pt-[24px] p-[24px] bg-white rounded-[32px] flex-col items-start gap-4 text-slate-500 mx-auto">
                    <div class="w-full">
                        <div class="flex flex-col gap-2 md:self-stretch w-full">
                            <label for="realname" class="text-[16px] font-semibold leading-5 text-slate-700">Name</label>
                            <input x-model="realname" readonly disabled type="text" id="realname" name="realname" placeholder="Please Enter A Real Name" aria-label="real_name" aria-invalid="false" autocomplete="disabled" autocorrect="off" autocapitalize="off" class="md:py-[12px] py-1 px-6 rounded-3xl border border-white text-sm bg-[white!important] h-[48px]  ring-1 ring-blue-50 focus:!ring-2 focus:ring-blue-200 outline-none disabled:bg-[##f1f5f933]">
                            {{-- <div class="text-red-600 text-sm">
                                @error('email') <span class="error">{{ $message }}</span> @enderror 
                            </div> --}}
                        </div>
                      
                    </div>
                    <div class="w-full">
                        <div class="flex flex-col gap-2 md:self-stretch w-full">
                            <label for="bank" class="text-[16px] font-semibold leading-5 text-slate-700">Bank Name</label>
                            <select id="bank" name="bank" placeholder="Please Enter A Real Name" aria-label="bank" aria-invalid="false" autocomplete="disabled" autocorrect="off" autocapitalize="off" class="md:py-[12px] py-1 px-6 rounded-3xl border border-white text-sm bg-[white!important] h-[48px]  ring-1 ring-blue-50 focus:!ring-2 focus:ring-blue-200 outline-none">
                                <option></option>
                                @foreach ($this->banks as $idx => $bank)
                                    <option value="{{ $bank['code'] }}" data-idx="{{ $idx }}">
                                        {{ $bank['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- <div class="text-red-600 text-sm">
                                @error('email') <span class="error">{{ $message }}</span> @enderror 
                            </div> --}}
                        </div>
                      
                    </div>
                    <div class="w-full">
                        <div class="flex flex-col gap-2 md:self-stretch w-full">
                            <label for="accountNumber" class="text-[16px] font-semibold leading-5 text-slate-700">Account Number</label>
                            <input x-model="accountNumber"  type="text" id="accountNumber" name="accountNumber" placeholder="Please Enter Account Number" aria-label="accountNumber" aria-invalid="false" autocomplete="disabled" autocorrect="off" autocapitalize="off" class="md:py-[12px] py-1 px-6 rounded-3xl border border-white text-sm bg-[white!important] h-[48px]  ring-1 ring-blue-50 focus:!ring-2 focus:ring-blue-200 outline-none">
                            {{-- <div class="text-red-600 text-sm">
                                @error('email') <span class="error">{{ $message }}</span> @enderror 
                            </div> --}}
                        </div>
                      
                    </div>
        
                    <div class="flex gap-4 self-stretch flex-col items-start w-full">
                        <button class="h-[48px] flex w-full py-2 px-[24px] justify-center items-center bg-[#4657AD] rounded-3xl text-white font-semibold hover:bg-blue-900" wire:loading.class="bg-blue-500" wire:loading.class.remove="bg-[#4657AD]" wire:loading.attr="disabled">
                            <span class="text-" wire:loading.remove wire:target='saveDetails'>
                                Proceed
                            </span>
                            <div wire:loading wire:target='saveDetails'>
                                <i class="uil uil-spinner justify-center items-center flex text-sm text-white mr-2 font-bold animate-spin"></i>
                            </div>
                        </button>
                        <button x-on:click="isAdd = false" class="h-[48px] flex w-full py-2 px-[24px] justify-center items-center bg-red-200/20 rounded-3xl text-red-400 font-semibold cursor-pointer">
                            <span class="text-" wire:loading.remove wire:target='saveDetails'>
                                Cancel
                            </span>
                            <div wire:loading wire:target='saveDetails'>
                                <i class="uil uil-spinner justify-center items-center flex text-sm text-white mr-2 font-bold animate-spin"></i>
                            </div>
                        </button>
                    </div>
                </form>
            </template>
            <template x-if="!isAdd">
                <div class="w-96">
                    <div class="relative">

                        @foreach ($this->userBanks as $userBank)
                        <div class="bg-red-100 rounded-xl relative text-white transition-transform transform ">
               
                            <img class="object-cover w-full h-full rounded-xl z-[-1] absolute" src="{{ asset('img/card-bg.png') }}" />
                        
                            <div class="w-full p-5 h-full flex flex-col justify-center">
                                <div class="flex justify-between">
                                    <div class="w-full">
                                        <div class="flex justify-between">
                                            <div class="">
                                                <p class="font-light">
                                                    Name
                                                </h1>
                                                <p class="font-medium tracking-widest">
                                                    {{ $userBank->account_name }}
                                                </p>
                                            </div>
                                            {{-- <img class="w-14 h-14" src="https://i.imgur.com/bbPHJVe.png"/> --}}
                                        </div>
                                        <div class="pt-1">
                                            <p class="font-light">
                                                Card Number
                                            </h1>
                                            <p class="font-medium tracking-more-wider">
                                                {{ $userBank->account_number_masked }}
                                            </p>
                                        </div>
                                        <div class="pt-6 pr-6">
                                            <div class="flex justify-between">
                                                <div class="">
                                                    <p class="font-light text-xs">
                                                        Bank Name
                                                    </h1>
                                                    <p class="font-medium tracking-wider text-sm">
                                                        {{ $userBank->bank_name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                        
                                    </div>
                                </div>
                                
                    
                            </div>
                        </div>   
                        @endforeach
                    </div>
                    <a x-on:click="isAdd = true" class="h-[40px] flex items-center justify-center rounded-3xl bg-green-200/20 cursor-pointer text-sm border border-green-400 text-green-400 capitalize px-5 w-full my-4"> Add New </a>
                </div>
            </template>
        </div>
    </div>
</div>

@push('styles-top')
    <link rel="stylesheet" href="{{ asset('libs/select2.min.css') }}">
    <script defer src="{{ asset('libs/select2.min.js') }}"></script>
@endpush

@script
    <script>
        Alpine.data('realName', () => ({
            isAdd: false,
            initializedSelect2: false,
            fetchBanksError: @entangle('fetchBanksError'),
            realname: @entangle('realname'),
            bankId: @entangle('bankId'),
            bankIdx: @entangle('bankIdx'),
            accountNumber: @entangle('accountNumber'),

            async saveDetails(){
                if(!this.bankId) return Notiflix.Notify.Failure('Please select a bank');
                if(!this.accountNumber) return Notiflix.Notify.Failure('Please enter your bank account number'); 

                let response = await @this.saveDetails();
                
                if(!response || !('message' in response)) return;

                if(!response.success) return Notiflix.Notify.Failure(response.message);

                Notiflix.Notify.Success(response.message);

                setTimeout(() => {
                        location.href = "{{ route('personal-information') }}";
                }, 2000);

            },
            initBanks(){
                $('#bank').select2({
                    placeholder: 'Please select bank',
                    selectionCssClass: '!md:py-[12px] !py-1 !px-6 !rounded-3xl !border !flex !items-center !border-white !text-sm bg-[white!important] !h-[48px] !ring-1 !ring-blue-50 !focus:!ring-2 !focus:ring-blue-200 !outline-none',
                    // dropdownCssClass: '!bg-red-600',
                });
                
                $('#bank').on('select2:select',  (e) => {
                    let data = e.params.data;
                    this.bankId = data.id;
                    this.bankIdx = data.element.dataset.idx;
                });
            },
            init(){
                this.$watch('isAdd', (val) => {
                    this.initBanks();
                    // if(val && !this.initializedSelect2){
                    //     this.initializedSelect2 = true;
                    // }
                });

                if(this.fetchBanksError) {
                    Notiflix.Notify.Failure('Unable to fetch banks due to a temporary connection issue. Give it another shot in a moment!');
                    setTimeout(() => {
                        location.href = "{{ route('personal-information') }}";
                    }, 2000);
                }
                
            }
        }));
    </script>
   
@endscript
