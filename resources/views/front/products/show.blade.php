@php
    $metaDescription = $product->description
        ? \Illuminate\Support\Str::limit(strip_tags($product->description), 150)
        : "Buy {$product->name} at " . config('app.name') . ". Available in sizes S to XXL with nationwide delivery in Pakistan.";
@endphp
<x-shop-layout :title="$product->name" :description="$metaDescription">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- Gallery -->
            <div>
                @php $mainImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first(); @endphp
                <div class="aspect-[3/4] bg-gray-100 rounded-xl overflow-hidden" id="main-image-wrap">
                    @if($mainImage)
                        <img id="main-image" src="{{ asset('storage/'.$mainImage->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                    @endif
                </div>
                @if($product->images->count() > 1)
                    <div class="mt-4 grid grid-cols-5 gap-2">
                        @foreach($product->images as $image)
                            <button type="button" onclick="document.getElementById('main-image').src='{{ asset('storage/'.$image->image_path) }}'"
                                    class="aspect-square rounded-lg overflow-hidden bg-gray-100 border border-transparent hover:border-black">
                                <img src="{{ asset('storage/'.$image->image_path) }}" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Details -->
            <div>
                <p class="text-sm text-gray-500">{{ $product->category->name ?? '' }}</p>
                <h1 class="text-2xl font-bold mt-1">{{ $product->name }}</h1>

                <div class="mt-3 flex items-center gap-3">
                    @if($product->discount_price)
                        <span class="text-xl font-semibold">Rs. {{ number_format($product->discount_price) }}</span>
                        <span class="text-sm text-gray-400 line-through">Rs. {{ number_format($product->price) }}</span>
                    @else
                        <span class="text-xl font-semibold">Rs. {{ number_format($product->price) }}</span>
                    @endif
                </div>

                @if($product->fabric)
                    <p class="mt-2 text-sm text-gray-600">Fabric: {{ $product->fabric }}</p>
                @endif

                @if($product->description)
                    <p class="mt-4 text-gray-700 leading-relaxed">{{ $product->description }}</p>
                @endif

                <form action="{{ route('cart.add') }}" method="POST" class="mt-8">
                    @csrf

                    @if($colors->isNotEmpty())
                        <div class="mb-5">
                            <label class="block text-sm font-semibold mb-2">Color</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($colors as $color)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="color_choice" value="{{ $color }}" class="peer sr-only" onchange="filterVariants()">
                                        <span class="px-4 py-2 border rounded-full text-sm peer-checked:bg-black peer-checked:text-white">{{ $color }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mb-5">
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-sm font-semibold">Size</label>
                            <button type="button" onclick="document.getElementById('size-chart-modal').classList.remove('hidden')" class="text-xs underline text-gray-500">Size Chart</button>
                        </div>
                        <div class="flex flex-wrap gap-2" id="size-options">
                            @foreach($product->variants as $variant)
                                <label class="cursor-pointer variant-option"
                                       data-color="{{ $variant->color }}"
                                       data-size="{{ $variant->size }}"
                                       data-stock="{{ $variant->stock }}">
                                    <input type="radio" name="variant_id" value="{{ $variant->id }}" class="peer sr-only" {{ $variant->stock < 1 ? 'disabled' : '' }} required>
                                    <span class="px-4 py-2 border rounded-full text-sm peer-checked:bg-black peer-checked:text-white
                                        {{ $variant->stock < 1 ? 'opacity-40 line-through' : '' }}">
                                        {{ $variant->size }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6 flex items-center gap-3">
                        <label class="text-sm font-semibold">Quantity</label>
                        <input type="number" name="quantity" value="1" min="1" class="w-20 rounded-lg border-gray-300">
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 bg-black text-white font-semibold py-3 rounded-full hover:bg-gray-800">
                            Add to Cart
                        </button>
                        <button type="submit" name="buy_now" value="1"
                                class="flex-1 border border-black text-black font-semibold py-3 rounded-full hover:bg-gray-100">
                            Buy Now
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if($related->isNotEmpty())
            <div class="mt-16">
                <h2 class="text-xl font-bold mb-6">You may also like</h2>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                    @foreach($related as $relatedProduct)
                        @include('front.products.partials.card', ['product' => $relatedProduct])
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Size Chart Modal -->
    <div id="size-chart-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-md w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-lg">Size Chart</h3>
                <button onclick="document.getElementById('size-chart-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-700">&times;</button>
            </div>
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b"><th class="py-2">Size</th><th>Chest (in)</th><th>Length (in)</th></tr>
                </thead>
                <tbody>
                    <tr class="border-b"><td class="py-2">S</td><td>38</td><td>26</td></tr>
                    <tr class="border-b"><td class="py-2">M</td><td>40</td><td>27</td></tr>
                    <tr class="border-b"><td class="py-2">L</td><td>42</td><td>28</td></tr>
                    <tr class="border-b"><td class="py-2">XL</td><td>44</td><td>29</td></tr>
                    <tr><td class="py-2">XXL</td><td>46</td><td>30</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function filterVariants() {
            const selectedColor = document.querySelector('input[name="color_choice"]:checked')?.value;
            document.querySelectorAll('.variant-option').forEach(el => {
                if (!selectedColor || el.dataset.color === selectedColor) {
                    el.classList.remove('hidden');
                } else {
                    el.classList.add('hidden');
                    el.querySelector('input').checked = false;
                }
            });
        }
    </script>

</x-shop-layout>
