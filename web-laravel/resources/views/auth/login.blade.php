<x-guest-layout>
    <div class="min-h-screen flex w-full">
        <!-- Left Panel: Branding & Marketing -->
        <div class="hidden lg:flex flex-col justify-between w-1/2 p-16 relative overflow-hidden bg-[#0a0a0a]">
            <!-- Subtle Gold Glow Background -->
            <div class="absolute top-1/4 right-0 w-96 h-96 bg-[#FFCC00] rounded-full mix-blend-screen filter blur-[150px] opacity-20"></div>

            <div class="relative z-10">
                <div class="flex items-center mb-24">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/DHL_Logo.svg" alt="DHL Logo" class="h-10 rounded-sm shadow-xl">
                </div>

                <h1 class="text-6xl font-black text-white leading-[1.1] tracking-tight mb-8">
                    Incident Reporting<br>System
                </h1>
                
                <p class="text-xl text-gray-400 font-medium leading-relaxed max-w-md mb-12">
                    Automating incident collection, classification, and tracking for faster resolution
                </p>

                <div class="flex items-center space-x-4 bg-white/5 border border-white/10 p-4 rounded-2xl max-w-md backdrop-blur-sm">
                    <div class="w-10 h-10 rounded-xl bg-[#FFCC00]/10 flex items-center justify-center border border-[#FFCC00]/20">
                        <svg class="w-5 h-5 text-[#FFCC00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <span class="text-gray-300 font-medium">Excellence. Simply Delivered.</span>
                </div>
            </div>

            <div class="relative z-10 text-sm text-gray-600 font-medium">
                DHL APSSC | Digital Automation Challenge 2026
            </div>
        </div>

        <!-- Right Panel: Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-24 bg-[#141A25]">
            <div class="w-full max-w-md">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-black text-white mb-3 tracking-tight">Welcome back</h2>
                    <p class="text-gray-400 text-sm font-medium">Sign in to access the incident reporting system</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address (Labelled as Username in design) -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-bold text-gray-300">Username</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            placeholder="Enter your username"
                            class="w-full rounded-xl bg-[#1E2635] border border-gray-700/50 text-white placeholder-gray-500 focus:ring-2 focus:ring-[#FFCC00] focus:border-transparent transition-all py-3.5 px-4">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-bold text-gray-300">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full rounded-xl bg-[#1E2635] border border-gray-700/50 text-white placeholder-gray-500 focus:ring-2 focus:ring-[#FFCC00] focus:border-transparent transition-all py-3.5 px-4">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-[#FFCC00] text-black font-black py-3.5 rounded-xl hover:bg-[#E6B800] transition-colors shadow-lg shadow-[#FFCC00]/10">
                            Sign In
                        </button>
                    </div>

                    <div class="text-center pt-6">
                        <p class="text-xs text-gray-500 font-medium">Demo: Use any username and password to login</p>
                    </div>
                </form>
            </div>
            
            <!-- Help Icon -->
            <div class="absolute bottom-8 right-8 w-10 h-10 bg-white rounded-full flex items-center justify-center text-black font-bold shadow-lg hover:bg-gray-100 cursor-pointer transition-colors">
                ?
            </div>
        </div>
    </div>
</x-guest-layout>
