<main class="flex justify-center items-center flex-col w-full my-12">
    <div class="md:w-[490px] w-full flex flex-col justify-center items-center pb-3" wire:ignore.self>
        <div class="mb-10" id="logo">
            <h1 class="text-blue-800 text-3xl font-bold">{{ env('APP_NAME') }}</h1>
        </div>
        <div class="self-stretch flex flex-col px-7 w-full">
            <div class="self-stretch flex flex-col items-center">
                <h1 class="text-slate-600 leading-9 font-semibold text-base">
                    Account Details Confirmation
                </h1>
                <h2 class="text-sm font-normal leading-6 text-slate-600">
                    Fill in your account details
                </h2>
            </div>
            <form wire:submit="submit" class="flex md:w-[400px] md:pt-[24px] pb-2 pt-9 px- flex-col items-start gap-6 text-slate-500">
                <div class="w-full">
                    <div class="flex flex-col gap-2 md:self-stretch w-full mb-3">
                        <input type="text" id="accountName" name="accountName" placeholder="Account Name"  autocomplete="disabled" autocorrect="off" autocapitalize="off" class="md:py-[12px] py-2 px-6 rounded-[8px] border border-slate-300 text-lg bg-[white!important]" wire:model='accountName'>
                        <div class="text-red-600 text-sm">
                            @error('accountName') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 md:self-stretch w-full mb-3">
                        <input type="text" id="accountNumber" name="accountNumber" placeholder="Account Number"  autocomplete="disabled" autocorrect="off" autocapitalize="off" class="md:py-[12px] py-2 px-6 rounded-[8px] border border-slate-300 text-lg bg-[white!important]" wire:model='accountNumber'>
                        <div class="text-red-600 text-sm">
                            @error('accountNumber') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 md:self-stretch w-full mb-3">
                        <input type="text" id="bankName" name="bankName" placeholder="Bank Name"  autocomplete="disabled" autocorrect="off" autocapitalize="off" class="md:py-[12px] py-2 px-6 rounded-[8px] border border-slate-300 text-lg bg-[white!important]" wire:model='bankName'>
                        <div class="text-red-600 text-sm">
                            @error('bankName') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 self-stretch items-start w-full">
                    <button class="flex w-full h-[40px] py-2 px-[24px] justify-center items-center bg-blue-800 rounded-3xl text-white font-bold hover:bg-blue-900" wire:loading.class="bg-blue-900" wire:loading.class.remove="bg-blue-800" wire:loading.attr="disabled">
                        <span class="" wire:loading.remove wire:target='submit'>Submit</span>
                        <div wire:loading wire:target='submit'>
                            <i class="uil uil-spinner w-[44px] h-[40px] py-[12px] justify-center items-center flex text-2xl text-white mr-2 font-bold animate-spin"></i>
                        </div>
                    </button>
                </div>

                <div class="flex gap-4 self-stretch items-start w-full">
                    <button class="flex w-full py-2 px-[24px] justify-center items-center bg-white rounded-3xl border border-blue-800 text-blue-800 font-semibold">
                        Skip
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
