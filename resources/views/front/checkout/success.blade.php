<x-shop-layout title="Order Placed">

    <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="mx-auto h-16 w-16 rounded-full bg-green-100 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h1 class="text-2xl font-bold mt-6">Order #{{ $order->id }} Placed Successfully</h1>
        <p class="text-gray-600 mt-2">Tap the button below to confirm your order with us on WhatsApp.</p>

        <div class="mt-8 border rounded-xl p-5 text-left text-sm space-y-2">
            <p><span class="font-semibold">Total:</span> Rs. {{ number_format($order->total_amount) }}</p>
            <p><span class="font-semibold">Address:</span> {{ $order->customer_address }}, {{ $order->city }}</p>
        </div>

        <a href="{{ $whatsappLink }}" target="_blank" id="whatsapp-btn"
           class="mt-8 inline-flex items-center gap-2 bg-green-600 text-white font-semibold px-8 py-3 rounded-full hover:bg-green-700">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 fill-current"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.001 2C6.478 2 2 6.477 2 12c0 1.982.578 3.83 1.573 5.385L2 22l4.735-1.545A9.953 9.953 0 0012.001 22C17.523 22 22 17.523 22 12S17.523 2 12.001 2zm0 18.13a8.106 8.106 0 01-4.375-1.278l-.313-.187-2.812.918.929-2.74-.204-.323A8.106 8.106 0 013.87 12c0-4.484 3.647-8.13 8.131-8.13 4.484 0 8.13 3.646 8.13 8.13 0 4.484-3.646 8.13-8.13 8.13z"/></svg>
            Confirm Order on WhatsApp
        </a>

        <p class="mt-6 flex items-center justify-center gap-4 text-sm">
            <a href="{{ route('pages.track-order', ['order_id' => $order->id, 'phone' => $order->customer_phone]) }}" class="text-gray-600 hover:underline font-medium">Track This Order</a>
            <span class="text-gray-300">•</span>
            <a href="{{ route('products.index') }}" class="text-gray-500 hover:underline">Continue Shopping</a>
        </p>
    </div>

    <script>
        window.addEventListener('load', function () {
            setTimeout(function () {
                window.open(document.getElementById('whatsapp-btn').href, '_blank');
            }, 800);
        });
    </script>

</x-shop-layout>
