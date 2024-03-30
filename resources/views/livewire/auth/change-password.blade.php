
<main class="flex justify-center items-center h-full min-h-full flex-col w-full my-8">
    <div class="md:w-[490px] w-full flex flex-col justify-center items-center md:p-[32px] pb-3 rounded-2xl md:border-slate-300 md:border" wire:ignore.self>
        <div class="mb-2" id="logo">
            <h1 class="text-[#4657AD] text-2xl font-bold">{{ env('APP_NAME') }}</h1>
        </div>
        <div class="self-stretch flex flex-col px-7 w-full">
            <div class="self-stretch flex flex-col">
                <h1 class="text-slate-800 leading-9 font-bold text-xl">
                    Change Password
                </h1>
                <h2 class="text-sm font-light leading-6 text-slate-600">
                    Not your device? Use a private or incognito window to sign in...
                </h2>
            </div>
            <form wire:submit="submit" class="flex md:w-[400px] md:pt-[24px] pb-2 pt-9 px- flex-col items-start gap-6 text-slate-500">
                <div class="w-full">
                    <div class="flex flex-col gap-2 self-stretch">
                        <div class="flex flex-col gap-2 self-stretch">
                            <label for="password" class="text-[14px] font-bold leading-5 text-slate-900">Password</label>
                            
                            <div class="w-full relative" x-data="{visiblePassword: false}">
                                <input :type="visiblePassword ? 'text' : 'password'" id="password" name="password" placeholder="******" class="rounded-[8px] py-1 border border-white text-sm bg-[white!important] w-full pr-[55px] pl-6" wire:model='password'>
                                <i x-on:click="visiblePassword = !visiblePassword" :class="visiblePassword ? 'uil-eye' : 'uil-eye-slash'" class="uil py-[12px] pr-[24px] justify-center items-center flex text-sm text-slate-800 mr-2 font-bold absolute right-0 top-[-2px] cursor-pointer fill-slate-800"></i>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 self-stretch">
                            <label for="repassword" class="text-[14px] font-bold leading-5 text-slate-900">Re: Password {{ $email }}</label>
                            
                            <div class="w-full relative" x-data="{visiblePassword: false}">
                                <input :type="visiblePassword ? 'text' : 'password'" id="repassword" name="repassword" placeholder="******" class="rounded-[8px] py-1 border border-white text-sm bg-[white!important] w-full pr-[55px] pl-6" wire:model='repassword'>
                                <i x-on:click="visiblePassword = !visiblePassword" :class="visiblePassword ? 'uil-eye' : 'uil-eye-slash'" class="uil py-[12px] pr-[24px] justify-center items-center flex text-sm text-slate-800 mr-2 font-bold absolute right-0 top-[-2px] cursor-pointer fill-slate-800"></i>
                            </div>
                            <div class="text-red-600 text-sm">
                                @if($errorMsg) 
                                    <span class="error">{!! $errorMsg !!}</span> 
                                @endif 
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 self-stretch items-start w-full">
                    <button class="flex w-full py-2 px-[24px] justify-center items-center bg-[#4657AD] rounded-3xl text-white font-semibold hover:bg-blue-900" wire:loading.class="bg-blue-500" wire:loading.class.remove="bg-[#4657AD]" wire:loading.attr="disabled">
                        <span class="text-sm" wire:loading.remove wire:target='submit'>Change Password</span>
                        <div wire:loading wire:target='submit'>
                            <i class="uil uil-spinner justify-center items-center flex text-sm text-white mr-2 font-bold animate-spin"></i>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
