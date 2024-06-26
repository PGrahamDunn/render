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
    @vite(['render/resources/css/app.css', 'render/resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100 flex">
        @include('layouts.navigation')
        <div class="relative h-screen flex-1 overflow-auto">
            @if (isset($header))
            <div class="sticky top-0">
                <header class="bg-gray-200">
                    <div class="py-4 px-2">
                        <!--<div class="w-full bg-green-300 p-3">green</div>-->
                        {{ $header }}
                    </div>
                </header>
            </div>
            @endif
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>

<!-- Page Heading -->
<!--
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif
-->