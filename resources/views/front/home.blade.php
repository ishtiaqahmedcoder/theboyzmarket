<x-shop-layout title="Shop Streetwear Online in Pakistan" description="Shop the latest T-Shirts, Hoodies, Drop Shoulders, Painted Tees and Trousers at TheBoyzMarket. Easy ordering, nationwide delivery, and orders confirmed instantly on WhatsApp.">

    @php
        $heroSlides = [
            ['image' => 'hero/hero-1.jpg', 'eyebrow' => 'New Season', 'heading' => 'Fresh Drops.<br>Fresh Fits.', 'cta' => 'Shop New Arrivals'],
            ['image' => 'hero/hero-2.jpg', 'eyebrow' => 'Street Essentials', 'heading' => 'Built For The<br>Everyday Grind.', 'cta' => 'Explore Collection'],
            ['image' => 'hero/hero-3.jpg', 'eyebrow' => 'Signature Style', 'heading' => 'Wear What<br>Feels Right.', 'cta' => 'Shop the Edit'],
            ['image' => 'hero/hero-4.jpg', 'eyebrow' => 'Comfort First', 'heading' => 'Everyday Layers.<br>Made To Last.', 'cta' => 'Shop Hoodies'],
            ['image' => 'hero/hero-5.jpg', 'eyebrow' => 'Bold and Original', 'heading' => 'Own Your<br>Look.', 'cta' => 'View All Products'],
        ];
    @endphp

    <!-- Hero Carousel -->
    <section class="relative h-[70vh] min-h-[420px] max-h-[720px] overflow-hidden bg-black" x-data="{ slide: 0, slides: {{ count($heroSlides) }} }" x-init="setInterval(() => slide = (slide + 1) % slides, 5000)">

        @foreach($heroSlides as $index => $hero)
            <div class="absolute inset-0 transition-opacity duration-700" :class="slide === {{ $index }} ? 'opacity-100' : 'opacity-0'">
                <img src="{{ asset('storage/'.$hero['image']) }}" class="w-full h-full object-cover" alt="{{ strip_tags($hero['heading']) }}" @if($index > 0) loading="lazy" @endif>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-black/10"></div>
                <div class="absolute inset-0 flex items-end sm:items-center">
                    <div class="max-w-7xl mx-auto px-6 sm:px-10 w-full pb-16 sm:pb-0">
                        <p class="text-white/70 text-xs font-semibold uppercase tracking-[0.2em] mb-3">{{ $hero['eyebrow'] }}</p>
                        <h1 class="text-white text-4xl sm:text-6xl font-extrabold leading-[0.95] max-w-xl">{!! $hero['heading'] !!}</h1>
                        <a href="{{ route('products.index') }}" class="mt-6 inline-block bg-white text-black font-semibold px-8 py-3 rounded-full hover:bg-gray-200">{{ $hero['cta'] }}</a>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Dots -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-10">
            @foreach($heroSlides as $index => $hero)
                <button @click="slide = {{ $index }}" class="h-2 rounded-full transition-all" :class="slide === {{ $index }} ? 'w-6 bg-white' : 'w-2 bg-white/50'"></button>
            @endforeach
        </div>
    </section>

    <!-- Categories -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-end justify-between mb-8">
            <h2 class="text-2xl sm:text-3xl font-extrabold">Shop by Category</h2>
            <a href="{{ route('products.index') }}" class="text-sm font-semibold underline hidden sm:block">View All</a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($categories as $category)
                @php
                    $catImage = $category->image ? asset('storage/'.$category->image) : null;
                @endphp
                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                   class="group relative rounded-xl overflow-hidden bg-gray-900 aspect-[3/4] flex items-end">
                    @if($catImage)
                        <img src="{{ $catImage }}" alt="{{ $category->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/10 to-transparent"></div>
                    <div class="relative z-10 w-full text-white px-4 py-4">
                        <span class="block font-bold text-base leading-tight">{{ $category->name }}</span>
                        <span class="mt-1 inline-flex items-center gap-1 text-xs font-semibold text-white/80 group-hover:text-white">
                            Explore More
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Featured -->
    @if($featured->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 pb-16">
            <div class="flex items-end justify-between mb-8">
                <h2 class="text-2xl sm:text-3xl font-extrabold">Featured</h2>
                <a href="{{ route('products.index') }}" class="text-sm font-semibold underline hidden sm:block">View All</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($featured as $product)
                    @include('front.products.partials.card', ['product' => $product])
                @endforeach
            </div>
        </section>
    @endif

    <!-- Promo Banner -->
    <section class="bg-black relative overflow-hidden">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-4">
            <div class="hidden lg:block relative h-full min-h-[420px]">
                <img src="{{ asset('storage/promo/shopping-2.jpg') }}" alt="Fast order handling" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                <div class="absolute inset-0 bg-black/50"></div>
            </div>

            <div class="lg:col-span-2 px-6 sm:px-10 py-16 text-center flex flex-col items-center justify-center">
                <p class="text-white/60 text-xs font-semibold uppercase tracking-[0.2em] mb-3">Simple. Fast. Reliable.</p>
                <h2 class="text-white text-3xl sm:text-4xl font-extrabold">Ordering Made Easy</h2>
                <p class="text-gray-400 mt-3 max-w-md">Add items to your cart, complete checkout, and confirm your order directly on WhatsApp. No online payment required.</p>
                @php $promoWa = \App\Models\Setting::get('whatsapp_number'); @endphp
                <a href="https://wa.me/{{ $promoWa }}" target="_blank" class="mt-6 inline-flex items-center gap-2 bg-green-500 text-white font-semibold px-8 py-3 rounded-full hover:bg-green-600">
                    Chat on WhatsApp
                </a>
            </div>

            <div class="hidden lg:block relative h-full min-h-[420px]">
                <img src="{{ asset('storage/promo/shopping-1.jpg') }}" alt="Order delivered to your door" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                <div class="absolute inset-0 bg-black/50"></div>
            </div>
        </div>
    </section>

    <!-- New Arrivals -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-end justify-between mb-8">
            <h2 class="text-2xl sm:text-3xl font-extrabold">New Arrivals</h2>
            <a href="{{ route('products.index') }}" class="text-sm font-semibold underline hidden sm:block">View All</a>
        </div>
        @if($newArrivals->isEmpty())
            <p class="text-gray-500">New products are coming soon.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($newArrivals as $product)
                    @include('front.products.partials.card', ['product' => $product])
                @endforeach
            </div>
        @endif
    </section>

</x-shop-layout>
