<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Revenue (Last 6 Months)';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $months = collect(range(5, 0))->map(fn (int $i) => now()->subMonths($i)->startOfMonth());

        $revenue = $months->map(function (Carbon $month) {
            return Order::query()
                ->where('status', '!=', 'cancelled')
                ->whereBetween('created_at', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])
                ->sum('total_amount');
        });

        return [
            'datasets' => [
                [
                    'label' => 'Revenue (Rs.)',
                    'data' => $revenue->toArray(),
                    'backgroundColor' => '#000000',
                    'borderColor' => '#000000',
                ],
            ],
            'labels' => $months->map(fn (Carbon $month) => $month->format('M Y'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
