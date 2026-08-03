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
        // Default to dark mode for the luxury SaaS admin theme unless light is explicitly chosen
        if (localStorage.theme === 'dark' || !('theme' in localStorage)) {
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
                        gmcBlue: '#8b5cf6',
                        gmcBlueDark: '#6d28d9',
                        gmcGreen: '#c084fc',
                        gmcGreenDark: '#a855f7',
                        gmcBg: '#f5f3ff',
                        gmcPanel: '#ffffff',
                        gmcBorder: '#ddd6fe',
                        gmcText: '#1e1b4b',
                        gmcMuted: '#7c6fa5',
                        gmcGold: '#f4c56a',
                        slate: {
                            50: '#f8f5ff',
                            100: '#f1eaff',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#2a1f45',
                            850: '#b6abd7',
                            855: '#d2c7f0',
                            900: '#140f24',
                            950: '#090611',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- FontAwesome v6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
            background: #4c3b72;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a78bfa;
        }
        .dark ::-webkit-scrollbar-thumb:hover {
            background: #8b5cf6;
        }
        body {
            background-image:
                radial-gradient(circle at top left, rgba(139, 92, 246, 0.10), transparent 32%),
                radial-gradient(circle at 82% 18%, rgba(192, 132, 252, 0.10), transparent 24%),
                linear-gradient(180deg, rgba(248, 245, 255, 0.92) 0%, rgba(255, 255, 255, 1) 48%);
        }
        .dark body {
            background-image:
                radial-gradient(circle at top left, rgba(139, 92, 246, 0.28), transparent 34%),
                radial-gradient(circle at 80% 20%, rgba(192, 132, 252, 0.16), transparent 28%),
                linear-gradient(180deg, rgba(28, 20, 48, 0.94) 0%, rgba(9, 6, 17, 1) 56%);
        }

        .admin-glow {
            box-shadow:
                0 24px 80px rgba(6, 3, 14, 0.42),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
        }

        .admin-panel {
            backdrop-filter: blur(18px);
        }

        .dark .admin-panel {
            background: linear-gradient(180deg, rgba(20, 15, 36, 0.96), rgba(12, 8, 22, 0.9));
            border-color: rgba(139, 92, 246, 0.16);
        }

        .dark .admin-sidebar-sheen::before {
            content: '';
            position: absolute;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.04), transparent 26%),
                radial-gradient(circle at top, rgba(139, 92, 246, 0.14), transparent 46%);
        }

        .dark .admin-active-link {
            background: linear-gradient(90deg, rgba(139, 92, 246, 0.24), rgba(192, 132, 252, 0.12));
            border-color: rgba(167, 139, 250, 0.72);
            color: #f5f3ff;
            box-shadow: 0 14px 30px rgba(76, 29, 149, 0.22);
        }

        .dark .admin-subtle-link:hover {
            background: rgba(139, 92, 246, 0.12);
        }

        /* Global dark-mode recolor so existing admin blue utilities inherit the purple theme */
        .dark .dark\:text-blue-400,
        .dark .dark\:hover\:text-blue-400:hover,
        .dark .dark\:group-hover\:text-blue-400:hover,
        .dark .dark\:group-hover\:text-blue-400 {
            color: #c4b5fd !important;
        }

        .dark .dark\:bg-blue-950\/20,
        .dark .dark\:bg-blue-950\/25,
        .dark .dark\:bg-blue-900\/30,
        .dark .dark\:hover\:bg-blue-950:hover,
        .dark .dark\:hover\:bg-blue-950\/20:hover,
        .dark .dark\:hover\:bg-blue-900\/30:hover,
        .dark .dark\:bg-blue-950,
        .dark .dark\:bg-blue-950\/50 {
            background-color: rgba(139, 92, 246, 0.16) !important;
        }

        .dark .dark\:border-blue-900,
        .dark .dark\:hover\:border-blue-900:hover,
        .dark .dark\:focus\:border-blue-500:focus {
            border-color: rgba(139, 92, 246, 0.42) !important;
        }

        .dark .dark\:focus\:ring-blue-500\/10:focus {
            --tw-ring-color: rgba(139, 92, 246, 0.18) !important;
        }
    </style>

    @yield('style')
</head>
<body class="h-full font-sans antialiased text-slate-800 dark:text-slate-100 bg-slate-50 dark:bg-slate-950 transition-colors duration-200">

    <!-- Main Wrapper -->
    <div class="min-h-full">
        
        <!-- Sidebar Navigation Panel (Responsive, Light & Dark Theme) -->
        <aside class="admin-sidebar-sheen fixed inset-y-0 left-0 z-30 flex w-64 flex-col border-r border-slate-200 bg-white/92 transition-colors duration-200 dark:bg-slate-900/90 dark:border-violet-500/10">
            <!-- Brand Header -->
            <div class="h-16 flex items-center border-b border-slate-100 bg-white/90 px-6 transition-colors duration-200 dark:border-violet-500/10 dark:bg-transparent">
                <a href="{{ url('admin/dashboard') }}" class="flex items-center space-x-2.5">
                    <!-- GMC Primary Logo Gradient -->
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-tr from-gmcBlue via-violet-500 to-gmcGreen text-white shadow-md shadow-violet-200/70 dark:shadow-[0_0_25px_rgba(139,92,246,0.35)]">
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
                   class="group admin-subtle-link flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'dashboard' ? 'admin-active-link bg-violet-50/80 text-gmcBlue font-bold border-l-4 border-gmcBlue dark:text-violet-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:text-white' }}">
                    <i class="fa-solid fa-chart-pie mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'dashboard' ? 'text-gmcBlue dark:text-violet-200' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-violet-200' }}"></i>
                    Dashboard
                </a>
                @endif
                
                @if(auth()->user()->hasPermission('proofs'))
                <!-- Link: Payment Proofs -->
                <a href="{{ url('admin/payment-proofs/index') }}" 
                   class="group admin-subtle-link flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'payment_proofs' ? 'admin-active-link bg-violet-50/80 text-gmcBlue font-bold border-l-4 border-gmcBlue dark:text-violet-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:text-white' }}">
                    <i class="fa-solid fa-file-invoice-dollar mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'payment_proofs' ? 'text-gmcBlue dark:text-violet-200' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-violet-200' }}"></i>
                    Payment Proofs
                </a>
                @endif
                
                @if(auth()->user()->hasPermission('sizes'))
                <!-- Link: Sizes -->
                <a href="{{ url('admin/size/index') }}" 
                   class="group admin-subtle-link flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'size' ? 'admin-active-link bg-violet-50/80 text-gmcBlue font-bold border-l-4 border-gmcBlue dark:text-violet-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:text-white' }}">
                    <i class="fa-solid fa-ruler-combined mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'size' ? 'text-gmcBlue dark:text-violet-200' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-violet-200' }}"></i>
                    Size Parameters
                </a>
                @endif

                @if(auth()->user()->role === 'owner')
                <!-- Link: Account Settings -->
                <a href="{{ url('admin/settings') }}" 
                   class="group admin-subtle-link flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'settings' ? 'admin-active-link bg-violet-50/80 text-gmcBlue font-bold border-l-4 border-gmcBlue dark:text-violet-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:text-white' }}">
                    <i class="fa-solid fa-gears mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'settings' ? 'text-gmcBlue dark:text-violet-200' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-violet-200' }}"></i>
                    Account Settings
                </a>

                @php
                    $isWebsiteContentRoute = request()->routeIs('website-content.*');
                @endphp

                <div class="rounded-2xl border border-slate-200/70 bg-slate-50/70 p-2 transition-colors dark:border-violet-500/10 dark:bg-white/[0.03]">
                    <div class="flex items-center px-2 py-2">
                        <div class="flex items-center text-sm font-semibold {{ $isWebsiteContentRoute ? 'text-gmcBlue dark:text-violet-200' : 'text-slate-600 dark:text-slate-300' }}">
                            <i class="fa-solid fa-window-maximize mr-3 text-base {{ $isWebsiteContentRoute ? 'text-gmcBlue dark:text-violet-200' : 'text-slate-400 dark:text-slate-500' }}"></i>
                            Website Content
                        </div>
                    </div>

                    <div class="mt-1 space-y-1">
                        <a href="{{ route('website-content.hero.edit') }}"
                           class="block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150 {{ request()->routeIs('website-content.hero.*') ? 'bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }}">
                            Hero Section
                        </a>
                        <a href="{{ route('website-content.scholarship-solution.edit') }}"
                           class="block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150 {{ request()->routeIs('website-content.scholarship-solution.*') ? 'bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }}">
                            Section Below Hero
                        </a>
                        <a href="{{ route('website-content.strategy-ribbon.edit') }}"
                           class="block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150 {{ request()->routeIs('website-content.strategy-ribbon.*') ? 'bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }}">
                            Strategy Ribbon
                        </a>
                        <a href="{{ route('website-content.mentor-trust.edit') }}"
                           class="block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150 {{ request()->routeIs('website-content.mentor-trust.*') ? 'bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }}">
                            Mentor Section
                        </a>
                        <a href="{{ route('website-content.guarantee.edit') }}"
                           class="block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150 {{ request()->routeIs('website-content.guarantee.*') ? 'bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }}">
                            Guarantee Section
                        </a>
                        <a href="{{ route('website-content.enrollment-flow.edit') }}"
                           class="block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150 {{ request()->routeIs('website-content.enrollment-flow.*') ? 'bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }}">
                            Enrollment Flow
                        </a>
                        <a href="{{ route('website-content.faq.edit') }}"
                           class="block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150 {{ request()->routeIs('website-content.faq.*') ? 'bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }}">
                            FAQ Section
                        </a>
                        <a href="{{ route('website-content.media-proof.edit') }}"
                           class="block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150 {{ request()->routeIs('website-content.media-proof.*') ? 'bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }}">
                            Media Proof Section
                        </a>
                        <a href="{{ route('website-content.session-audience.edit') }}"
                           class="block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150 {{ request()->routeIs('website-content.session-audience.*') ? 'bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }}">
                            Session Audience Section
                        </a>
                    </div>
                </div>

                <!-- Link: Employee Control -->
                <a href="{{ url('admin/employees') }}" 
                   class="group admin-subtle-link flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'employees' ? 'admin-active-link bg-violet-50/80 text-gmcBlue font-bold border-l-4 border-gmcBlue dark:text-violet-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:text-white' }}">
                    <i class="fa-solid fa-users-gear mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'employees' ? 'text-gmcBlue dark:text-violet-200' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-violet-200' }}"></i>
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
            <div class="border-t border-slate-100 bg-slate-50/50 p-4 dark:border-violet-500/10 dark:bg-white/[0.03]">
                <div class="flex items-center space-x-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-violet-100 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200 font-bold text-sm">
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
        <header class="fixed top-0 right-0 left-64 z-20 flex h-16 items-center justify-between border-b border-slate-200 bg-white/75 px-8 backdrop-blur-md transition-colors duration-200 dark:border-violet-500/10 dark:bg-[#120d20]/72">
            <!-- Left Header: Breadcrumbs -->
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ url('admin/dashboard') }}" class="text-slate-400 hover:text-gmcBlue dark:hover:text-violet-200 transition-colors font-medium">Home</a>
                <span class="text-slate-300 dark:text-slate-700">/</span>
                <span class="text-slate-700 dark:text-slate-300 font-semibold">{{ $heading }}</span>
            </div>
            
            <!-- Right Header: User Actions + Theme Toggle -->
            <div class="flex items-center space-x-4">
                
                <!-- Dynamic Theme Switcher Button -->
                <button id="theme-toggle" class="p-2.5 rounded-xl border border-slate-200 bg-white text-slate-500 hover:bg-slate-50 transition-all focus:outline-none dark:border-violet-500/10 dark:bg-white/[0.04] dark:text-slate-300 dark:hover:bg-violet-500/10" title="Toggle Light / Dark Mode">
                    <i id="theme-toggle-dark-icon" class="fa-solid fa-moon text-base hidden"></i>
                    <i id="theme-toggle-light-icon" class="fa-solid fa-sun text-base hidden text-amber-500"></i>
                </button>
                
                <div class="text-right hidden sm:block">
                    <span class="block text-xs font-bold text-slate-800 dark:text-slate-200">{{ auth()->user()->name }}</span>
                    <span class="block text-[10px] text-slate-400 dark:text-slate-500 font-semibold uppercase tracking-wider">
                        {{ auth()->user()->role === 'owner' ? 'System Owner' : 'Revenue Officer' }}
                    </span>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-slate-100 text-slate-650 font-bold dark:border-violet-500/10 dark:bg-white/[0.04] dark:text-violet-100">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
        </header>
        
        <!-- Content Container -->
        <main class="min-h-screen pl-64 bg-slate-50 transition-colors duration-200 dark:bg-transparent">
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const isDarkMode = document.documentElement.classList.contains('dark');

            const swalTheme = {
                background: isDarkMode ? '#140f24' : '#ffffff',
                color: isDarkMode ? '#f8fafc' : '#0f172a',
                confirmButtonColor: '#8b5cf6',
                customClass: {
                    popup: 'rounded-[22px]',
                    confirmButton: 'rounded-xl px-5 py-3 font-bold',
                },
            };

            @if (session('success'))
                Swal.fire({
                    ...swalTheme,
                    icon: 'success',
                    title: 'Saved successfully',
                    text: @json(session('success')),
                    timer: 2400,
                    showConfirmButton: false,
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    ...swalTheme,
                    icon: 'error',
                    title: 'Something went wrong',
                    text: @json(session('error')),
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    ...swalTheme,
                    icon: 'warning',
                    title: 'Please review the form',
                    html: `{!! collect($errors->all())->map(fn ($error) => '<div style="margin:6px 0;text-align:left;">• ' . e($error) . '</div>')->implode('') !!}`,
                    confirmButtonText: 'Review fields',
                });
            @endif
        });
    </script>

    @yield('script')
</body>
</html>
