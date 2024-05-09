@props([
    'title',
    'showBackButton' => true,
    'rightLink' => null,
])

<div class="flex bg-white py-3 w-full items-center">
    @if($showBackButton)
    <div class="basis-[10%] absolute">
        <a x-on:click="history.go(-1)">
            <div class="mr-auto p-2 pl-4" id="returnBack">
                <x-arrow-back-icon/>
            </div>
        </a>
    </div>
    @endif
    <h1 class="text-slate-800 font-semibold text-xl text-center w-full basis-full">
        {{ $title }}
    </h1>
    <div class="basis-[10%] absolute text-xs right-0 px-4">
        {!! $rightLink !!}
    </div>
</div>