<main class="flex justify-center items-center flex-col w-full my-12">
    <div class="md:w-[490px] w-full flex flex-col justify-center items-center pb-3" wire:ignore.self>
        <div class="mb-3" id="logo">
            <h1 class="text-[#4657AD] text-2xl font-bold">{{ env('APP_NAME') }}</h1>
        </div>
        <div class="self-stretch flex flex-col px-7 w-full">
            <div class="self-stretch flex flex-col items-center">
                <h1 class="text-slate-500 leading-9 font-semibold text-xl">
                    Create account
                </h1>
                <h2 class="text-sm font-normal leading-6 text-slate-600">
                    Fill up the details to create your {{ env('APP_NAME') }} account
                </h2>
            </div>
            <form wire:submit="register" class="flex md:w-[400px] md:pt-[24px] pb-2 pt-9 px- flex-col items-start gap-6 text-slate-500">
                <div class="w-full">
                    <div class="flex flex-col gap-2 md:self-stretch w-full mb-3">
                        <input type="text" id="username" name="username" placeholder="Username" class="md:py-[12px] py-1 px-6 rounded-[8px] border border-white text-lg bg-[white!important]" wire:model='username'>
                        <div class="text-red-600 text-sm">
                            @error('username') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 mb-3 w-full">
                        <div class="flex w-full justify-between">
                            <div class="w-[48%] flex-col gap-2 md:self-stretch mb-3">
                                <input type="text" id="firstname" name="firstname" placeholder="First name" class="md:py-[12px] py-1 px-6 rounded-[8px] border border-white text-lg bg-[white!important] w-full" wire:model='firstname'>
                                <div class="text-red-600 text-sm">
                                    @error('firstname') <span class="error">{{ $message }}</span> @enderror 
                                </div>
                            </div>
                            <div class="w-[48%] flex-col gap-2 md:self-stretch mb-3">
                                <input type="text" id="lastname" name="lastname" placeholder="Last name" class="md:py-[12px] py-1 px-6 rounded-[8px] border border-white text-lg bg-[white!important] w-full" wire:model='lastname'>
                                <div class="text-red-600 text-sm">
                                    @error('lastname') <span class="error">{{ $message }}</span> @enderror 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 md:self-stretch w-full mb-3">
                        <input type="text" id="email" name="email" placeholder="Email address"  autocomplete="disabled" autocorrect="off" autocapitalize="off" class="md:py-[12px] py-1 px-6 rounded-[8px] border border-white text-lg bg-[white!important]" wire:model='email'>
                        <div class="text-red-600 text-sm">
                            @error('email') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 md:self-stretch w-full mb-3">
                        <input type="text" id="number" name="number" placeholder="Phone number"  autocomplete="disabled" autocorrect="off" autocapitalize="off" class="md:py-[12px] py-1 px-6 rounded-[8px] border border-white text-lg bg-[white!important]" wire:model='number'>
                        <div class="text-red-600 text-sm">
                            @error('number') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 self-stretch mb-3">
                        <div class="flex flex-col gap-2 self-stretch">
                            <div class="w-full relative" x-data="{visiblePassword: false}">
                                <input :type="visiblePassword ? 'text' : 'password'" id="password" name="password" class="rounded-[8px] py-1 border border-white text-lg bg-[white!important] w-full pr-[55px] pl-6" wire:model='password' placeholder="password">
                                <i x-on:click="visiblePassword = !visiblePassword" :class="visiblePassword ? 'uil-eye' : 'uil-eye-slash'" class="uil pr-5 justify-center items-center flex text-lg text-slate-800 font-bold absolute right-0 top-4 cursor-pointer fill-slate-800"></i>
                            </div>
                            <div class="text-red-600 text-sm">
                                @error('password') <span class="error">{{ $message }}</span> @enderror 
                            </div>

                        </div>
                    </div>

                    <div class="flex flex-col gap-2 md:self-stretch w-full mb-1">
                        <input type="text" id="referral" name="referral" placeholder="Referral code (optional)"  autocomplete="disabled" autocorrect="off" autocapitalize="off" class="md:py-[12px] py-1 px-6 rounded-[8px] border border-white text-lg bg-[white!important]" wire:model='referral'>
                        <div class="text-red-600 text-sm">
                            @error('referral') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 md:self-stretch w-full mb-3">
                        <div class="w-full flex items-start text-xs">
                            <input type="checkbox" id="terms" name="terms" class="md:py-[12px] py-2 px-6 rounded-[8px] border border-slate-300 text-lg bg-[white!important] mr-3" wire:model.live='terms'>
                            <label for="terms">Click to agree to the terms and condition</label>
                        </div>
                        <div class="text-red-600 text-sm">
                            @error('terms') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 self-stretch items-start w-full">
                    <button class="flex w-full h-[40px] py-1 px-[24px] justify-center items-center bg-[#4657AD] rounded-3xl text-white font-semibold hover:bg-blue-900 text-xs" wire:loading.class="bg-blue-900" wire:loading.class.remove="bg-blue-800" wire:loading.attr="disabled">
                        <span class="" wire:loading.remove wire:target='register'>Submit</span>
                        <div wire:loading wire:target='register'>
                            <i class="uil uil-spinner w-[44px] h-[40px] py-[12px] justify-center items-center flex text-2xl text-white mr-2 font-bold animate-spin"></i>
                        </div>
                    </button>
                </div>
                <div class="text-center flex justify-center w-full flex-col" id="" role="presentation">
                    <div class="text-slate-800 font-medium text-sm">
                        Already have an account?
                        <a href="/auth/sign/up" class="text-blue-600 font-semibold">Sign in</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
