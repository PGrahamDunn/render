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
                @elseif (config('app.env') =='uat')
                <div class="border-2 rounded-lg py-3 px-6 border-gray-700 bg-gradient-to-r from-blue-600 to-sky-500 m-2 flex items-center space-x-2">
                    @elseif (config('app.env') =='dev')
                    <div class="border-2 rounded-lg py-3 px-6 border-gray-700 bg-gradient-to-r from-green-600 to-lime-500 m-2 flex items-center space-x-2">
                        @else
                        <div class="border-2 rounded-lg py-3 px-6 border-gray-700 bg-gradient-to-r from-amber-600 to-yellow-500 m-2 flex items-center space-x-2">
                            @endif
                            <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-4xl font-bold text-white">{{ App::environment('production') ? config('app.name') : config('app.name') . ' - ' . config('app.env') }}</span>
                        </div>
                    </div>

                    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                        {{ $slot }}
                    </div>
                </div>
</body>

</html>