@php
    $activeCategory = request('category') ? $categories->firstWhere('slug', request('category')) : null;
    $pageTitle = $activeCategory->name ?? 'Shop All Products';
    $pageDescription = $activeCategory
        ? "Shop {$activeCategory->name} at " . config('app.name') . ". Available in sizes S to XXL with nationwide delivery and WhatsApp order confirmation."
        : 'Browse the full ' . config('app.name') . ' collection of T-Shirts, Hoodies, Drop Shoulders, Painted Tees and Trousers.';
@endphp
<x-shop-layout :title="$pageTitle" :description="$pageDescription">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h1 class="text-2xl font-bold">{{ $pageTitle }}</h1>

            <form action="{{ route('products.index') }}" method="GET" class="flex items-center gap-3">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <select name="size" onchange="this.form.submit()" class="text-sm rounded-lg border-gray-300">
                    <option value="">All Sizes</option>
                    @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                        <option value="{{ $size }}" @selected(request('size') === $size)>{{ $size }}</option>
                    @endforeach
                </select>
                <select name="sort" onchange="this.form.submit()" class="text-sm rounded-lg border-gray-300">
                    <option value="">Newest</option>
                    <option value="price_low" @selected(request('sort') === 'price_low')>Price: Low to High</option>
                    <option value="price_high" @selected(request('sort') === 'price_high')>Price: High to Low</option>
                </select>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-8">
            <aside class="hidden sm:block">
                <h3 class="font-semibold text-sm mb-3">Categories</h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('products.index') }}" class="{{ request('category') ? 'text-gray-600' : 'font-semibold text-black' }} hover:text-black">
                            All
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                               class="{{ request('category') === $category->slug ? 'font-semibold text-black' : 'text-gray-600' }} hover:text-black">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>

            <div class="sm:col-span-3">
                @if($products->isEmpty())
                    <p class="text-gray-500">No products found.</p>
                @else
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            @include('front.products.partials.card', ['product' => $product])
                        @endforeach
                    </div>

                    <div class="mt-10">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-shop-layout>
