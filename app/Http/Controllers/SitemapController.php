<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = collect();

        $urls->push(['loc' => route('home'), 'priority' => '1.0']);
        $urls->push(['loc' => route('products.index'), 'priority' => '0.9']);
        $urls->push(['loc' => route('pages.about'), 'priority' => '0.5']);
        $urls->push(['loc' => route('pages.contact'), 'priority' => '0.5']);
        $urls->push(['loc' => route('pages.faqs'), 'priority' => '0.5']);
        $urls->push(['loc' => route('pages.shipping'), 'priority' => '0.4']);
        $urls->push(['loc' => route('pages.returns'), 'priority' => '0.4']);
        $urls->push(['loc' => route('pages.terms'), 'priority' => '0.3']);
        $urls->push(['loc' => route('pages.privacy'), 'priority' => '0.3']);

        Category::query()->where('is_active', true)->each(function (Category $category) use ($urls) {
            $urls->push([
                'loc' => route('products.index', ['category' => $category->slug]),
                'priority' => '0.8',
            ]);
        });

        Product::query()->where('is_active', true)->each(function (Product $product) use ($urls) {
            $urls->push([
                'loc' => route('products.show', $product),
                'priority' => '0.7',
                'lastmod' => $product->updated_at->toAtomString(),
            ]);
        });

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }
}
