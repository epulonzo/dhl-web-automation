<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-10">
            <a href="{{ route('users.index') }}" class="text-[10px] font-black text-gray-500 uppercase tracking-widest hover:text-[#FFCC00] transition-colors flex items-center mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Staff List
            </a>
            <h1 class="text-4xl font-black text-white tracking-tight">Edit Staff Member</h1>
            <p class="text-gray-500 font-medium mt-2">Updating profile for: <span class="text-[#FFCC00]">{{ $user->name }}</span></p>
        </div>

        <div class="bg-[#1E2635] rounded-[32px] shadow-lg border border-[#2A3441] p-10 md:p-16">
            <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-2xl border-[#2A3441] bg-[#141A25] text-white text-base font-bold focus:ring-[#FFCC00] focus:border-[#FFCC00] py-4 px-6 shadow-sm transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-2xl border-[#2A3441] bg-[#141A25] text-white text-base font-bold focus:ring-[#FFCC00] focus:border-[#FFCC00] py-4 px-6 shadow-sm transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Role</label>
                        <select name="role" required class="w-full rounded-2xl border-[#2A3441] bg-[#141A25] text-white text-base font-bold focus:ring-[#FFCC00] focus:border-[#FFCC00] py-4 px-6 shadow-sm transition-all">
                            <option value="Support Staff" {{ $user->role == 'Support Staff' ? 'selected' : '' }} class="bg-[#141A25]">Support Staff</option>
                            <option value="Manager" {{ $user->role == 'Manager' ? 'selected' : '' }} class="bg-[#141A25]">Manager</option>
                            <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }} class="bg-[#141A25]">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="pt-8 border-t border-[#2A3441]">
                    <h3 class="text-xs font-black text-[#FFCC00] uppercase tracking-widest mb-6">Security (Optional)</h3>
                    <p class="text-xs text-gray-500 mb-6 font-medium italic">Leave blank to keep existing password</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">New Password</label>
                            <input type="password" name="password" class="w-full rounded-2xl border-[#2A3441] bg-[#141A25] text-white text-base font-bold focus:ring-[#FFCC00] focus:border-[#FFCC00] py-4 px-6 shadow-sm transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="w-full rounded-2xl border-[#2A3441] bg-[#141A25] text-white text-base font-bold focus:ring-[#FFCC00] focus:border-[#FFCC00] py-4 px-6 shadow-sm transition-all">
                        </div>
                    </div>
                </div>

                <div class="pt-10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <a href="{{ route('users.index') }}" class="text-xs font-black text-gray-500 uppercase tracking-widest hover:text-white transition-colors">Cancel</a>
                    <button type="submit" class="w-full md:w-auto bg-[#FFCC00] text-black px-12 py-5 rounded-2xl font-black text-base shadow-xl hover:shadow-2xl transition-all transform hover:scale-[1.02] shadow-[#FFCC00]/10">
                        Update Staff Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
