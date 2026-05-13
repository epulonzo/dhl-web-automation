<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-8 py-3.5 bg-[#FFCC00] border border-transparent rounded-xl font-black text-xs text-black uppercase tracking-widest hover:bg-[#E6B800] focus:bg-[#E6B800] active:bg-[#FFCC00] focus:outline-none focus:ring-2 focus:ring-[#FFCC00] focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-[#FFCC00]/10']) }}>
    {{ $slot }}
</button>
