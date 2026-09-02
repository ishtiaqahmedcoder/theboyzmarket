<x-shop-layout title="Track Order" description="Track your TheBoyzMarket order status using your order number and phone number.">

    <div class="bg-black">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-white text-3xl sm:text-4xl font-extrabold">Track Your Order</h1>
            <p class="text-gray-400 mt-2">Enter your Order Number and Phone Number to check your order status.</p>
        </div>
    </div>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <form action="{{ route('pages.track-order') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="order_id" value="{{ request('order_id') }}" placeholder="Order Number, e.g. 12" required
                   class="flex-1 rounded-lg border-gray-300">
            <input type="text" name="phone" value="{{ request('phone') }}" placeholder="Phone Number" required
                   class="flex-1 rounded-lg border-gray-300">
            <button type="submit" class="bg-black text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-gray-800">
                Track
            </button>
        </form>

        @if($searched)
            @if($order)
                <div class="mt-8 border rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-bold text-lg">Order #{{ $order->id }}</h2>
                        <span class="text-xs font-semibold uppercase tracking-wide px-3 py-1 rounded-full
                            @class([
                                'bg-yellow-100 text-yellow-800' => $order->status === 'pending',
                                'bg-blue-100 text-blue-800' => $order->status === 'confirmed',
                                'bg-purple-100 text-purple-800' => $order->status === 'shipped',
                                'bg-green-100 text-green-800' => $order->status === 'delivered',
                                'bg-red-100 text-red-800' => $order->status === 'cancelled',
                            ])">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="space-y-2 text-sm mb-4">
                        @foreach($order->items as $item)
                            <div class="flex justify-between">
                                <span>{{ $item->quantity }}x {{ $item->product_name }} ({{ $item->size }}@if($item->color), {{ $item->color }}@endif)</span>
                                <span>Rs. {{ number_format($item->subtotal) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t pt-4 flex justify-between font-semibold">
                        <span>Total</span>
                        <span>Rs. {{ number_format($order->total_amount) }}</span>
                    </div>

                    <p class="text-xs text-gray-400 mt-4">Order placed on {{ $order->created_at->format('d M, Y') }}</p>
                </div>
            @else
                <div class="mt-8 text-center text-gray-500">
                    No matching order was found. Please check your order number and phone number and try again, or
                    <a href="{{ route('pages.contact') }}" class="underline font-semibold">contact us</a> for help.
                </div>
            @endif
        @endif
    </div>

</x-shop-layout>
