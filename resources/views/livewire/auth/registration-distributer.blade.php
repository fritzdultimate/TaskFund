<div class="w-full h-full">
    <div class="flex flex-col self-stretch w-full h-full gap-6">
        {{-- <div> Header Section </div> --}}

        @if(!$loading)
            <livewire:dynamic-component
                :is="$current" :key="$current"
                :payload="$payload"
            />
        @else
        <div class="flex items-center justify-center w-full h-full">
            <i class="uil uil-spinner-alt w-14 h-14 py-[12px] px-[24px] justify-center items-center flex text-6xl animate-spin text-blue-500"></i>
        </div>
        @endif

    </div>
</div>

