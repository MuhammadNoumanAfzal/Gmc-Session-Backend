<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Sora:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Check local storage or system preference to apply dark mode before page load
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        tailwind.config = {
            darkMode: 'class', // Enable class-based dark mode toggle
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Manrope', 'sans-serif'],
                        sora: ['Sora', 'sans-serif'],
                    },
                    colors: {
                        gmcBlue: '#0e3d81',      // GMC Logo Dark Blue / Navy
                        gmcBlueDark: '#0a2a5a',  
                        gmcGreen: '#39b54a',     // GMC Logo Bright Green
                        gmcGreenDark: '#2c8f3a',
                        gmcBg: '#f8fafc',
                        gmcPanel: '#ffffff',
                        gmcBorder: '#e2e8f0',
                        gmcText: '#0f172a',
                        gmcMuted: '#64748b',
                        gmcGold: '#b45309',
                    }
                }
            }
        }
    </script>
    
    <!-- FontAwesome v6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <title>GMC Session Admin Panel</title>

    <style>
        /* Modern Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        .dark ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #334155;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        .dark ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
    </style>

    @yield('style')
</head>
<body class="h-full font-sans antialiased text-slate-800 dark:text-slate-100 bg-slate-50 dark:bg-slate-950 transition-colors duration-200">

    <!-- Main Wrapper -->
    <div class="min-h-full">
        
        <!-- Sidebar Navigation Panel (Responsive, Light & Dark Theme) -->
        <aside class="fixed inset-y-0 left-0 z-30 w-64 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 flex flex-col transition-colors duration-200">
            <!-- Brand Header -->
            <div class="h-16 flex items-center px-6 border-b border-slate-100 dark:border-slate-800/60 bg-white dark:bg-slate-900 transition-colors duration-200">
                <a href="{{ url('admin/dashboard') }}" class="flex items-center space-x-2.5">
                    <!-- GMC Primary Logo Gradient -->
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-gmcBlue to-gmcGreen flex items-center justify-center text-white shadow-md shadow-blue-200 dark:shadow-none">
                        <i class="fa-solid fa-graduation-cap text-sm"></i>
                    </div>
                    <span class="font-sora font-extrabold text-lg text-slate-850 dark:text-white tracking-tight">GMC Sessions</span>
                </a>
            </div>
            
            <!-- Sidebar Nav Links -->
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                <div class="px-3 mb-2 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Navigation</div>
                
                @if(auth()->user()->hasPermission('dashboard'))
                <!-- Link: Dashboard -->
                <a href="{{ url('admin/dashboard') }}" 
                   class="group flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'dashboard' ? 'bg-blue-50/70 text-gmcBlue dark:bg-blue-950/20 dark:text-blue-400 font-bold border-l-4 border-gmcBlue' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-white' }}">
                    <i class="fa-solid fa-chart-pie mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'dashboard' ? 'text-gmcBlue dark:text-blue-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}"></i>
                    Dashboard
                </a>
                @endif
                
                @if(auth()->user()->hasPermission('proofs'))
                <!-- Link: Payment Proofs -->
                <a href="{{ url('admin/payment-proofs/index') }}" 
                   class="group flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'payment_proofs' ? 'bg-blue-50/70 text-gmcBlue dark:bg-blue-950/20 dark:text-blue-400 font-bold border-l-4 border-gmcBlue' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-white' }}">
                    <i class="fa-solid fa-file-invoice-dollar mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'payment_proofs' ? 'text-gmcBlue dark:text-blue-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}"></i>
                    Payment Proofs
                </a>
                @endif
                
                @if(auth()->user()->hasPermission('sizes'))
                <!-- Link: Sizes -->
                <a href="{{ url('admin/size/index') }}" 
                   class="group flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'size' ? 'bg-blue-50/70 text-gmcBlue dark:bg-blue-950/20 dark:text-blue-400 font-bold border-l-4 border-gmcBlue' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-white' }}">
                    <i class="fa-solid fa-ruler-combined mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'size' ? 'text-gmcBlue dark:text-blue-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}"></i>
                    Size Parameters
                </a>
                @endif

                @if(auth()->user()->role === 'owner')
                <!-- Link: Account Settings -->
                <a href="{{ url('admin/settings') }}" 
                   class="group flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'settings' ? 'bg-blue-50/70 text-gmcBlue dark:bg-blue-950/20 dark:text-blue-400 font-bold border-l-4 border-gmcBlue' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-white' }}">
                    <i class="fa-solid fa-gears mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'settings' ? 'text-gmcBlue dark:text-blue-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}"></i>
                    Account Settings
                </a>

                <!-- Link: Employee Control -->
                <a href="{{ url('admin/employees') }}" 
                   class="group flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'employees' ? 'bg-blue-50/70 text-gmcBlue dark:bg-blue-950/20 dark:text-blue-400 font-bold border-l-4 border-gmcBlue' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-slate-900 dark:hover:text-white' }}">
                    <i class="fa-solid fa-users-gear mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'employees' ? 'text-gmcBlue dark:text-blue-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300' }}"></i>
                    Employee Control
                </a>
                @endif

                <!-- Action: Logout -->
                <a href="{{ route('logout') }}" 
                   class="group flex items-center px-3.5 py-3 text-sm font-medium rounded-xl text-red-650 hover:bg-red-50 dark:hover:bg-red-950/20 hover:text-red-700 dark:hover:text-red-400 transition-all duration-150">
                    <i class="fa-solid fa-right-from-bracket mr-3 text-lg transition-transform group-hover:translate-x-0.5 text-red-500 dark:text-red-400"></i>
                    Logout Session
                </a>
            </nav>
            
            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-full bg-blue-100 dark:bg-blue-950 flex items-center justify-center text-gmcBlue dark:text-blue-400 font-bold text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="text-xs font-bold text-slate-800 dark:text-slate-200 truncate max-w-[130px]">{{ auth()->user()->name }}</div>
                        <div class="text-[10px] text-slate-400 dark:text-slate-500 font-semibold truncate max-w-[130px]">{{ auth()->user()->email }}</div>
                    </div>
                </div>
            </div>
        </aside>
        
        <!-- Top Navbar Header -->
        <header class="fixed top-0 right-0 left-64 h-16 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 z-20 flex items-center justify-between px-8 transition-colors duration-200">
            <!-- Left Header: Breadcrumbs -->
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ url('admin/dashboard') }}" class="text-slate-400 hover:text-gmcBlue dark:hover:text-blue-400 transition-colors font-medium">Home</a>
                <span class="text-slate-300 dark:text-slate-700">/</span>
                <span class="text-slate-700 dark:text-slate-300 font-semibold">{{ $heading }}</span>
            </div>
            
            <!-- Right Header: User Actions + Theme Toggle -->
            <div class="flex items-center space-x-4">
                
                <!-- Dynamic Theme Switcher Button -->
                <button id="theme-toggle" class="p-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all focus:outline-none" title="Toggle Light / Dark Mode">
                    <i id="theme-toggle-dark-icon" class="fa-solid fa-moon text-base hidden"></i>
                    <i id="theme-toggle-light-icon" class="fa-solid fa-sun text-base hidden text-amber-500"></i>
                </button>
                
                <div class="text-right hidden sm:block">
                    <span class="block text-xs font-bold text-slate-800 dark:text-slate-200">{{ auth()->user()->name }}</span>
                    <span class="block text-[10px] text-slate-400 dark:text-slate-500 font-semibold uppercase tracking-wider">
                        {{ auth()->user()->role === 'owner' ? 'System Owner' : 'Revenue Officer' }}
                    </span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-650 dark:text-slate-350 font-bold">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
        </header>
        
        <!-- Content Container -->
        <main class="pl-64 min-h-screen bg-slate-50 dark:bg-slate-950 transition-colors duration-200">
            <div class="pt-20 px-8 pb-12 max-w-[1600px] mx-auto">
                
                <!-- Dynamic Page Header -->
                <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-black font-sora text-slate-800 dark:text-white tracking-tight">{{ $heading }}</h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 font-medium">{{ $title ?? 'Manage your administration workspace.' }}</p>
                    </div>
                </div>
                
                <!-- Main Blade Content Injection -->
                @yield('content')
                
            </div>
        </main>
        
    </div>

    <!-- Theme Toggle Javascript Handler -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');

            // Setup icons initially based on active document class state
            if (document.documentElement.classList.contains('dark')) {
                lightIcon.classList.remove('hidden');
            } else {
                darkIcon.classList.remove('hidden');
            }

            themeToggleBtn.addEventListener('click', function() {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.theme = 'light';
                    lightIcon.classList.add('hidden');
                    darkIcon.classList.remove('hidden');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.theme = 'dark';
                    darkIcon.classList.add('hidden');
                    lightIcon.classList.remove('hidden');
                }
                
                // Dispatch window event so that any charts on page re-render with the correct theme colors!
                window.dispatchEvent(new Event('theme-changed'));
            });
        });
    </script>

    @yield('script')
</body>
</html>
