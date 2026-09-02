@php
    $image = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
    $inStock = $product->variants->sum('stock') > 0;
@endphp
<a href="{{ route('products.show', $product) }}" class="group block">
    <div class="aspect-[3/4] bg-gray-100 rounded-xl overflow-hidden relative">
        @if($image)
            <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $product->name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">No Image</div>
        @endif

        @if($product->discount_price)
            <span class="absolute top-2 left-2 bg-black text-white text-xs font-semibold px-2 py-1 rounded">SALE</span>
        @endif

        @if(!$inStock)
            <span class="absolute inset-0 bg-white/70 flex items-center justify-center text-sm font-semibold text-gray-700">Out of Stock</span>
        @endif
    </div>
    <div class="mt-3">
        <p class="text-xs text-gray-500">{{ $product->category->name ?? '' }}</p>
        <h3 class="text-sm font-medium text-gray-900 group-hover:underline">{{ $product->name }}</h3>
        <div class="mt-1 flex items-center gap-2">
            @if($product->discount_price)
                <span class="text-sm font-semibold text-gray-900">Rs. {{ number_format($product->discount_price) }}</span>
                <span class="text-xs text-gray-400 line-through">Rs. {{ number_format($product->price) }}</span>
            @else
                <span class="text-sm font-semibold text-gray-900">Rs. {{ number_format($product->price) }}</span>
            @endif
        </div>
    </div>
</a>
