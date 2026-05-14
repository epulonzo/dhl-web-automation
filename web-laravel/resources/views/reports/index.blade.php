<x-app-layout>
    <div class="mb-10">
        <h1 class="text-4xl font-black text-white tracking-tight mb-2">Performance Reports</h1>
        <p class="text-gray-400 font-medium italic">Phase 1: Statistical summary of logistics incidents</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Incidents by Category -->
        <div class="bg-[#1E2635] p-8 rounded-[24px] shadow-lg border border-[#2A3441]">
            <h3 class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-6 border-b border-[#2A3441] pb-4">By Category</h3>
            <div class="space-y-6">
                @foreach($categorySummary as $item)
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-bold text-gray-300">{{ $item->category }}</span>
                        <span class="text-sm font-black text-[#FFCC00]">{{ $item->total }}</span>
                    </div>
                    <div class="w-full bg-[#141A25] h-2 rounded-full overflow-hidden">
                        <div class="bg-[#FFCC00] h-full shadow-[0_0_8px_rgba(255,204,0,0.3)]" style="width: {{ ($categorySummary->sum('total') > 0) ? ($item->total / $categorySummary->sum('total')) * 100 : 0 }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Incidents by Priority -->
        <div class="bg-[#1E2635] p-8 rounded-[24px] shadow-lg border border-[#2A3441]">
            <h3 class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-6 border-b border-[#2A3441] pb-4">By Priority</h3>
            <div class="space-y-6">
                @foreach($prioritySummary as $item)
                <div class="flex items-center justify-between p-4 bg-[#141A25] rounded-xl border border-[#2A3441]">
                    <span class="text-sm font-bold text-gray-300 flex items-center">
                        <span class="w-2 h-2 rounded-full mr-3 {{ $item->priority == 'Critical' ? 'bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.5)]' : ($item->priority == 'High' ? 'bg-orange-500 shadow-[0_0_8px_rgba(249,115,22,0.5)]' : 'bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.5)]') }}"></span>
                        {{ $item->priority }}
                    </span>
                    <span class="text-sm font-black text-white">{{ $item->total }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Incidents by Status -->
        <div class="bg-[#1E2635] p-8 rounded-[24px] shadow-lg border border-[#2A3441]">
            <h3 class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-6 border-b border-[#2A3441] pb-4">By Status</h3>
            <div class="space-y-6">
                @foreach($statusSummary as $item)
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-bold text-gray-300">{{ $item->status }}</span>
                        <span class="text-sm font-black text-[#FFCC00]">{{ $item->total }}</span>
                    </div>
                    <div class="w-full bg-[#141A25] h-1.5 rounded-full overflow-hidden">
                        <div class="bg-[#FFCC00] h-full rounded-full" style="width: {{ ($statusSummary->sum('total') > 0) ? ($item->total / $statusSummary->sum('total')) * 100 : 0 }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
