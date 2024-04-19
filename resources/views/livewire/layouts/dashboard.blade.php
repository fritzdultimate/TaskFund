<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Primary Meta Tags -->
        <title>{{ env('APP_NAME') }} - Secure Your Future with Flex Plans: Explore Profitable Investments.</title>
        <meta name="title" content="{{ env('APP_NAME') }} - Secure Your Future with Flex Plans: Explore Profitable Investments." />
        <meta name="description" content="Discover financial freedom with {{ env('APP_NAME') }}, your trusted partner in secured and profitable flex plans. Our expertly crafted investment strategies provide stability and growth, ensuring a secure future for you and your loved ones. Explore flexible investment options tailored to your needs and risk tolerance. " />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ request()->url() }}" />
        <meta property="og:title" content="{{ env('APP_NAME') }} - Secure Your Future with Flex Plans: Explore Profitable Investments." />
        <meta property="og:description" content="Discover financial freedom with {{ env('APP_NAME') }}, your trusted partner in secured and profitable flex plans. Our expertly crafted investment strategies provide stability and growth, ensuring a secure future for you and your loved ones. Explore flexible investment options tailored to your needs and risk tolerance. " />
        <meta property="og:image" content="{{ asset('img/open-graph.png') }}" />

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="{{ request()->url() }}" />
        <meta property="twitter:title" content="{{ env('APP_NAME') }} - Secure Your Future with Flex Plans: Explore Profitable Investments." />
        <meta property="twitter:description" content="Discover financial freedom with {{ env('APP_NAME') }}, your trusted partner in secured and profitable flex plans. Our expertly crafted investment strategies provide stability and growth, ensuring a secure future for you and your loved ones. Explore flexible investment options tailored to your needs and risk tolerance. " />
        <meta property="twitter:image" content="{{ asset('img/open-graph.png') }}" />

        <meta name="google-site-verification" content="gdjSTivn9Fz3GCU_yxafq5aPRJE6WJYOEyPBt2qcLuA" />

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        
        <title>{{ $title ?? 'Page Title' }}</title>
        <!-- STYLES -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        @livewireStyles

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/unicons.css" /> --}}
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
        @stack('styles-top')

        <!-- JAVASCRIPTS -->
        @livewireScripts
    </head>
    <body class="h-full">
        {{ $slot }}

        @include('livewire.partials.footer')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="{{ asset('libs/notiflix-aio-2.7.0.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @stack('script-bottom')
    </body>
</html>