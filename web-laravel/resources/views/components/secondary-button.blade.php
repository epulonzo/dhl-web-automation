<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-3 bg-[#1E2635] border border-[#2A3441] rounded-xl font-black text-xs text-gray-400 uppercase tracking-widest hover:bg-[#141A25] hover:text-white transition-all shadow-sm']) }}>
    {{ $slot }}
</button>
