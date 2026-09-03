<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FinanceStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $delivered = Order::query()->where('status', 'delivered');
        $active = Order::query()->whereIn('status', ['pending', 'confirmed', 'shipped']);

        $totalRevenue = (clone $delivered)->sum('total_amount');
        $pendingRevenue = (clone $active)->sum('total_amount');

        $thisMonthRevenue = Order::query()
            ->where('status', 'delivered')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        $deliveredCount = (clone $delivered)->count();
        $averageOrderValue = $deliveredCount > 0 ? $totalRevenue / $deliveredCount : 0;

        return [
            Stat::make('Total Revenue', 'Rs. '.number_format($totalRevenue))
                ->description('From delivered orders')
                ->color('success'),

            Stat::make('This Month', 'Rs. '.number_format($thisMonthRevenue))
                ->description(now()->format('F Y'))
                ->color('success'),

            Stat::make('Pending Revenue', 'Rs. '.number_format($pendingRevenue))
                ->description('Orders not yet delivered')
                ->color('warning'),

            Stat::make('Average Order Value', 'Rs. '.number_format($averageOrderValue))
                ->description('Based on delivered orders')
                ->color('gray'),
        ];
    }
}
