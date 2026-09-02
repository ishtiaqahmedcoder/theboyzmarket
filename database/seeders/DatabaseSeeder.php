<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@theboyzmarket.com'],
            [
                'name' => 'Admin',
                'password' => 'password',
                'is_admin' => true,
            ]
        );

        collect([
            'T-Shirts' => 'categories/t-shirts.jpg',
            'Drop Shoulder' => 'categories/drop-shoulder.jpg',
            'Painted T-Shirts' => 'categories/painted-t-shirts.jpg',
            'Trouser' => 'categories/trouser.jpg',
            'Hoodie' => 'categories/hoodie.jpg',
        ])->each(fn (string $image, string $name) => Category::query()->updateOrCreate(
            ['slug' => Str::slug($name)],
            ['name' => $name, 'image' => $image, 'is_active' => true]
        ));

        Setting::set('store_name', 'TheBoyzMarket');
        Setting::set('whatsapp_number', config('services.whatsapp.number', '923022183894'));
        Setting::set('shipping_charge', '200');

        $this->call(ProductSeeder::class);
    }
}
