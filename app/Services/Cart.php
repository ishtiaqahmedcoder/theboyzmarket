<?php

namespace App\Services;

use App\Models\ProductVariant;
use Illuminate\Support\Facades\Session;

class Cart
{
    private const SESSION_KEY = 'cart';

    public function add(ProductVariant $variant, int $quantity = 1): void
    {
        $items = $this->items();

        $key = (string) $variant->id;

        $product = $variant->product;

        $available = $variant->stock;

        $currentQty = $items[$key]['quantity'] ?? 0;

        $newQty = min($currentQty + $quantity, $available);

        $items[$key] = [
            'variant_id' => $variant->id,
            'product_id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'size' => $variant->size,
            'color' => $variant->color,
            'price' => $product->displayPrice(),
            'quantity' => max($newQty, 1),
            'image' => optional($product->primaryImage())->image_path,
        ];

        Session::put(self::SESSION_KEY, $items);
    }

    public function update(int $variantId, int $quantity): void
    {
        $items = $this->items();
        $key = (string) $variantId;

        if (! isset($items[$key])) {
            return;
        }

        if ($quantity <= 0) {
            unset($items[$key]);
        } else {
            $variant = ProductVariant::find($variantId);
            $max = $variant ? $variant->stock : $quantity;
            $items[$key]['quantity'] = min($quantity, max($max, 1));
        }

        Session::put(self::SESSION_KEY, $items);
    }

    public function remove(int $variantId): void
    {
        $items = $this->items();
        unset($items[(string) $variantId]);
        Session::put(self::SESSION_KEY, $items);
    }

    public function items(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }

    public function count(): int
    {
        return collect($this->items())->sum('quantity');
    }

    public function subtotal(): int
    {
        return collect($this->items())->sum(fn (array $item) => $item['price'] * $item['quantity']);
    }

    public function clear(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    public function isEmpty(): bool
    {
        return empty($this->items());
    }
}
