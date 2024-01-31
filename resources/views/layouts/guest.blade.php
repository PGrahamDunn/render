<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="flex flex-col items-center">
            <div class=" w-48">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </div>
            @if (App::environment('production'))
            <div class="border-2 rounded-lg py-3 px-6 border-gray-700 bg-gradient-to-r from-gray-600 to-zinc-500 m-2 flex items-center space-x-2">
                @elseif (config('app.env') =='staging')
                <div class="border-2 rounded-lg py-3 px-6 border-gray-700 bg-gradient-to-r from-blue-600 to-sky-500 m-2 flex items-center space-x-2">
                    @elseif (config('app.env') =='local')
                    <div class="border-2 rounded-lg py-3 px-6 border-gray-700 bg-gradient-to-r from-green-600 to-lime-500 m-2 flex items-center space-x-2">
                        @else
                        <div class="border-2 rounded-lg py-3 px-6 border-gray-700 bg-gradient-to-r from-amber-600 to-yellow-500 m-2 flex items-center space-x-2">
                            @endif
                            <x-application-icon class="text-white h-8 w-8" />
                            <span class="text-4xl font-bold text-white">{{ config('app.name') }}</span>
                            @if (!App::environment('production'))
                            <span class=" border border-white text-3xl text-white rounded-md px-2">{{ strtoupper(config('app.pgd_env')) }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                        {{ $slot }}
                    </div>
                </div>
</body>

</html>