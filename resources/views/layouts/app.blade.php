<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DHL Smart Incident System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --dhl-yellow: #FFCC00;
                --dhl-red: #d40511;
            }
            .sidebar-active {
                background-color: var(--dhl-yellow);
                color: #1a1c21 !important;
                border-radius: 12px;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#fdfdfd] text-[#1a1c21]">
        <div class="min-h-screen flex flex-col">
            <!-- Top Navigation -->
            <header class="bg-[#FFCC00] h-20 flex items-center justify-between px-8 z-50 sticky top-0 shadow-sm">
                <div class="flex items-center space-x-3">
                    <div class="bg-[#d40511] p-1.5 rounded-lg shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 3h18v18H3V3zm16 16V5H5v14h14zM7 7h10v2H7V7zm0 4h10v2H7v-2zm0 4h7v2H7v-2z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-2xl font-black text-[#d40511] tracking-tighter italic leading-none">DHL</span>
                        <div class="text-[10px] font-bold text-[#1a1c21] tracking-tight uppercase">Incident Reporting System</div>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <button class="text-[#1a1c21] relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-[#d40511] rounded-full border-2 border-[#FFCC00]"></span>
                    </button>

                    <div class="flex items-center bg-white px-4 py-2 rounded-xl shadow-sm space-x-3">
                        <div class="w-8 h-8 bg-[#FFCC00] rounded-full flex items-center justify-center font-bold text-xs">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-bold">{{ Auth::user()->name }}</span>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center space-x-2 text-[#1a1c21] font-bold text-sm hover:text-[#d40511] transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </header>

            <div class="flex flex-1">
                <!-- Sidebar -->
                <aside class="w-72 bg-white border-r border-gray-100 p-6 space-y-8 flex-shrink-0">
                    <nav class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-4 px-4 py-3 text-gray-500 font-bold transition-all {{ request()->routeIs('dashboard') ? 'sidebar-active shadow-lg shadow-[#FFCC00]/20' : 'hover:bg-gray-50 rounded-xl' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('incidents.index') }}" class="flex items-center space-x-4 px-4 py-3 text-gray-500 font-bold transition-all {{ request()->routeIs('incidents.*') ? 'sidebar-active shadow-lg shadow-[#FFCC00]/20' : 'hover:bg-gray-50 rounded-xl' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Incidents</span>
                        </a>

                        @if(Auth::user()->role === 'Admin')
                        <a href="{{ route('users.index') }}" class="flex items-center space-x-4 px-4 py-3 text-gray-500 font-bold transition-all {{ request()->routeIs('users.*') ? 'sidebar-active shadow-lg shadow-[#FFCC00]/20' : 'hover:bg-gray-50 rounded-xl' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <span>Users</span>
                        </a>
                        @endif

                        @if(in_array(Auth::user()->role, ['Admin', 'Manager']))
                        <a href="{{ route('reports.index') }}" class="flex items-center space-x-4 px-4 py-3 text-gray-500 font-bold transition-all {{ request()->routeIs('reports.index') ? 'sidebar-active shadow-lg shadow-[#FFCC00]/20' : 'hover:bg-gray-50 rounded-xl' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Reports</span>
                        </a>
                        @endif

                        <a href="{{ route('settings.index') }}" class="flex items-center space-x-4 px-4 py-3 text-gray-500 font-bold transition-all {{ request()->routeIs('settings.index') ? 'sidebar-active shadow-lg shadow-[#FFCC00]/20' : 'hover:bg-gray-50 rounded-xl' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Settings</span>
                        </a>
                    </nav>

                    <!-- Quick Stats Widget -->
                    <div class="bg-[#FFFCEB] border border-[#FFCC00]/30 rounded-2xl p-5">
                        <div class="text-[#d40511] mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h4 class="font-black text-sm mb-1 uppercase tracking-tight">Quick Stats</h4>
                        <p class="text-[10px] text-gray-500 font-bold uppercase leading-tight">View incident analytics and reports</p>
                    </div>
                </aside>

                <!-- Main Content -->
                <main class="flex-1 p-10 overflow-y-auto">
                    @if (session('success'))
                        <div class="mb-8 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl font-bold text-sm shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>

        <!-- Floating Help Button -->
        <div class="fixed bottom-6 right-6 z-[60]">
            <button class="w-10 h-10 bg-white border border-gray-100 rounded-full flex items-center justify-center shadow-xl text-gray-400 font-bold hover:bg-gray-50">
                ?
            </button>
        </div>
    </body>
</html>
