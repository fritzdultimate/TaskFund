<div class="flex flex-col justify-center items-center h-full w-full font-semibold text-base md:text-xl leading-4 {{ $bg }} {{ $text }}">
    <span class="flex justify-center items-center rounded-full bg-green-50 mb-8 h-24 w-24 opacity-75">
        <i class="uil {{ $icon }} text-7xl z-10 {{ $iconColor }}"></i>
    </span>
    {{ $response }}

    <a href="{{ $url }}" class="px-10 {{ $btnColor }} {{ $btnBg }} py-1 mt-5 rounded-3xl text-xs font-medium">Continue</a>
</div>