
<main class="flex justify-center items-center h-full min-h-full flex-col w-full my-8">
    <div class="md:w-[490px] w-full flex flex-col justify-center items-center md:p-[32px] pb-3 rounded-2xl md:border-slate-300 md:border" wire:ignore.self>
        <div class="mb-2" id="logo">
            <h1 class="text-[#4657AD] text-2xl font-bold">{{ env('APP_NAME') }}</h1>
        </div>
        <div class="self-stretch flex flex-col px-7 w-full">
            <div class="self-stretch flex flex-col">
                <h1 class="text-slate-800 leading-9 font-bold text-xl">
                    Account Recovery
                </h1>
                <h2 class="text-sm font-light leading-6 text-slate-600">
                    Not your device? Use a private or incognito window to sign in...
                </h2>
            </div>
            <form wire:submit="submit" class="flex md:w-[400px] md:pt-[24px] pb-2 pt-9 px- flex-col items-start gap-6 text-slate-500">
                <div class="w-full">
                    <div class="flex flex-col gap-2 md:self-stretch w-full mb-6">
                        <label for="email" class="text-[14px] font-bold leading-5 text-slate-900">Email</label>
                        <input type="text" id="email" name="Email" placeholder="Your email address" aria-label="Email" aria-invalid="false" autocomplete="disabled" autocorrect="off" autocapitalize="off" class="md:py-[12px] py-1 px-6 rounded-[8px] border border-white text-sm bg-[white!important]" wire:model='email'>
                        <div class="text-red-600 text-sm">
                            @error('email') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                        <div class="text-red-600 text-sm">
                            @if($errorMsg) <span class="error">{{ $errorMsg }}</span> @endif
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 self-stretch items-start w-full">
                    <button class="flex w-full py-2 px-[24px] justify-center items-center bg-[#4657AD] rounded-3xl text-white font-semibold hover:bg-blue-900" wire:loading.class="bg-blue-500" wire:loading.class.remove="bg-[#4657AD]" wire:loading.attr="disabled">
                        <span class="text-sm" wire:loading.remove wire:target='submit'>Continue</span>
                        <div wire:loading wire:target='submit'>
                            <i class="uil uil-spinner justify-center items-center flex text-sm text-white mr-2 font-bold animate-spin"></i>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>