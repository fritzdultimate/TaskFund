<main class="flex justify-center items-center h-full min-h-full flex-col w-full my-8">
    <div class="md:w-[490px] w-full flex flex-col justify-center items-center md:p-[32px] pb-3 rounded-2xl md:border-slate-300 md:border" wire:ignore.self>
        <div class="mb-10" id="logo">
            <h1 class="text-blue-800 text-3xl font-bold">{{ env('APP_NAME') }}</h1>
        </div>
        <div class="self-stretch flex flex-col px-7 w-full">
            <div class="self-stretch flex flex-col">
                <h1 class="text-slate-800 leading-9 font-bold text-[28px]">
                    Sign in to {{ env('APP_NAME') }}
                </h1>
                <h2 class="text-[16px] font-light leading-6 text-slate-600">
                    Not your device? Use a private or incognito window to sign in...
                </h2>
            </div>
            <form wire:submit="submit" class="flex md:w-[400px] md:pt-[24px] pb-2 pt-9 px- flex-col items-start gap-6 text-slate-500">
                <div class="w-full">
                    <div class="flex flex-col gap-2 md:self-stretch w-full mb-6">
                        <label for="email" class="text-[14px] font-bold leading-5 text-slate-900">Email</label>
                        <input type="text" id="email" name="Email" placeholder="Your email addressf" aria-label="Email" aria-invalid="false" autocomplete="disabled" autocorrect="off" autocapitalize="off" class="md:py-[12px] py-4 px-6 rounded-[8px] border border-slate-300 text-lg bg-[white!important]" wire:model='email'>
                        <div class="text-red-600 text-sm">
                            @error('email') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 self-stretch">
                        <div class="flex flex-col gap-2 self-stretch">
                            <label for="password" class="text-[14px] font-bold leading-5 text-slate-900">Password</label>
                            <div class="w-full relative" x-data="{visiblePassword: false}">
                                <input :type="visiblePassword ? 'text' : 'password'" id="password" name="password" aria-label="Password" aria-invalid="false" autocomplete="disabled" autocorrect="off" autocapitalize="off" class="rounded-[8px] py-[16px] border border-slate-300 text-lg bg-[white!important] w-full pr-[55px] pl-6" wire:model='password'>
                                <i x-on:click="visiblePassword = !visiblePassword" :class="visiblePassword ? 'uil-eye' : 'uil-eye-slash'" class="uil w-[44px] h-[40px] py-[12px] pr-[24px] justify-center items-center flex text-lg text-slate-800 mr-2 font-bold absolute right-0 top-[12px] cursor-pointer fill-slate-800"></i>
                            </div>
                            <div class="text-red-600 text-sm">
                                @if($errorMsg) <span class="error">{{ $errorMsg }}</span> @endif 
                            </div>

                        </div>
                    </div>
                </div>

                <div class="flex gap-4 self-stretch items-start w-full">
                    <button class="flex w-full h-[40px] py-[25px] px-[24px] justify-center items-center bg-blue-600 rounded-3xl text-white font-bold hover:bg-blue-500" wire:loading.class="bg-blue-500" wire:loading.class.remove="bg-blue-600" wire:loading.attr="disabled">
                        <span class="" wire:loading.remove wire:target='submit'>Continue</span>
                        <div wire:loading wire:target='submit'>
                            <i class="uil uil-spinner w-[44px] h-[40px] py-[12px] justify-center items-center flex text-2xl text-white mr-2 font-bold animate-spin"></i>
                        </div>
                    </button>
                </div>
                <div class="text-center flex justify-center w-full flex-col" id="" role="presentation">
                    <div class="text-slate-800 font-medium">
                        Don’t have an account?
                        <a href="/auth/sign/up" class="text-blue-600 font-semibold">Sign up</a>
                    </div>
                    <div>
                        <a href="#" class="text-blue-600 font-medium md:text-xs">Privacy policy</a>
                    </div>
                    <div>
                        <a href="#" class="text-blue-600 font-medium md:text-xs">Terms & Conditions</a>
                    </div>
                </div>
                <a href="/auth/forgot-password" class="text-blue-600 font-medium">Forgot password?</a>
            </form>
        </div>
    </div>
</main>
