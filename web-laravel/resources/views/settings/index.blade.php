<x-app-layout>
    <div class="mb-10">
        <h1 class="text-4xl font-black text-white tracking-tight mb-2">System Settings</h1>
        <p class="text-gray-400 font-medium italic">Configure application preferences and user profiles</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Profile Quick Link -->
        <a href="{{ route('profile.edit') }}" class="group bg-[#1E2635] p-10 rounded-[32px] border border-[#2A3441] shadow-lg hover:border-[#FFCC00] hover:shadow-2xl transition-all">
            <div class="w-16 h-16 bg-[#FFCC00]/10 rounded-2xl flex items-center justify-center text-[#FFCC00] mb-8 group-hover:bg-[#FFCC00] group-hover:text-black transition-all">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <h3 class="text-xl font-black text-white mb-2 uppercase tracking-tight">Personal Profile</h3>
            <p class="text-sm font-bold text-gray-400 leading-relaxed uppercase tracking-widest">Update your name, email, and password security settings.</p>
        </a>

        <!-- System Config (Placeholder) -->
        <div class="bg-[#141A25] p-10 rounded-[32px] border border-dashed border-[#2A3441]">
            <div class="w-16 h-16 bg-[#1E2635] rounded-2xl flex items-center justify-center text-gray-700 mb-8">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.543-.426-1.543-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                </svg>
            </div>
            <h3 class="text-xl font-black text-gray-700 mb-2 uppercase tracking-tight">System Configuration</h3>
            <p class="text-[10px] font-black text-gray-600 uppercase tracking-[0.2em]">Restricted to Admin Users</p>
        </div>
    </div>
</x-app-layout>
