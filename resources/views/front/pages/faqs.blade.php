<x-legal-page title="FAQs" description="Frequently asked questions about ordering, payment, delivery and exchanges at TheBoyzMarket.">

    <div class="space-y-8 not-prose">
        @php
            $faqs = [
                ['How do I place an order?', 'Select a product, choose your size and color, tap "Add to Cart" or "Buy Now", fill in the checkout form, and confirm your order on WhatsApp once it is placed.'],
                ['Do you accept online payment?', 'No, we do not accept online payment. Payment is made only via Cash on Delivery or manual bank transfer, which is confirmed after your order is placed on WhatsApp.'],
                ['How long does delivery take?', 'Delivery usually takes 3 to 5 working days once your order is confirmed.'],
                ['Can I exchange a product?', 'Yes, exchanges are available within 7 days of delivery, provided the product is unused and the tags are still attached. See our Return and Exchange Policy for full details.'],
                ['What sizes are available?', 'All our products are available in sizes S, M, L, XL and XXL.'],
                ['How do I track my order?', 'Enter your Order Number and Phone Number on the Track Order page to see your order status.'],
                ['Do you deliver across Pakistan?', 'Yes, we deliver to all major cities in Pakistan and most other areas.'],
            ];
        @endphp

        @foreach($faqs as [$question, $answer])
            <div class="border-b border-gray-200 pb-6">
                <h3 class="font-bold text-lg mb-2">{{ $question }}</h3>
                <p class="text-gray-600">{{ $answer }}</p>
            </div>
        @endforeach

        <div class="text-center pt-4">
            <p class="text-gray-500 mb-4">Still have a question?</p>
            <a href="{{ route('pages.contact') }}" class="inline-block bg-black text-white font-semibold px-8 py-3 rounded-full hover:bg-gray-800">Contact Us</a>
        </div>
    </div>

</x-legal-page>
