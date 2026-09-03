<?php

namespace App\Filament\Pages;

use App\Models\Order;
use Filament\Pages\Page;

class Finance extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Finance';

    protected static ?string $navigationLabel = 'Overview';

    protected static ?string $title = 'Finance Overview';

    protected static string $view = 'filament.pages.finance';

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\FinanceStatsOverview::class,
            \App\Filament\Widgets\RevenueChart::class,
        ];
    }

    public function getStatusBreakdown(): array
    {
        return Order::query()
            ->selectRaw('status, count(*) as count, sum(total_amount) as total')
            ->groupBy('status')
            ->get()
            ->keyBy('status')
            ->all();
    }
}
