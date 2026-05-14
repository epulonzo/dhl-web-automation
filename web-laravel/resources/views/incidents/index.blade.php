<x-app-layout>
    <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-white tracking-tight mb-2">All Incidents</h1>
            <p class="text-gray-400 font-medium">Manage and monitor global logistics disruptions</p>
        </div>
        
        <a href="{{ route('incidents.create') }}" class="bg-[#FFCC00] text-black px-8 py-4 rounded-2xl font-black text-sm flex items-center space-x-3 shadow-lg shadow-[#FFCC00]/10 hover:shadow-xl transition-all transform hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Create New Incident</span>
        </a>
    </div>

    <!-- Filters Section -->
    <div class="bg-[#1E2635] p-8 rounded-[24px] shadow-lg border border-[#2A3441] mb-10">
        <form action="{{ route('incidents.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Search Records</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tracking # or Title" 
                    class="w-full rounded-xl border-[#2A3441] bg-[#141A25] text-white text-sm font-bold placeholder-gray-600 focus:ring-[#FFCC00] focus:border-[#FFCC00] py-3 px-4 transition-all">
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Category</label>
                <select name="category" class="w-full rounded-xl border-[#2A3441] bg-[#141A25] text-white text-sm font-bold focus:ring-[#FFCC00] focus:border-[#FFCC00] py-3 px-4 transition-all">
                    <option value="">All Categories</option>
                    @foreach(['Late Delivery', 'Damaged Parcel', 'Missing Parcel', 'Address Issue', 'System Error', 'Customer Complaint'] as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Priority Level</label>
                <select name="priority" class="w-full rounded-xl border-[#2A3441] bg-[#141A25] text-white text-sm font-bold focus:ring-[#FFCC00] focus:border-[#FFCC00] py-3 px-4 transition-all">
                    <option value="">All Priorities</option>
                    <option value="High" {{ request('priority') == 'High' ? 'selected' : '' }}>High</option>
                    <option value="Medium" {{ request('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="Low" {{ request('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-[#FFCC00] text-black font-black py-3.5 rounded-xl hover:bg-[#E6B800] transition-colors shadow-lg shadow-[#FFCC00]/10">Apply Filters</button>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="bg-[#1E2635] rounded-[24px] shadow-lg border border-[#2A3441] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#141A25]">
                    <tr>
                        <th class="px-8 py-5 text-left text-xs font-black text-gray-500 uppercase tracking-widest border-b border-[#2A3441]">Tracking #</th>
                        <th class="px-8 py-5 text-left text-xs font-black text-gray-500 uppercase tracking-widest border-b border-[#2A3441]">Incident Details</th>
                        <th class="px-8 py-5 text-left text-xs font-black text-gray-500 uppercase tracking-widest border-b border-[#2A3441]">Priority</th>
                        <th class="px-8 py-5 text-left text-xs font-black text-gray-500 uppercase tracking-widest border-b border-[#2A3441]">Status</th>
                        <th class="px-8 py-5 text-right text-xs font-black text-gray-500 uppercase tracking-widest border-b border-[#2A3441]">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#2A3441]">
                    @forelse($incidents as $incident)
                    <tr class="hover:bg-[#141A25] transition-colors">
                        <td class="px-8 py-6 whitespace-nowrap text-sm font-black text-[#FFCC00]">{{ $incident->tracking_number ?? 'N/A' }}</td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-white mb-1">{{ $incident->title }}</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">{{ $incident->category }} • {{ $incident->created_at->timezone('Asia/Kuala_Lumpur')->format('M d, Y, h:i A') }}</div>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <span class="px-4 py-1 text-[10px] font-black uppercase rounded-lg 
                                {{ $incident->priority == 'Critical' ? 'bg-red-500/10 text-red-400 border border-red-500/20' : 
                                   ($incident->priority == 'High' ? 'bg-orange-500/10 text-orange-400 border border-orange-500/20' : 
                                   ($incident->priority == 'Medium' ? 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20' : 
                                   'bg-green-500/10 text-green-400 border border-green-500/20')) }}">
                                {{ $incident->priority }}
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            <span class="px-4 py-1 text-[10px] font-black uppercase rounded-lg bg-gray-800 text-gray-300 border border-gray-700">
                                {{ $incident->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap text-right">
                            <a href="{{ route('incidents.show', $incident) }}" class="text-xs font-black text-[#FFCC00] hover:text-[#E6B800] uppercase tracking-widest border-b-2 border-transparent hover:border-[#FFCC00] pb-1 transition-all">View Case</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center text-gray-500 font-bold italic uppercase tracking-widest">No matching incidents found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($incidents->hasPages())
        <div class="p-8 bg-[#141A25] border-t border-[#2A3441]">
            <div class="text-white">
                {{ $incidents->links() }}
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
