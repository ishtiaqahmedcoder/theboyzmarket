<x-shop-layout title="Contact Us" description="Get in touch with TheBoyzMarket on WhatsApp or email for order support and general questions.">

    <div class="bg-black">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-white text-3xl sm:text-4xl font-extrabold">Contact Us</h1>
            <p class="text-gray-400 mt-2">Have a question or need help with an order? Send us a message.</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="border rounded-xl p-6 text-center">
                <div class="h-12 w-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6 fill-current"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.001 2C6.478 2 2 6.477 2 12c0 1.982.578 3.83 1.573 5.385L2 22l4.735-1.545A9.953 9.953 0 0012.001 22C17.523 22 22 17.523 22 12S17.523 2 12.001 2zm0 18.13a8.106 8.106 0 01-4.375-1.278l-.313-.187-2.812.918.929-2.74-.204-.323A8.106 8.106 0 013.87 12c0-4.484 3.647-8.13 8.131-8.13 4.484 0 8.13 3.646 8.13 8.13 0 4.484-3.646 8.13-8.13 8.13z"/></svg>
                </div>
                <h3 class="font-semibold mb-1">WhatsApp</h3>
                <p class="text-sm text-gray-500 mb-3">Fastest way to reach us</p>
                <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="text-sm font-semibold underline">0{{ substr($whatsappNumber, 2) }}</a>
            </div>

            <div class="border rounded-xl p-6 text-center">
                <div class="h-12 w-12 rounded-full bg-gray-100 text-gray-700 flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
                <h3 class="font-semibold mb-1">Email</h3>
                <p class="text-sm text-gray-500 mb-3">We reply within 24 hours</p>
                <a href="mailto:support@theboyzmarket.com" class="text-sm font-semibold underline">support@theboyzmarket.com</a>
            </div>

            <div class="border rounded-xl p-6 text-center">
                <div class="h-12 w-12 rounded-full bg-gray-100 text-gray-700 flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="font-semibold mb-1">Support Hours</h3>
                <p class="text-sm text-gray-500">Monday to Saturday<br>10:00 AM to 7:00 PM</p>
            </div>
        </div>

        <div class="mt-10 text-center">
            <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="inline-flex items-center gap-2 bg-green-500 text-white font-semibold px-8 py-3 rounded-full hover:bg-green-600">
                Chat on WhatsApp
            </a>
        </div>
    </div>

</x-shop-layout>
