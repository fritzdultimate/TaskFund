<main class="flex justify-center items-center flex-col w-full h-full">
    <div class="md:w-[490px] w-full flex flex-col justify-center items-center pb-3" wire:ignore.self>
        <div class="mb-10" id="logo">
            <h1 class="text-blue-800 text-3xl font-bold">{{ env('APP_NAME') }}</h1>
        </div>
        <div class="self-stretch flex flex-col px-7 w-full">
            <div>
                <i class="uil uil-check justify-center items-center flex text-9xl text-green-600"></i>
            </div>
            <div class="self-stretch flex flex-col items-center">
                <h1 class="text-slate-600 leading-9 font-semibold text-base">
                    Success
                </h1>
                <h2 class="text-sm font-normal leading-6 text-slate-600">
                    Account details successfully uploaded
                </h2>
            </div>
        </div>
    </div>
</main>
