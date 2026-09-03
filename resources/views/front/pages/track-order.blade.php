<x-shop-layout title="Track Order" description="Track your TheBoyzMarket order status using your order number and phone number.">

    <div class="bg-black">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-white text-3xl sm:text-4xl font-extrabold">Track Your Order</h1>
            <p class="text-gray-400 mt-2">Enter your Order Number and Phone Number to check your order status.</p>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
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
                <!-- Status Tracker -->
                <div class="mt-10 border rounded-xl p-6 sm:p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide font-semibold">Order Status</p>
                            <h2 class="font-bold text-xl mt-0.5">Order #{{ $order->id }}</h2>
                        </div>
                        <span class="text-xs font-semibold uppercase tracking-wide px-3 py-1.5 rounded-full
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

                    <x-order-tracker :order="$order" />
                </div>

                <!-- Receipt -->
                <div class="mt-6 border rounded-xl overflow-hidden">
                    <div class="bg-black text-white px-6 sm:px-8 py-5 flex items-center justify-between">
                        <div>
                            <p class="font-extrabold text-lg">{{ config('app.name') }}</p>
                            <p class="text-gray-400 text-xs mt-0.5">Order Receipt</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold">#{{ $order->id }}</p>
                            <p class="text-gray-400 text-xs mt-0.5">{{ $order->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>

                    <div class="px-6 sm:px-8 py-6">
                        <div class="grid grid-cols-2 gap-4 text-sm mb-6 pb-6 border-b border-dashed">
                            <div>
                                <p class="text-gray-400 text-xs uppercase tracking-wide mb-1">Billed To</p>
                                <p class="font-medium">{{ $order->customer_name }}</p>
                                <p class="text-gray-500">{{ $order->customer_phone }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-xs uppercase tracking-wide mb-1">Delivery Address</p>
                                <p class="font-medium">{{ $order->customer_address }}</p>
                                <p class="text-gray-500">{{ $order->city }}</p>
                            </div>
                        </div>

                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-gray-400 text-xs uppercase tracking-wide">
                                    <th class="text-left font-semibold pb-3">Item</th>
                                    <th class="text-center font-semibold pb-3">Qty</th>
                                    <th class="text-right font-semibold pb-3">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-dashed">
                                @foreach($order->items as $item)
                                    <tr>
                                        <td class="py-3">
                                            <p class="font-medium">{{ $item->product_name }}</p>
                                            <p class="text-gray-400 text-xs">Size: {{ $item->size }}@if($item->color), Color: {{ $item->color }}@endif</p>
                                        </td>
                                        <td class="py-3 text-center">{{ $item->quantity }}</td>
                                        <td class="py-3 text-right">Rs. {{ number_format($item->subtotal) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @php
                            $itemsTotal = $order->items->sum('subtotal');
                            $shipping = $order->total_amount - $itemsTotal;
                        @endphp

                        <div class="mt-6 pt-4 border-t border-dashed space-y-2 text-sm">
                            <div class="flex justify-between text-gray-500">
                                <span>Subtotal</span>
                                <span>Rs. {{ number_format($itemsTotal) }}</span>
                            </div>
                            @if($shipping > 0)
                                <div class="flex justify-between text-gray-500">
                                    <span>Shipping</span>
                                    <span>Rs. {{ number_format($shipping) }}</span>
                                </div>
                            @endif
                            <div class="flex justify-between font-bold text-base pt-2 border-t">
                                <span>Total</span>
                                <span>Rs. {{ number_format($order->total_amount) }}</span>
                            </div>
                        </div>

                        @if($order->notes)
                            <div class="mt-6 pt-4 border-t border-dashed text-sm">
                                <p class="text-gray-400 text-xs uppercase tracking-wide mb-1">Order Notes</p>
                                <p class="text-gray-600">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="bg-gray-50 px-6 sm:px-8 py-4 text-center text-xs text-gray-400 border-t border-dashed">
                        Thank you for shopping with {{ config('app.name') }}. Payment is Cash on Delivery or manual bank transfer.
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('pages.contact') }}" class="text-sm text-gray-500 hover:underline">Need help with this order? Contact us</a>
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
