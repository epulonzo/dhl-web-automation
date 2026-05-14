<x-app-layout>
    <div class="mb-8">
        <a href="{{ route('incidents.index') }}" class="text-xs font-black text-gray-500 uppercase tracking-widest hover:text-[#FFCC00] transition-colors flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Incidents
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-[#1E2635] rounded-[32px] shadow-lg border border-[#2A3441] p-10">
                <div class="flex items-start justify-between mb-8">
                    <div>
                        <span class="px-4 py-1.5 bg-gray-800 text-gray-300 text-[10px] font-black rounded-lg uppercase tracking-widest border border-gray-700">{{ $incident->category }}</span>
                        <h1 class="text-3xl font-black text-white mt-4 tracking-tight">{{ $incident->title }}</h1>
                        <p class="text-sm text-gray-500 font-bold mt-1">Incident ID: #{{ str_pad($incident->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <span class="px-5 py-2 
                        {{ $incident->priority == 'Critical' ? 'bg-red-500/10 text-red-400 border border-red-500/20' : 
                           ($incident->priority == 'High' ? 'bg-orange-500/10 text-orange-400 border border-orange-500/20' : 
                           ($incident->priority == 'Medium' ? 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20' : 
                           'bg-green-500/10 text-green-400 border border-green-500/20')) }} 
                        text-xs font-black rounded-xl uppercase tracking-widest border">
                        {{ $incident->priority }}
                    </span>
                </div>

                <!-- Phase 2: AI Insights Panel (Llama 3.3 / Groq) -->
                @if($incident->ai_summary)
                <div class="mb-10 p-8 bg-[#141A25] border border-[#FFCC00]/20 rounded-3xl relative overflow-hidden group shadow-inner">
                    <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                        <svg class="w-20 h-20 text-[#FFCC00]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-[#FFCC00] rounded-full flex items-center justify-center text-black shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xs font-black text-[#FFCC00] uppercase tracking-[0.2em]">Groq AI Intelligence</h3>
                    </div>

                    <div class="space-y-6 text-white">
                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">AI Executive Summary</label>
                            <p class="text-lg font-bold text-white leading-snug italic">"{{ $incident->ai_summary }}"</p>
                        </div>

                        <div class="grid grid-cols-2 gap-6 border-t border-[#2A3441] pt-6">
                            <div>
                                <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">AI Classification</label>
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-black text-white">{{ $incident->ai_suggested_category }}</span>
                                    @if($incident->category !== $incident->ai_suggested_category)
                                        <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">AI Priority Check</label>
                                <span class="text-sm font-black 
                                    {{ $incident->ai_suggested_priority == 'Critical' ? 'text-red-400' : 
                                       ($incident->ai_suggested_priority == 'High' ? 'text-orange-400' : 
                                       ($incident->ai_suggested_priority == 'Medium' ? 'text-yellow-400' : 'text-green-400')) }}">
                                    {{ $incident->ai_suggested_priority }}
                                </span>
                            </div>
                        </div>

                        @if(isset($incident->ai_raw_response['insights']))
                        <div class="pt-4 border-t border-[#2A3441]">
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">AI Sentiment Analysis</label>
                            <p class="text-xs text-gray-400 font-medium italic leading-relaxed">{{ $incident->ai_raw_response['insights'] }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <div class="space-y-4">
                    <h3 class="text-xs font-black text-gray-500 uppercase tracking-widest">Detailed Description</h3>
                    <div class="bg-[#141A25] p-6 rounded-2xl border border-[#2A3441] text-base font-medium leading-relaxed text-gray-300">
                        {{ $incident->description }}
                    </div>
                </div>

                @if($incident->attachment)
                <div class="mt-10">
                    <h3 class="text-xs font-black text-gray-500 uppercase tracking-widest mb-4">Evidence / Attachment</h3>
                    <a href="{{ Storage::url($incident->attachment) }}" target="_blank" class="flex items-center p-4 bg-[#141A25] border border-[#2A3441] rounded-2xl hover:border-[#FFCC00] transition-all group shadow-sm">
                        <div class="w-10 h-10 bg-[#FFCC00]/10 rounded-xl flex items-center justify-center text-[#FFCC00] mr-4 group-hover:bg-[#FFCC00] group-hover:text-black transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-black text-white">View Attached Document</span>
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-8">
            <div class="bg-[#1E2635] rounded-[32px] shadow-lg border border-[#2A3441] p-8">
                <h3 class="text-xs font-black text-gray-500 uppercase tracking-widest mb-6 border-b border-[#2A3441] pb-4">Workflow Status</h3>
                
                @if(in_array(Auth::user()->role, ['Admin', 'Manager']))
                <form action="{{ route('incidents.update', $incident) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="title" value="{{ $incident->title }}">
                    <input type="hidden" name="description" value="{{ $incident->description }}">
                    <input type="hidden" name="category" value="{{ $incident->category }}">
                    <input type="hidden" name="priority" value="{{ $incident->priority }}">
                    
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Current Status</label>
                        <select name="status" class="w-full rounded-xl border-[#2A3441] bg-[#141A25] text-white text-sm font-bold focus:ring-[#FFCC00] focus:border-[#FFCC00] py-3 px-4">
                            @foreach(['New', 'Assigned', 'In Progress', 'Resolved', 'Closed'] as $status)
                                <option value="{{ $status }}" {{ $incident->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Tracking Number</label>
                        <div class="text-xl font-black text-[#FFCC00] tracking-tight">{{ $incident->tracking_number ?? 'N/A' }}</div>
                    </div>

                    <button type="submit" class="w-full bg-[#FFCC00] text-black font-black py-4 rounded-2xl hover:bg-[#E6B800] transition-all shadow-lg shadow-[#FFCC00]/10">
                        Update Incident
                    </button>
                </form>
                @else
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Current Status</label>
                        <span class="px-4 py-1.5 bg-gray-800 text-gray-300 text-xs font-black rounded-lg uppercase tracking-widest border border-gray-700">{{ $incident->status }}</span>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Tracking Number</label>
                        <div class="text-xl font-black text-[#FFCC00] tracking-tight">{{ $incident->tracking_number ?? 'N/A' }}</div>
                    </div>
                    <p class="text-[10px] font-bold text-gray-500 italic">Support Staff: Viewing access only.</p>
                </div>
                @endif

                @if(Auth::user()->role === 'Admin')
                <div class="mt-8 pt-8 border-t border-[#2A3441]">
                    <button type="button" onclick="document.getElementById('delete-modal').classList.remove('hidden')" class="w-full text-xs font-black text-red-500/60 uppercase tracking-widest hover:text-red-500 transition-colors">
                        Delete Record
                    </button>

                    <!-- Delete Confirmation Modal -->
                    <div id="delete-modal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <!-- Background overlay -->
                            <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="document.getElementById('delete-modal').classList.add('hidden')"></div>

                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                            <!-- Modal panel -->
                            <div class="inline-block align-bottom bg-[#1E2635] rounded-3xl text-left overflow-hidden shadow-2xl border border-[#2A3441] transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <div class="px-8 pt-8 pb-6">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-red-500/10 border border-red-500/20 sm:mx-0 sm:h-12 sm:w-12">
                                            <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                            </svg>
                                        </div>
                                        <div class="mt-4 text-center sm:mt-0 sm:ml-6 sm:text-left">
                                            <h3 class="text-xl leading-6 font-black text-white" id="modal-title">Delete Incident</h3>
                                            <div class="mt-3">
                                                <p class="text-sm text-gray-400 font-medium">Are you sure you want to permanently delete this incident record? This action cannot be undone.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-[#141A25] px-8 py-5 sm:flex sm:flex-row-reverse border-t border-[#2A3441]">
                                    <form action="{{ route('incidents.destroy', $incident) }}" method="POST" class="m-0 sm:ml-3">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent px-6 py-3 bg-red-500 text-base font-black text-white shadow-sm hover:bg-red-600 focus:outline-none sm:w-auto sm:text-sm transition-colors">
                                            Yes, Delete
                                        </button>
                                    </form>
                                    <button type="button" onclick="document.getElementById('delete-modal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-xl border border-[#2A3441] px-6 py-3 bg-[#1E2635] text-base font-black text-gray-300 shadow-sm hover:bg-[#2A3441] hover:text-white focus:outline-none sm:mt-0 sm:w-auto sm:text-sm transition-all">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
