<x-shop-layout title="Checkout" description="Complete your order in a few simple steps. Fast, secure checkout with order confirmation sent straight to WhatsApp.">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-bold mb-8">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">
            <form action="{{ route('checkout.store') }}" method="POST" class="lg:col-span-3 space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold mb-1">Full Name</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required
                           class="w-full rounded-lg border-gray-300">
                    @error('customer_name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Phone Number</label>
                    <input type="text" name="customer_phone" value="{{ old('customer_phone', auth()->user()->phone ?? '') }}" required placeholder="03XXXXXXXXX"
                           class="w-full rounded-lg border-gray-300">
                    @error('customer_phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Address</label>
                    <textarea name="customer_address" required rows="3" class="w-full rounded-lg border-gray-300">{{ old('customer_address') }}</textarea>
                    @error('customer_address') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">City</label>
                    <input type="text" name="city" value="{{ old('city') }}" required class="w-full rounded-lg border-gray-300">
                    @error('city') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Order Notes (optional)</label>
                    <textarea name="notes" rows="2" class="w-full rounded-lg border-gray-300">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="w-full bg-black text-white font-semibold py-3 rounded-full hover:bg-gray-800">
                    Place Order via WhatsApp
                </button>

                <p class="text-xs text-gray-500 text-center">
                    No online payment required. WhatsApp will open so you can confirm your order. Payment is Cash on Delivery or manual bank transfer.
                </p>
            </form>

            <div class="lg:col-span-2">
                <div class="border rounded-xl p-5">
                    <h2 class="font-semibold mb-4">Order Summary</h2>
                    <div class="space-y-3 text-sm">
                        @foreach($items as $item)
                            <div class="flex justify-between">
                                <span>{{ $item['quantity'] }}x {{ $item['name'] }} ({{ $item['size'] }}@if($item['color']), {{ $item['color'] }}@endif)</span>
                                <span>Rs. {{ number_format($item['price'] * $item['quantity']) }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-t mt-4 pt-4 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>Rs. {{ number_format($subtotal) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span>Rs. {{ number_format($shippingCharge) }}</span>
                        </div>
                        <div class="flex justify-between font-semibold text-base pt-2 border-t">
                            <span>Total</span>
                            <span>Rs. {{ number_format($subtotal + $shippingCharge) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-shop-layout>
