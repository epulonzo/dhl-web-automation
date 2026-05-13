@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1']) }}>
    {{ $value ?? $slot }}
</label>
