<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            'T-Shirts' => [
                ['Classic White Tee', 'classic-white-tee.jpg'],
                ['Black Crew Neck Tee', 'black-crew-neck-tee.jpg'],
            ],
            'Drop Shoulder' => [
                ['Oversized Drop Shoulder', 'oversized-drop-shoulder.jpg'],
                ['Grey Drop Shoulder', 'grey-drop-shoulder.jpg'],
            ],
            'Painted T-Shirts' => [
                ['Hand Painted Graphic Tee', 'hand-painted-graphic-tee.jpg'],
            ],
            'Trouser' => [
                ['Cargo Trouser', 'cargo-trouser.jpg'],
                ['Slim Fit Trouser', 'slim-fit-trouser.jpg'],
            ],
            'Hoodie' => [
                ['Pullover Hoodie', 'pullover-hoodie.jpg'],
                ['Zip-Up Hoodie', 'zip-up-hoodie.jpg'],
            ],
        ];

        foreach ($products as $categoryName => $items) {
            $category = Category::where('name', $categoryName)->first();

            foreach ($items as [$name, $image]) {
                $product = Product::query()->updateOrCreate(
                    ['slug' => Str::slug($name)],
                    [
                        'category_id' => $category->id,
                        'name' => $name,
                        'description' => "High quality {$name} for everyday wear.",
                        'fabric' => '100% Cotton',
                        'price' => rand(1200, 3500),
                        'is_active' => true,
                        'is_featured' => rand(0, 1),
                    ]
                );

                $product->images()->updateOrCreate(
                    ['image_path' => "products/{$image}"],
                    ['is_primary' => true, 'sort_order' => 0]
                );

                foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size) {
                    $product->variants()->updateOrCreate(
                        ['size' => $size, 'color' => null],
                        ['stock' => 20]
                    );
                }
            }
        }
    }
}
