<x-app-layout title="My Account">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Account
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold">Welcome back, {{ Auth::user()->name }}</h3>
                <p class="text-gray-500 text-sm mt-1">Here is a summary of your recent orders.</p>
                <div class="mt-4 flex gap-3">
                    <a href="{{ route('products.index') }}" class="inline-block bg-black text-white text-sm font-semibold px-5 py-2.5 rounded-full hover:bg-gray-800">Continue Shopping</a>
                    <a href="{{ route('profile.edit') }}" class="inline-block border border-gray-300 text-sm font-semibold px-5 py-2.5 rounded-full hover:bg-gray-50">Edit Profile</a>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold">Order History</h3>
                </div>

                @if($orders->isEmpty())
                    <div class="p-10 text-center text-gray-500">
                        <p>You have not placed any orders yet.</p>
                        <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-black text-white text-sm font-semibold px-6 py-2.5 rounded-full hover:bg-gray-800">Start Shopping</a>
                    </div>
                @else
                    <div class="divide-y">
                        @foreach($orders as $order)
                            <div class="p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <div>
                                    <p class="font-semibold">Order #{{ $order->id }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->created_at->format('d M, Y') }} &middot; {{ $order->items->count() }} item(s) &middot; Rs. {{ number_format($order->total_amount) }}</p>
                                </div>
                                <div class="flex items-center gap-3">
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
                                    <a href="{{ route('pages.track-order', ['order_id' => $order->id, 'phone' => $order->customer_phone]) }}" class="text-sm font-semibold underline">Track Order</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
