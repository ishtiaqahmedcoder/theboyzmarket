<x-shop-layout title="Shopping Cart" description="Review the items in your cart and proceed to checkout.">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-bold mb-8">Your Cart</h1>

        @if(empty($items))
            <div class="text-center py-20">
                <p class="text-gray-500 mb-6">Your cart is currently empty.</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-black text-white font-semibold px-6 py-3 rounded-full">Shop Now</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($items as $item)
                    <div class="flex items-center gap-4 border rounded-xl p-4">
                        <div class="w-20 h-24 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                            @if($item['image'])
                                <img src="{{ asset('storage/'.$item['image']) }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="flex-1">
                            <a href="{{ route('products.show', $item['slug']) }}" class="font-medium hover:underline">{{ $item['name'] }}</a>
                            <p class="text-sm text-gray-500 mt-1">
                                Size: {{ $item['size'] }}
                                @if($item['color']) &middot; Color: {{ $item['color'] }} @endif
                            </p>
                            <p class="text-sm font-semibold mt-1">Rs. {{ number_format($item['price']) }}</p>
                        </div>

                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-2">
                            @csrf @method('PATCH')
                            <input type="hidden" name="variant_id" value="{{ $item['variant_id'] }}">
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                   class="w-16 rounded-lg border-gray-300 text-sm" onchange="this.form.submit()">
                        </form>

                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf @method('DELETE')
                            <input type="hidden" name="variant_id" value="{{ $item['variant_id'] }}">
                            <button type="submit" class="text-sm text-red-600 hover:underline">Remove</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex items-center justify-between border-t pt-6">
                <span class="text-lg font-semibold">Subtotal</span>
                <span class="text-lg font-semibold">Rs. {{ number_format($subtotal) }}</span>
            </div>

            <a href="{{ route('checkout.index') }}" class="mt-6 block text-center bg-black text-white font-semibold py-3 rounded-full hover:bg-gray-800">
                Proceed to Checkout
            </a>
        @endif
    </div>

</x-shop-layout>
