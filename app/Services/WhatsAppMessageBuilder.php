<?php

namespace App\Services;

use App\Models\Order;

class WhatsAppMessageBuilder
{
    public static function forOrder(Order $order): string
    {
        $lines = [];

        $lines[] = 'NEW ORDER: '.config('app.name');
        $lines[] = 'Order Number: #'.$order->id;
        $lines[] = '';
        $lines[] = 'Customer: '.$order->customer_name;
        $lines[] = 'Phone: '.$order->customer_phone;
        $lines[] = 'Address: '.$order->customer_address.', '.$order->city;
        $lines[] = '';
        $lines[] = 'Order Summary:';

        foreach ($order->items as $item) {
            $variant = trim(collect([$item->size, $item->color])->filter()->implode(', '));
            $variantLabel = $variant ? " ({$variant})" : '';
            $lines[] = "• {$item->quantity} x {$item->product_name}{$variantLabel}: Rs. ".number_format($item->subtotal);
        }

        $itemsTotal = $order->items->sum('subtotal');
        $shipping = $order->total_amount - $itemsTotal;

        $lines[] = '';

        if ($shipping > 0) {
            $lines[] = 'Shipping Fee: Rs. '.number_format($shipping);
        }

        $lines[] = 'Total Amount: Rs. '.number_format($order->total_amount);

        if ($order->notes) {
            $lines[] = '';
            $lines[] = 'Order Notes: '.$order->notes;
        }

        $lines[] = '';
        $lines[] = 'Track this order: '.self::trackingUrl($order);
        $lines[] = '';
        $lines[] = 'Please confirm this order so we can proceed with delivery. Thank you for shopping with '.config('app.name').'!';

        return implode("\n", $lines);
    }

    public static function trackingUrl(Order $order): string
    {
        return route('pages.track-order', [
            'order_id' => $order->id,
            'phone' => $order->customer_phone,
        ]);
    }

    public static function link(Order $order, string $whatsappNumber): string
    {
        $message = self::forOrder($order);

        return 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode($message);
    }
}
