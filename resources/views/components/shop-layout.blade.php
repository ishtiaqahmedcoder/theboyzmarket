@props(['title' => null, 'description' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }} | {{ config('app.name') }}</title>
    <meta name="description" content="{{ $description ?? 'Shop the latest T-Shirts, Hoodies, Drop Shoulders, Painted Tees and Trousers at ' . config('app.name') . '. Easy ordering, fast delivery across Pakistan, and orders confirmed instantly on WhatsApp.' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $title ?? config('app.name') }}">
    <meta property="og:description" content="{{ $description ?? 'Shop the latest streetwear at ' . config('app.name') . '. Easy ordering with instant WhatsApp confirmation.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes marquee-scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .marquee-track {
            animation: marquee-scroll 22s linear infinite;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">

    <div class="bg-black text-white text-xs font-medium overflow-hidden whitespace-nowrap border-b border-gray-800">
        <div class="marquee-track inline-flex py-2">
            @for($i = 0; $i < 2; $i++)
                <span class="inline-flex items-center gap-10 px-5">
                    <span>🚚 Free Delivery on Prepaid Orders</span>
                    <span>💬 Orders Confirmed Instantly on WhatsApp</span>
                    <span>🔥 New Arrivals Every Week</span>
                    <span>📦 Easy Exchange Within 7 Days</span>
                </span>
            @endfor
        </div>
    </div>

    <header
        x-data="{ scrolled: false }"
        x-init="scrolled = window.scrollY > 40"
        @scroll.window="scrolled = window.scrollY > 40"
        :class="scrolled ? 'bg-white text-black shadow-md' : 'bg-black text-white'"
        class="sticky top-0 z-40 transition-colors duration-300"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="text-2xl font-extrabold tracking-tight">
                    {{ config('app.name') }}
                </a>

                <nav class="hidden md:flex items-center gap-6 text-xs font-semibold uppercase tracking-wide">
                    <a href="{{ route('home') }}" class="opacity-80 hover:opacity-100">Home</a>
                    <a href="{{ route('products.index') }}" class="opacity-80 hover:opacity-100">Shop All</a>
                    @foreach(\App\Models\Category::where('is_active', true)->get() as $navCategory)
                        <a href="{{ route('products.index', ['category' => $navCategory->slug]) }}" class="opacity-80 hover:opacity-100">{{ $navCategory->name }}</a>
                    @endforeach
                </nav>

                <div class="flex items-center gap-4">
                    <form action="{{ route('products.index') }}" method="GET" class="hidden sm:block">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
                               :class="scrolled ? 'bg-gray-100 text-black placeholder-gray-500 focus:ring-black' : 'bg-gray-800 text-white placeholder-gray-400 focus:ring-white'"
                               class="rounded-full border-0 text-sm px-4 py-1.5 focus:ring-2 w-48 transition-colors">
                    </form>

                    <a href="{{ route('cart.index') }}" class="relative inline-flex items-center opacity-80 hover:opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @php $cartCount = app(\App\Services\Cart::class)->count(); @endphp
                        @if($cartCount > 0)
                            <span :class="scrolled ? 'bg-black text-white' : 'bg-white text-black'" class="absolute -top-2 -right-2 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center transition-colors">{{ $cartCount }}</span>
                        @endif
                    </a>

                    @auth
                        <a href="{{ route('profile.edit') }}" class="hidden sm:inline text-xs font-semibold uppercase tracking-wide opacity-80 hover:opacity-100">{{ Auth::user()->name }}</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline text-xs font-semibold uppercase tracking-wide opacity-80 hover:opacity-100">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-300 text-green-800 text-sm rounded-lg px-4 py-3">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border border-red-300 text-red-800 text-sm rounded-lg px-4 py-3">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <main>
        {{ $slot }}
    </main>

    @php $waFloatNumber = \App\Models\Setting::get('whatsapp_number'); @endphp
    <a href="https://wa.me/{{ $waFloatNumber }}" target="_blank"
       class="fixed bottom-5 left-5 z-40 flex items-center justify-center h-14 w-14 rounded-full bg-green-500 text-white shadow-lg hover:bg-green-600 transition">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-7 w-7 fill-current"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.001 2C6.478 2 2 6.477 2 12c0 1.982.578 3.83 1.573 5.385L2 22l4.735-1.545A9.953 9.953 0 0012.001 22C17.523 22 22 17.523 22 12S17.523 2 12.001 2zm0 18.13a8.106 8.106 0 01-4.375-1.278l-.313-.187-2.812.918.929-2.74-.204-.323A8.106 8.106 0 013.87 12c0-4.484 3.647-8.13 8.131-8.13 4.484 0 8.13 3.646 8.13 8.13 0 4.484-3.646 8.13-8.13 8.13z"/></svg>
    </a>

    <footer class="bg-black text-gray-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 grid grid-cols-2 sm:grid-cols-4 gap-8 text-sm">
            <div class="col-span-2 sm:col-span-1">
                <h3 class="text-white text-xl font-extrabold mb-3">{{ config('app.name') }}</h3>
                <p>Local streetwear and apparel. Quality tees, hoodies and trousers delivered straight to your door.</p>
                @php $waNumber = \App\Models\Setting::get('whatsapp_number'); @endphp
                <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="inline-flex items-center gap-2 mt-4 text-green-400 hover:text-green-300 font-semibold">
                    WhatsApp: 0{{ substr($waNumber, 2) }}
                </a>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-3 uppercase text-xs tracking-wide">Shop</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('products.index') }}" class="hover:text-white">All Products</a></li>
                    @foreach(\App\Models\Category::where('is_active', true)->get() as $footerCategory)
                        <li><a href="{{ route('products.index', ['category' => $footerCategory->slug]) }}" class="hover:text-white">{{ $footerCategory->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-3 uppercase text-xs tracking-wide">Customer Support</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('pages.track-order') }}" class="hover:text-white">Track Your Order</a></li>
                    <li><a href="{{ route('pages.returns') }}" class="hover:text-white">Return and Exchange</a></li>
                    <li><a href="{{ route('pages.shipping') }}" class="hover:text-white">Shipping Policy</a></li>
                    <li><a href="{{ route('pages.faqs') }}" class="hover:text-white">FAQs</a></li>
                    <li><a href="{{ route('pages.contact') }}" class="hover:text-white">Contact Us</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-3 uppercase text-xs tracking-wide">About</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('pages.about') }}" class="hover:text-white">Our Story</a></li>
                    <li><a href="{{ route('pages.terms') }}" class="hover:text-white">Terms and Conditions</a></li>
                    <li><a href="{{ route('pages.privacy') }}" class="hover:text-white">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 text-center text-xs py-4 text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </footer>

</body>
</html>
