<x-app-layout>
    <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-white tracking-tight mb-2">User Management</h1>
            <p class="text-gray-400 font-medium">Manage access and roles for DHL Support Staff</p>
        </div>
        
        <a href="{{ route('users.create') }}" class="bg-[#FFCC00] text-black px-8 py-4 rounded-2xl font-black text-sm flex items-center space-x-3 shadow-lg shadow-[#FFCC00]/10 hover:shadow-xl transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            <span>Add New Staff</span>
        </a>
    </div>

    <div class="bg-[#1E2635] rounded-[24px] shadow-lg border border-[#2A3441] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#141A25]">
                    <tr>
                        <th class="px-8 py-5 text-left text-xs font-black text-gray-500 uppercase tracking-widest border-b border-[#2A3441]">Name</th>
                        <th class="px-8 py-5 text-left text-xs font-black text-gray-500 uppercase tracking-widest border-b border-[#2A3441]">Email</th>
                        <th class="px-8 py-5 text-left text-xs font-black text-gray-500 uppercase tracking-widest border-b border-[#2A3441]">Role</th>
                        <th class="px-8 py-5 text-right text-xs font-black text-gray-500 uppercase tracking-widest border-b border-[#2A3441]">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#2A3441]">
                    @foreach($users as $user)
                    <tr class="hover:bg-[#141A25] transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-[#FFCC00] rounded-full flex items-center justify-center font-bold text-xs text-black">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-bold text-white">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-sm font-medium text-gray-400">{{ $user->email }}</td>
                        <td class="px-8 py-6">
                            <span class="px-4 py-1 text-[10px] font-black uppercase rounded-lg {{ $user->role == 'Admin' ? 'bg-red-500/10 text-red-400 border border-red-500/20' : ($user->role == 'Manager' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' : 'bg-gray-800 text-gray-400 border border-gray-700') }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right space-x-4">
                            <a href="{{ route('users.edit', $user) }}" class="text-xs font-black text-gray-500 hover:text-[#FFCC00] uppercase tracking-widest transition-colors">Edit</a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-black text-red-500/60 hover:text-red-500 uppercase tracking-widest transition-colors" onclick="return confirm('Delete this user?')">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="p-8 bg-[#141A25] border-t border-[#2A3441]">
            <div class="text-white">
                {{ $users->links() }}
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
