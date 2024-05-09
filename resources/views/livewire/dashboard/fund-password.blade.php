<div class="bg-slate-100 h-full w-full" x-data="fundPassword">
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
            Fund Password
        </h1>
        
    </div>


   

    <div class="flex flex-col pt-[50px]">
        <div class="px-[20px]">
            <form x-on:submit.prevent="updateFundPassword" class="flex md:w-[70%] lg:w-[60%] xl:w-[50%] md:pt-[24px] p-[24px] bg-white rounded-[32px] flex-col items-start gap-4 text-slate-500 mx-auto">
                <div class="flex flex-col gap-2 self-stretch">
                    <label for="fund_password" class="text-[14px] font-bold leading-5 text-slate-900">
                        Fund Password
                    </label>
                    
                    <div class="w-full flex flex-row relative rounded-3xl border border-white text-sm bg-[white!important] h-[48px]  ring-1 ring-blue-50 focus-within:!ring-2 focus-within:ring-blue-200 outline-none overflow-hidden" x-data="{visiblePassword: false}">
                        <input id="fund_password" x-model="fund_password" :type="visiblePassword ? 'text' : 'password'" placeholder="Enter your current password" class="basis-[95%] px-6 outline-none border-none">
                        <i x-on:click="visiblePassword = !visiblePassword" :class="visiblePassword ? 'uil-eye' : 'uil-eye-slash'" class="uil h-full  justify-center items-center flex text-sm text-slate-800 font-bold cursor-pointer fill-slate-800 p-2"></i>
                    </div>
                    <div class="text-red-600 text-sm">
                        @error('fund_password')
                            <span class="error">{!! $message !!}</span> 
                        @enderror
                    </div>

                </div>
                               
    
                <div class="flex flex-col gap-2 self-stretch">
                    <label for="fund_password_confirmation" class="text-[14px] font-bold leading-5 text-slate-900">
                        Repeat Fund Password
                    </label>
                    
                    <div class="w-full flex flex-row relative rounded-3xl border border-white text-sm bg-[white!important] h-[48px]  ring-1 ring-blue-50 focus-within:!ring-2 focus-within:ring-blue-200 outline-none overflow-hidden" x-data="{visiblePassword: false}">
                        <input id="fund_password_confirmation" x-model="fund_password_confirmation" :type="visiblePassword ? 'text' : 'password'" placeholder="Repeat new password" class="basis-[95%] px-6 outline-none border-none">
                        <i x-on:click="visiblePassword = !visiblePassword" :class="visiblePassword ? 'uil-eye' : 'uil-eye-slash'" class="uil h-full  justify-center items-center flex text-sm text-slate-800 font-bold cursor-pointer fill-slate-800 p-2"></i>
                    </div>
                    <div class="text-red-600 text-sm">
                        @error('fund_password_confirmation')
                            <span class="error">{!! $message !!}</span> 
                        @enderror
                    </div>

                </div>

                <div class="flex gap-4 self-stretch items-start w-full">
                    <button class="h-[48px] flex w-full py-2 px-[24px] justify-center items-center bg-[#4657AD] rounded-3xl text-white font-semibold hover:bg-blue-900" wire:loading.class="bg-blue-500" wire:loading.class.remove="bg-[#4657AD]" wire:loading.attr="disabled">
                        <span class="text-" wire:loading.remove wire:target='updateFundPassword'>
                            Proceed
                        </span>
                        <div wire:loading wire:target='updateFundPassword'>
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
            fund_password: @entangle('fund_password'),
            password: @entangle('password'),
            fund_password_confirmation: @entangle('fund_password_confirmation'),

            async updateFundPassword(){
                
                let response = await @this.updateFundPassword();
                
                if(!response || !'message' in response) return;

                if(!response.success) return Notiflix.Notify.Failure(response.message);

                Notiflix.Notify.Success(response.message);

                setTimeout(() => {
                        location.href = "{{ route('personal-information') }}";
                }, 2000);

            },
            init(){
                // alert('hey');
               console.log(this.fund_password);
            }
        }));
    </script>
   
@endscript
