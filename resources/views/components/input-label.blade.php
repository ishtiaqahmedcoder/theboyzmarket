@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-xs uppercase tracking-wide text-gray-800 mb-1']) }}>
    {{ $value ?? $slot }}
</label>
