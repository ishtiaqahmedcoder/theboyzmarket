@props(['title', 'description' => null])

<x-shop-layout :title="$title" :description="$description">

    <div class="bg-black">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-white text-3xl sm:text-4xl font-extrabold">{{ $title }}</h1>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="prose prose-sm sm:prose-base max-w-none prose-headings:font-bold prose-a:text-black">
            {{ $slot }}
        </div>
    </div>

</x-shop-layout>
