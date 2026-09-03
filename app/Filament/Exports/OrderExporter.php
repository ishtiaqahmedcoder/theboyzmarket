<?php

namespace App\Filament\Exports;

use App\Models\Order;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class OrderExporter extends Exporter
{
    protected static ?string $model = Order::class;

    public function getFormats(): array
    {
        return [ExportFormat::Csv];
    }

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('Order Number'),
            ExportColumn::make('customer_name')->label('Customer Name'),
            ExportColumn::make('customer_phone')->label('Phone'),
            ExportColumn::make('customer_address')->label('Address'),
            ExportColumn::make('city')->label('City'),
            ExportColumn::make('items_count')->label('Items')->counts('items'),
            ExportColumn::make('total_amount')->label('Total (Rs.)'),
            ExportColumn::make('status')->label('Status'),
            ExportColumn::make('whatsapp_sent')
                ->label('WhatsApp Sent')
                ->formatStateUsing(fn (bool $state) => $state ? 'Yes' : 'No'),
            ExportColumn::make('notes')->label('Notes'),
            ExportColumn::make('created_at')->label('Order Date'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your order export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
