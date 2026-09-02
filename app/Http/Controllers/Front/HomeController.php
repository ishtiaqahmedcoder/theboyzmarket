<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->withCount('products')
            ->get();

        $featured = Product::query()
            ->where('is_active', true)
            ->where('is_featured', true)
            ->with(['images', 'variants'])
            ->latest()
            ->take(8)
            ->get();

        $newArrivals = Product::query()
            ->where('is_active', true)
            ->with(['images', 'variants'])
            ->latest()
            ->take(8)
            ->get();

        return view('front.home', compact('categories', 'featured', 'newArrivals'));
    }
}
