<x-filament-panels::page>

    <x-filament::section heading="Orders by Status">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b dark:border-gray-700">
                        <th class="py-2 pr-4 font-medium">Status</th>
                        <th class="py-2 pr-4 font-medium">Orders</th>
                        <th class="py-2 font-medium">Total Value</th>
                    </tr>
                </thead>
                <tbody>
                    @php $breakdown = $this->getStatusBreakdown(); @endphp
                    @forelse(['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'] as $status)
                        @php $row = $breakdown[$status] ?? null; @endphp
                        <tr class="border-b dark:border-gray-800">
                            <td class="py-2 pr-4 capitalize">{{ $status }}</td>
                            <td class="py-2 pr-4">{{ $row->count ?? 0 }}</td>
                            <td class="py-2">Rs. {{ number_format($row->total ?? 0) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 text-gray-500">No orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-filament::section>

</x-filament-panels::page>
