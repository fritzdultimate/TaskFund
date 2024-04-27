<div class="bg-slate-100 h-full w-full" x-data="realName">
    <div class="flex bg-white py-3 w-full items-center">
        <div class="basis-[10%] absolute">
            <div class="mr-auto" id="returnBack"></div>
        </div>
        <h1 class="text-slate-800 font-semibold text-xl text-center w-full basis-full">
            Detailed Information
        </h1>
        
    </div>


   

    <div class="flex flex-col pt-[50px]">
        <div class="px-[20px]">
            <form x-on:submit.prevent="setRealName" class="flex md:w-[70%] lg:w-[60%] xl:w-[50%] md:pt-[24px] p-[24px] bg-white rounded-[32px] flex-col items-start gap-4 text-slate-500 mx-auto">
                <div class="w-full">
                    <div class="flex flex-col gap-2 md:self-stretch w-full">
                        <label for="realname" class="text-[16px] font-semibold leading-5 text-slate-700">Real Name</label>
                        <input @disabled(auth()->user()->legal_name) @readonly(auth()->user()->legal_name) x-model="realname" type="text" id="realname" name="realname" placeholder="Please Enter A Real Name" aria-label="real_name" aria-invalid="false" autocomplete="disabled" autocorrect="off" autocapitalize="off" class="md:py-[12px] py-1 px-6 rounded-3xl border border-white text-sm bg-[white!important] h-[48px]  ring-1 ring-blue-50 focus:!ring-2 focus:ring-blue-200 outline-none">
                        <p class="text-sm">
                            The name needs to match the name on the bound bank card, otherwise withdrawals cannot be made!
                        </p>
                        {{-- <div class="text-red-600 text-sm">
                            @error('email') <span class="error">{{ $message }}</span> @enderror 
                        </div> --}}
                    </div>
                  
                </div>
    
                <div class="flex gap-4 self-stretch items-start w-full">
                    <button class="h-[48px] flex w-full py-2 px-[24px] justify-center items-center bg-[#4657AD] rounded-3xl text-white font-semibold hover:bg-blue-900" wire:loading.class="bg-blue-500" wire:loading.class.remove="bg-[#4657AD]" wire:loading.attr="disabled">
                        <span class="text-" wire:loading.remove wire:target='setRealName'>
                            Submit
                        </span>
                        <div wire:loading wire:target='setRealName'>
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
        Alpine.data('realName', () => ({
            realname: @entangle('realname'),
            legalName: @js(auth()->user()->legal_name),
            async setRealName(){
                if(this.legalName) return Notiflix.Notify.Failure('Update Failed. Please contact support');

                if(!this.realname || !this.realname.trim()) return Notiflix.Notify.Failure('Please enter name');

                let response = await @this.setRealName();
                
                if(!response || !'message' in response) return;

                if(!response.success) return Notiflix.Notify.Failure(response.message);

                Notiflix.Notify.Success(response.message);

                setTimeout(() => {
                    location.href = "{{ route('personal-information') }}";
                }, 2000);
            },
            init(){
                
            }
        }));
    </script>
   
@endscript
