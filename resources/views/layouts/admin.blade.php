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
            background:
                radial-gradient(circle at top left, rgba(139, 92, 246, 0.10), transparent 34%),
                radial-gradient(circle at 85% 14%, rgba(192, 132, 252, 0.08), transparent 26%),
                linear-gradient(180deg, #faf7ff 0%, #f6f1ff 26%, #ffffff 100%);
            background-attachment: fixed;
        }
        .dark body {
            background:
                radial-gradient(circle at top left, rgba(139, 92, 246, 0.18), transparent 30%),
                radial-gradient(circle at 78% 10%, rgba(192, 132, 252, 0.10), transparent 22%),
                linear-gradient(180deg, #1a1330 0%, #140f24 24%, #110c1f 58%, #0d0918 100%);
            background-attachment: fixed;
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

        .admin-nav-link {
            min-height: 52px;
            justify-content: flex-start;
        }

        .admin-nav-link i {
            width: 1.25rem;
            text-align: center;
        }

        .admin-accordion-trigger {
            min-height: 52px;
        }

        .admin-accordion-panel {
            overflow: hidden;
            transition: grid-template-rows 220ms ease, opacity 220ms ease;
            display: grid;
            grid-template-rows: 0fr;
            opacity: 0;
        }

        .admin-accordion-panel[data-open="true"] {
            grid-template-rows: 1fr;
            opacity: 1;
        }

        .admin-accordion-panel-inner {
            min-height: 0;
        }

        .admin-accordion-chevron {
            transition: transform 220ms ease, color 220ms ease;
        }

        .admin-accordion-trigger[aria-expanded="true"] .admin-accordion-chevron {
            transform: rotate(180deg);
        }

        .admin-topbar {
            background: rgba(255, 255, 255, 0.90);
            box-shadow: 0 10px 30px rgba(76, 29, 149, 0.06);
        }

        .dark .admin-topbar {
            background: rgba(24, 18, 43, 0.82);
            box-shadow: none;
        }

        .admin-user-chip {
            background: rgba(255, 255, 255, 0.76);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.85);
        }

        .dark .admin-user-chip {
            background: rgba(255, 255, 255, 0.04);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.03);
        }

        .admin-content-link {
            position: relative;
            margin-left: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding-left: 1rem;
        }

        .admin-content-link-icon {
            display: inline-flex;
            height: 1.75rem;
            width: 1.75rem;
            flex: 0 0 1.75rem;
            align-items: center;
            justify-content: center;
            border-radius: 0.8rem;
            background: rgba(139, 92, 246, 0.10);
            color: rgba(139, 92, 246, 0.92);
            transition: transform 180ms ease, background-color 180ms ease, color 180ms ease;
        }

        .dark .admin-content-link-icon {
            background: rgba(255, 255, 255, 0.06);
            color: #c4b5fd;
        }

        .admin-content-link:hover .admin-content-link-icon,
        .admin-content-link.is-active .admin-content-link-icon {
            transform: scale(1.05);
            background: rgba(139, 92, 246, 0.18);
            color: rgba(109, 40, 217, 0.98);
        }

        .dark .admin-content-link:hover .admin-content-link-icon,
        .dark .admin-content-link.is-active .admin-content-link-icon {
            background: rgba(255, 255, 255, 0.10);
            color: #ede9fe;
        }

        .admin-content-link-label {
            min-width: 0;
        }

        .dark .admin-panel input,
        .dark .admin-panel textarea,
        .dark .admin-panel select {
            color: #f5f3ff !important;
            caret-color: #f5f3ff;
        }

        .dark .admin-panel input::placeholder,
        .dark .admin-panel textarea::placeholder {
            color: #9f94bd !important;
            opacity: 1;
        }

        .dark .admin-panel label,
        .dark .admin-panel .settings-label,
        .dark .admin-panel .text-slate-500,
        .dark .admin-panel .text-slate-400 {
            color: #a99fc4 !important;
        }

        .dark .admin-panel .text-gmcBlue,
        .dark .admin-panel .dark\:text-violet-200,
        .dark .admin-panel .dark\:text-violet-300,
        .dark .admin-panel .dark\:text-blue-300,
        .dark .admin-panel .dark\:text-blue-400 {
            color: #ddd6fe !important;
        }

        .dark .admin-panel .text-gmcGreen {
            color: #d8ccfb !important;
        }

        .dark .admin-panel .text-gmcGold {
            color: #f4c56a !important;
        }

        .dark .admin-panel .bg-violet-500\/10,
        .dark .admin-panel .bg-violet-500\/15,
        .dark .admin-panel .bg-violet-950\/30,
        .dark .admin-panel .bg-blue-950\/30,
        .dark .admin-panel .bg-blue-950\/20 {
            background-color: rgba(255, 255, 255, 0.06) !important;
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
<body class="h-full bg-transparent font-sans antialiased text-slate-800 transition-colors duration-200 dark:text-slate-100">

    <!-- Main Wrapper -->
    <div class="min-h-full">
        
        <!-- Sidebar Navigation Panel (Responsive, Light & Dark Theme) -->
        <aside class="admin-sidebar-sheen fixed inset-y-0 left-0 z-30 flex w-64 flex-col border-r border-slate-200 bg-white/92 transition-colors duration-200 dark:bg-[#171127]/92 dark:border-violet-500/10">
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
                   class="group admin-nav-link admin-subtle-link flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'dashboard' ? 'admin-active-link bg-violet-50/80 text-gmcBlue font-bold border-l-4 border-gmcBlue dark:text-violet-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:text-white' }}">
                    <i class="fa-solid fa-chart-pie mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'dashboard' ? 'text-gmcBlue dark:text-violet-200' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-violet-200' }}"></i>
                    Dashboard
                </a>
                @endif
                
                @if(auth()->user()->hasPermission('proofs'))
                <!-- Link: Payment Proofs -->
                <a href="{{ url('admin/payment-proofs/index') }}" 
                   class="group admin-nav-link admin-subtle-link flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'payment_proofs' ? 'admin-active-link bg-violet-50/80 text-gmcBlue font-bold border-l-4 border-gmcBlue dark:text-violet-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:text-white' }}">
                    <i class="fa-solid fa-file-invoice-dollar mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'payment_proofs' ? 'text-gmcBlue dark:text-violet-200' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-violet-200' }}"></i>
                    Payment Proofs
                </a>
                @endif

                @if(auth()->user()->role === 'owner')
                <!-- Link: Account Settings -->
                <a href="{{ url('admin/settings') }}" 
                   class="group admin-nav-link admin-subtle-link flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'settings' ? 'admin-active-link bg-violet-50/80 text-gmcBlue font-bold border-l-4 border-gmcBlue dark:text-violet-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:text-white' }}">
                    <i class="fa-solid fa-gears mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'settings' ? 'text-gmcBlue dark:text-violet-200' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-violet-200' }}"></i>
                    Account Settings
                </a>

                @php
                    $isWebsiteContentRoute = request()->routeIs('website-content.*');
                @endphp

                <div class="transition-colors">
                    <button
                        type="button"
                        class="admin-accordion-trigger group admin-subtle-link flex w-full items-center justify-between rounded-xl px-3.5 py-3 text-left text-sm font-medium transition-all duration-150 {{ $isWebsiteContentRoute ? 'admin-active-link bg-violet-50/80 text-gmcBlue font-bold border-l-4 border-gmcBlue dark:text-violet-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:text-white' }}"
                        data-sidebar-toggle="website-content"
                        aria-expanded="{{ $isWebsiteContentRoute ? 'true' : 'false' }}"
                        aria-controls="sidebar-website-content"
                    >
                        <span class="flex min-w-0 items-center">
                            <i class="fa-solid fa-window-maximize mr-3 text-lg transition-transform group-hover:scale-110 {{ $isWebsiteContentRoute ? 'text-gmcBlue dark:text-violet-200' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-violet-200' }}"></i>
                            <span class="truncate">Website Content</span>
                        </span>
                        <span class="flex items-center gap-2 pl-3">
                            <span class="rounded-full bg-violet-100 px-2 py-0.5 text-[10px] font-bold text-violet-700 dark:bg-violet-500/15 dark:text-violet-200">9</span>
                            <i class="admin-accordion-chevron fa-solid fa-chevron-down text-xs {{ $isWebsiteContentRoute ? 'text-gmcBlue dark:text-violet-200' : 'text-slate-400 dark:text-slate-500' }}"></i>
                        </span>
                    </button>

                    <div
                        id="sidebar-website-content"
                        class="admin-accordion-panel"
                        data-open="{{ $isWebsiteContentRoute ? 'true' : 'false' }}"
                    >
                        <div class="admin-accordion-panel-inner mt-1.5 space-y-1">
                        <a href="{{ route('website-content.hero.edit') }}"
                           class="admin-content-link {{ request()->routeIs('website-content.hero.*') ? 'is-active bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }} block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150">
                            <span class="admin-content-link-icon"><i class="fa-solid fa-sparkles text-xs"></i></span>
                            <span class="admin-content-link-label truncate">Hero Section</span>
                        </a>
                        <a href="{{ route('website-content.scholarship-solution.edit') }}"
                           class="admin-content-link {{ request()->routeIs('website-content.scholarship-solution.*') ? 'is-active bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }} block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150">
                            <span class="admin-content-link-icon"><i class="fa-solid fa-layer-group text-xs"></i></span>
                            <span class="admin-content-link-label truncate">Section Below Hero</span>
                        </a>
                        <a href="{{ route('website-content.strategy-ribbon.edit') }}"
                           class="admin-content-link {{ request()->routeIs('website-content.strategy-ribbon.*') ? 'is-active bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }} block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150">
                            <span class="admin-content-link-icon"><i class="fa-solid fa-wave-square text-xs"></i></span>
                            <span class="admin-content-link-label truncate">Strategy Ribbon</span>
                        </a>
                        <a href="{{ route('website-content.mentor-trust.edit') }}"
                           class="admin-content-link {{ request()->routeIs('website-content.mentor-trust.*') ? 'is-active bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }} block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150">
                            <span class="admin-content-link-icon"><i class="fa-solid fa-user-tie text-xs"></i></span>
                            <span class="admin-content-link-label truncate">Mentor Section</span>
                        </a>
                        <a href="{{ route('website-content.guarantee.edit') }}"
                           class="admin-content-link {{ request()->routeIs('website-content.guarantee.*') ? 'is-active bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }} block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150">
                            <span class="admin-content-link-icon"><i class="fa-solid fa-shield-heart text-xs"></i></span>
                            <span class="admin-content-link-label truncate">Guarantee Section</span>
                        </a>
                        <a href="{{ route('website-content.enrollment-flow.edit') }}"
                           class="admin-content-link {{ request()->routeIs('website-content.enrollment-flow.*') ? 'is-active bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }} block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150">
                            <span class="admin-content-link-icon"><i class="fa-solid fa-route text-xs"></i></span>
                            <span class="admin-content-link-label truncate">Enrollment Flow</span>
                        </a>
                        <a href="{{ route('website-content.faq.edit') }}"
                           class="admin-content-link {{ request()->routeIs('website-content.faq.*') ? 'is-active bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }} block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150">
                            <span class="admin-content-link-icon"><i class="fa-solid fa-circle-question text-xs"></i></span>
                            <span class="admin-content-link-label truncate">FAQ Section</span>
                        </a>
                        <a href="{{ route('website-content.media-proof.edit') }}"
                           class="admin-content-link {{ request()->routeIs('website-content.media-proof.*') ? 'is-active bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }} block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150">
                            <span class="admin-content-link-icon"><i class="fa-solid fa-photo-film text-xs"></i></span>
                            <span class="admin-content-link-label truncate">Media Proof Section</span>
                        </a>
                        <a href="{{ route('website-content.session-audience.edit') }}"
                           class="admin-content-link {{ request()->routeIs('website-content.session-audience.*') ? 'is-active bg-violet-50 text-gmcBlue dark:bg-violet-500/15 dark:text-violet-200' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-violet-500/10 hover:text-slate-900 dark:hover:text-white' }} block rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150">
                            <span class="admin-content-link-icon"><i class="fa-solid fa-users-viewfinder text-xs"></i></span>
                            <span class="admin-content-link-label truncate">Session Audience Section</span>
                        </a>
                        </div>
                    </div>
                </div>

                <!-- Link: Employee Control -->
                <a href="{{ url('admin/employees') }}" 
                   class="group admin-nav-link admin-subtle-link flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'employees' ? 'admin-active-link bg-violet-50/80 text-gmcBlue font-bold border-l-4 border-gmcBlue dark:text-violet-100' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:text-white' }}">
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
        <header class="admin-topbar fixed top-0 right-0 left-64 z-20 flex h-16 items-center justify-between border-b border-violet-100/80 px-8 backdrop-blur-md transition-colors duration-200 dark:border-violet-500/10">
            <!-- Left Header: Breadcrumbs -->
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ url('admin/dashboard') }}" class="text-slate-500 hover:text-gmcBlue dark:text-slate-400 dark:hover:text-violet-200 transition-colors font-semibold">Home</a>
                <span class="text-slate-300 dark:text-slate-700">/</span>
                <span class="text-gmcBlue dark:text-slate-200 font-semibold">{{ $heading }}</span>
            </div>
            
            <!-- Right Header: User Actions + Theme Toggle -->
            <div class="flex items-center space-x-4">
                
                <!-- Dynamic Theme Switcher Button -->
                <button id="theme-toggle" class="p-2.5 rounded-xl border border-slate-200 bg-white text-slate-500 hover:bg-slate-50 transition-all focus:outline-none dark:border-violet-500/10 dark:bg-white/[0.04] dark:text-slate-300 dark:hover:bg-violet-500/10" title="Toggle Light / Dark Mode">
                    <i id="theme-toggle-dark-icon" class="fa-solid fa-moon text-base hidden"></i>
                    <i id="theme-toggle-light-icon" class="fa-solid fa-sun text-base hidden text-amber-500"></i>
                </button>
                
                <div class="admin-user-chip hidden items-center gap-3 rounded-2xl border border-violet-100/80 px-4 py-2 text-right sm:flex dark:border-violet-500/10">
                    <div>
                        <span class="block text-xs font-bold text-slate-800 dark:text-slate-200">{{ auth()->user()->name }}</span>
                        <span class="block text-[10px] text-gmcBlue dark:text-violet-300 font-bold uppercase tracking-wider">
                            {{ auth()->user()->role === 'owner' ? 'System Owner' : 'Revenue Officer' }}
                        </span>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-slate-100 text-slate-650 font-bold dark:border-violet-500/10 dark:bg-white/[0.04] dark:text-violet-100">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-slate-100 text-slate-650 font-bold sm:hidden dark:border-violet-500/10 dark:bg-white/[0.04] dark:text-violet-100">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
        </header>
        
        <!-- Content Container -->
        <main class="min-h-screen pl-64 bg-transparent transition-colors duration-200">
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

            document.querySelectorAll('[data-sidebar-toggle]').forEach((trigger) => {
                const panelId = trigger.getAttribute('aria-controls');
                const panel = panelId ? document.getElementById(panelId) : null;

                if (!panel) {
                    return;
                }

                trigger.addEventListener('click', function () {
                    const isOpen = trigger.getAttribute('aria-expanded') === 'true';
                    const nextOpen = !isOpen;

                    trigger.setAttribute('aria-expanded', nextOpen ? 'true' : 'false');
                    panel.setAttribute('data-open', nextOpen ? 'true' : 'false');
                });
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
