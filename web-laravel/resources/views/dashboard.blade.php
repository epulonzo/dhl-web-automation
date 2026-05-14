<x-app-layout>
    <div class="mb-10">
        <h1 class="text-4xl font-black text-white tracking-tight mb-2">Dashboard Overview</h1>
        <p class="text-gray-400 font-medium">Monitor and manage incident reports in real-time</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Total Incidents -->
        <div class="bg-[#1E2635] p-8 rounded-[24px] border border-[#2A3441] hover:border-[#FFCC00] transition-all shadow-lg group relative overflow-hidden">
            <div class="w-12 h-12 bg-[#FFCC00] rounded-xl flex items-center justify-center mb-6 shadow-sm">
                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div class="text-gray-400 text-sm font-bold uppercase tracking-wider mb-1">Total Incidents</div>
            <div class="text-4xl font-black text-white">{{ $stats['total'] }}</div>
            <div class="absolute top-8 right-8 text-green-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-[#1E2635] p-8 rounded-[24px] border border-[#2A3441] hover:border-[#FFCC00] transition-all shadow-lg group relative overflow-hidden">
            <div class="w-12 h-12 bg-[#FFCC00]/10 rounded-xl flex items-center justify-center mb-6 border border-[#FFCC00]/20">
                <svg class="w-6 h-6 text-[#FFCC00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="text-gray-400 text-sm font-bold uppercase tracking-wider mb-1">Pending</div>
            <div class="text-4xl font-black text-white">{{ $stats['pending'] }}</div>
        </div>

        <!-- In Progress -->
        <div class="bg-[#1E2635] p-8 rounded-[24px] border border-[#2A3441] hover:border-[#FFCC00] transition-all shadow-lg group relative overflow-hidden">
            <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center mb-6 border border-blue-500/20">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="text-gray-400 text-sm font-bold uppercase tracking-wider mb-1">In Progress</div>
            <div class="text-4xl font-black text-white">1</div>
        </div>

        <!-- Resolved -->
        <div class="bg-[#1E2635] p-8 rounded-[24px] border border-[#2A3441] hover:border-[#FFCC00] transition-all shadow-lg group relative overflow-hidden">
            <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center mb-6 border border-green-500/20">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="text-gray-400 text-sm font-bold uppercase tracking-wider mb-1">Resolved</div>
            <div class="text-4xl font-black text-white">{{ $stats['resolved'] }}</div>
        </div>
    </div>

    <!-- Alert / High Priority -->
    @if($stats['high_priority'] > 0)
    <div class="bg-red-500/10 border border-red-500/20 rounded-[24px] p-6 mb-10 flex items-center justify-between shadow-lg">
        <div class="flex items-center space-x-6">
            <div class="w-12 h-12 bg-red-500/20 rounded-full flex items-center justify-center text-red-400 shadow-sm border border-red-500/30">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-black text-red-400">High Priority Incidents</h3>
                <p class="text-red-300/80 font-medium text-sm">You have {{ $stats['high_priority'] }} high or critical priority incidents requiring immediate attention</p>
            </div>
        </div>
        <a href="{{ route('incidents.index', ['priority' => 'High']) }}" class="bg-red-500 text-white hover:bg-red-600 px-6 py-2.5 rounded-xl font-black text-sm flex items-center space-x-2 shadow-md transition-all">
            <span>View All</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
    @endif

    <!-- Recent Incidents -->
    <div class="bg-[#1E2635] rounded-[24px] shadow-lg border border-[#2A3441] overflow-hidden">
        <div class="p-8 border-b border-[#2A3441] flex items-center justify-between">
            <h3 class="text-xl font-black text-white">Recent Incidents</h3>
            <a href="{{ route('incidents.index') }}" class="bg-[#2A3441] text-white hover:bg-[#374151] px-6 py-2.5 rounded-xl font-black text-sm flex items-center space-x-2 shadow-md transition-all">
                <span>View All</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#141A25]">
                    <tr>
                        <th class="px-8 py-4 text-left text-xs font-black text-gray-500 uppercase tracking-widest border-b border-[#2A3441]">Tracking #</th>
                        <th class="px-8 py-4 text-left text-xs font-black text-gray-500 uppercase tracking-widest border-b border-[#2A3441]">Incident</th>
                        <th class="px-8 py-4 text-left text-xs font-black text-gray-500 uppercase tracking-widest border-b border-[#2A3441]">Status</th>
                        <th class="px-8 py-4 text-right text-xs font-black text-gray-500 uppercase tracking-widest border-b border-[#2A3441]">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#2A3441]">
                    @foreach($recentIncidents as $incident)
                    <tr class="hover:bg-[#141A25] transition-colors">
                        <td class="px-8 py-5 text-sm font-black text-[#FFCC00]">{{ $incident->tracking_number ?? 'N/A' }}</td>
                        <td class="px-8 py-5">
                            <div class="text-sm font-bold text-white">{{ $incident->title }}</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">{{ $incident->category }}</div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 text-[10px] font-black uppercase rounded-lg 
                                {{ $incident->priority == 'Critical' ? 'bg-red-500/10 text-red-400 border border-red-500/20' : 
                                   ($incident->priority == 'High' ? 'bg-orange-500/10 text-orange-400 border border-orange-500/20' : 
                                   ($incident->priority == 'Medium' ? 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20' : 
                                   'bg-green-500/10 text-green-400 border border-green-500/20')) }}">
                                {{ $incident->status }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <a href="{{ route('incidents.show', $incident) }}" class="text-xs font-black text-[#FFCC00] hover:text-[#E6B800] uppercase tracking-widest">Manage</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
