<x-legal-page title="Shipping Policy" description="Learn about TheBoyzMarket delivery areas, shipping times and charges across Pakistan.">

    <p>We deliver across Pakistan. Below you will find everything you need to know about our shipping process.</p>

    <h2>Delivery Areas</h2>
    <p>We deliver to all major cities in Pakistan and most other areas through our courier partners.</p>

    <h2>Delivery Time</h2>
    <p>Once your order is confirmed, delivery usually takes <strong>3 to 5 working days</strong>, depending on your city.</p>

    <h2>Shipping Charges</h2>
    <p>A standard shipping charge of <strong>Rs. {{ number_format($shippingCharge) }}</strong> is added to your order total at checkout.</p>

    <h2>Order Tracking</h2>
    <p>Once your order is dispatched, we send tracking details on WhatsApp. You can also check your order status anytime on our <a href="{{ route('pages.track-order') }}">Track Order</a> page.</p>

    <h2>Delayed or Missing Orders</h2>
    <p>If your order has not arrived within the expected time, please contact us on WhatsApp. We will check with our courier partner and update you right away.</p>

</x-legal-page>
