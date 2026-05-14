@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-xl border-[#2A3441] bg-[#141A25] text-white text-base font-bold placeholder-gray-600 focus:ring-[#FFCC00] focus:border-[#FFCC00] shadow-sm transition-all']) !!}>
