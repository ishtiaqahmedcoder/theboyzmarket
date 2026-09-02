<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Account' }} | {{ config('app.name') }}</title>
    <meta name="description" content="{{ $description ?? 'Sign in or create your ' . config('app.name') . ' account to shop and track your orders.' }}">
    <meta name="robots" content="noindex, follow">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">

    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

        <!-- Image side -->
        <div class="relative hidden lg:block bg-black">
            <img src="{{ asset('storage/auth/auth-bg.jpg') }}" alt="{{ config('app.name') }}"
                 class="absolute inset-0 w-full h-full object-cover opacity-80">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-black/10"></div>

            <div class="relative z-10 flex flex-col justify-between h-full p-10 text-white">
                <a href="{{ route('home') }}" class="text-2xl font-extrabold tracking-tight">
                    {{ config('app.name') }}
                </a>

                <div>
                    <h2 class="text-4xl font-extrabold leading-tight max-w-md">
                        Fresh Drops. Local Style.
                    </h2>
                    <p class="mt-3 text-gray-300 max-w-sm">
                        T-Shirts, Hoodies, Drop Shoulders and more. Order online and confirm instantly on WhatsApp.
                    </p>
                </div>
            </div>
        </div>

        <!-- Form side -->
        <div class="flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-16">
            <div class="w-full max-w-sm mx-auto">
                <a href="{{ route('home') }}" class="lg:hidden block text-center text-2xl font-extrabold tracking-tight mb-8">
                    {{ config('app.name') }}
                </a>

                {{ $slot }}

                <p class="mt-8 text-center text-xs text-gray-400">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
            </div>
        </div>

    </div>
</body>
</html>
