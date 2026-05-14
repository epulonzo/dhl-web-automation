<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>DHL Smart Incident System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Inter', sans-serif; background-color: #0B1120; color: #ffffff; }
            .sidebar-active { background-color: #FFCC00 !important; color: #000000 !important; }
            .sidebar-active svg { color: #000000 !important; }
        </style>
    </head>
    <body class="font-sans antialiased text-white bg-[#0B1120]">
        <div class="flex h-screen overflow-hidden">
            
            <!-- Sidebar -->
            <aside class="w-72 bg-[#141A25] border-r border-[#2A3441] flex flex-col hidden md:flex">
                <!-- Logo -->
                <div class="h-24 flex items-center px-8 border-b border-[#2A3441]">
                    <div class="flex items-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/DHL_Logo.svg" alt="DHL Logo" class="h-8 rounded-sm shadow-lg">
                    </div>
                </div>

                <!-- Nav Links -->
                <div class="flex-1 overflow-y-auto py-8 px-4">
                    <div class="mb-4 px-4 text-xs font-black text-gray-500 uppercase tracking-widest">Main Menu</div>
                    
                    <nav class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-4 px-4 py-3 text-gray-400 font-bold transition-all {{ request()->routeIs('dashboard') ? 'sidebar-active rounded-xl shadow-lg shadow-[#FFCC00]/10' : 'hover:bg-[#1E2635] hover:text-white rounded-xl' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('incidents.index') }}" class="flex items-center space-x-4 px-4 py-3 text-gray-400 font-bold transition-all {{ request()->routeIs('incidents.*') ? 'sidebar-active rounded-xl shadow-lg shadow-[#FFCC00]/10' : 'hover:bg-[#1E2635] hover:text-white rounded-xl' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Incidents</span>
                        </a>

                        @if(Auth::user()->role === 'Admin')
                        <a href="{{ route('users.index') }}" class="flex items-center space-x-4 px-4 py-3 text-gray-400 font-bold transition-all {{ request()->routeIs('users.*') ? 'sidebar-active rounded-xl shadow-lg shadow-[#FFCC00]/10' : 'hover:bg-[#1E2635] hover:text-white rounded-xl' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <span>Users</span>
                        </a>
                        @endif

                        @if(in_array(Auth::user()->role, ['Admin', 'Manager']))
                        <a href="{{ route('reports.index') }}" class="flex items-center space-x-4 px-4 py-3 text-gray-400 font-bold transition-all {{ request()->routeIs('reports.index') ? 'sidebar-active rounded-xl shadow-lg shadow-[#FFCC00]/10' : 'hover:bg-[#1E2635] hover:text-white rounded-xl' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Reports</span>
                        </a>
                        @endif

                        <a href="{{ route('settings.index') }}" class="flex items-center space-x-4 px-4 py-3 text-gray-400 font-bold transition-all {{ request()->routeIs('settings.index') ? 'sidebar-active rounded-xl shadow-lg shadow-[#FFCC00]/10' : 'hover:bg-[#1E2635] hover:text-white rounded-xl' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Settings</span>
                        </a>
                    </nav>
                </div>

                <!-- User Profile & Logout -->
                <div class="p-6 border-t border-[#2A3441]">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-[#1E2635] flex items-center justify-center text-white font-bold border border-[#2A3441]">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-white">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="p-2 text-gray-400 hover:text-[#FFCC00] hover:bg-[#1E2635] rounded-xl transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 flex flex-col h-screen overflow-hidden bg-[#0B1120]">
                <!-- Header (Mobile mostly + Breadcrumbs) -->
                <header class="h-24 bg-[#141A25]/80 backdrop-blur-md border-b border-[#2A3441] flex items-center justify-between px-8 z-10 sticky top-0">
                    <div class="flex items-center">
                        <h2 class="text-xl font-black text-white tracking-tight">DHL Smart Incident Hub</h2>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('incidents.create') }}" class="bg-[#FFCC00] text-black px-6 py-2.5 rounded-xl font-black text-sm hover:bg-[#E6B800] transition-colors shadow-lg shadow-[#FFCC00]/10 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                            Report Issue
                        </a>
                    </div>
                </header>

                <!-- Page Content -->
                <div class="flex-1 overflow-y-auto p-8 lg:p-12">
                    <!-- Notifications -->
                    @if (session('success'))
                        <div class="mb-8 bg-green-500/10 border border-green-500/20 text-green-400 px-6 py-4 rounded-2xl flex items-center font-bold">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-8 bg-red-500/10 border border-red-500/20 text-red-400 px-6 py-4 rounded-2xl flex items-center font-bold">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
