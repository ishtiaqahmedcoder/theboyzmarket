<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('front.pages.about');
    }

    public function privacyPolicy()
    {
        return view('front.pages.privacy-policy');
    }

    public function terms()
    {
        return view('front.pages.terms');
    }

    public function shippingPolicy()
    {
        return view('front.pages.shipping-policy', [
            'shippingCharge' => (int) Setting::get('shipping_charge', 0),
        ]);
    }

    public function returnPolicy()
    {
        return view('front.pages.return-policy');
    }

    public function faqs()
    {
        return view('front.pages.faqs');
    }

    public function contact()
    {
        return view('front.pages.contact', [
            'whatsappNumber' => Setting::get('whatsapp_number'),
        ]);
    }

    public function trackOrder(Request $request)
    {
        $order = null;
        $searched = false;

        if ($request->filled('order_id') && $request->filled('phone')) {
            $searched = true;

            $order = Order::query()
                ->where('id', $request->input('order_id'))
                ->where('customer_phone', $request->input('phone'))
                ->with('items')
                ->first();
        }

        return view('front.pages.track-order', compact('order', 'searched'));
    }
}
