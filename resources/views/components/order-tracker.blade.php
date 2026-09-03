@props(['order'])

@php
    $steps = [
        ['key' => 'pending', 'label' => 'Order Placed'],
        ['key' => 'confirmed', 'label' => 'Confirmed'],
        ['key' => 'shipped', 'label' => 'Shipped'],
        ['key' => 'delivered', 'label' => 'Delivered'],
    ];

    $statusOrder = array_column($steps, 'key');
    $currentIndex = array_search($order->status, $statusOrder);
    $isCancelled = $order->status === 'cancelled';
@endphp

@if($isCancelled)
    <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-5 py-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <div>
            <p class="font-semibold">This order has been cancelled</p>
            <p class="text-sm text-red-600/80">Contact us if you have questions about this order.</p>
        </div>
    </div>
@else
    <div class="w-full">
        <div class="flex items-start">
            @foreach($steps as $index => $step)
                @php
                    $isDone = $currentIndex !== false && $index <= $currentIndex;
                    $isCurrent = $index === $currentIndex;
                @endphp

                <div class="flex flex-col items-center flex-1 min-w-0">
                    <div class="h-11 w-11 rounded-full flex items-center justify-center flex-shrink-0 transition-colors
                        {{ $isDone ? 'bg-black text-white' : 'bg-gray-100 text-gray-400' }}
                        {{ $isCurrent ? 'ring-4 ring-gray-200' : '' }}">
                        @switch($step['key'])
                            @case('pending')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                @break
                            @case('confirmed')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                @break
                            @case('shipped')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                                @break
                            @case('delivered')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
                                @break
                        @endswitch
                    </div>
                    <p class="mt-2 text-xs font-semibold text-center {{ $isDone ? 'text-black' : 'text-gray-400' }}">{{ $step['label'] }}</p>
                </div>

                @if(!$loop->last)
                    @php
                        $lineDone = $currentIndex !== false && $index < $currentIndex;
                    @endphp
                    <div class="flex-1 h-0.5 mt-5 {{ $lineDone ? 'bg-black' : 'bg-gray-200' }}"></div>
                @endif
            @endforeach
        </div>
    </div>
@endif
