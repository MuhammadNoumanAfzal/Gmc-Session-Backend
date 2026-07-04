<!doctype html>
<html lang="en" class="h-full bg-slate-50">
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
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Manrope', 'sans-serif'],
                        sora: ['Sora', 'sans-serif'],
                    },
                    colors: {
                        gmcBg: '#f8fafc',
                        gmcPanel: '#ffffff',
                        gmcBorder: '#e2e8f0',
                        gmcText: '#0f172a',
                        gmcMuted: '#64748b',
                        gmcViolet: '#6366f1',
                        gmcVioletDark: '#4f46e5',
                        gmcGold: '#b45309',
                        gmcGreen: '#047857',
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
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

    @yield('style')
</head>
<body class="h-full font-sans antialiased text-gmcText bg-gmcBg">

    <!-- Main Wrapper -->
    <div class="min-h-full">
        
        <!-- Sidebar Navigation Panel (Light Mode, Indigo Accent) -->
        <aside class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-slate-200 flex flex-col">
            <!-- Brand Header -->
            <div class="h-16 flex items-center px-6 border-b border-slate-100 bg-white">
                <a href="{{ url('admin/dashboard') }}" class="flex items-center space-x-2.5">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-indigo-500 to-violet-600 flex items-center justify-center text-white shadow-md shadow-indigo-200">
                        <i class="fa-solid fa-graduation-cap text-sm"></i>
                    </div>
                    <span class="font-sora font-extrabold text-lg text-slate-800 tracking-tight">GMC Sessions</span>
                </a>
            </div>
            
            <!-- Sidebar Nav Links -->
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                <div class="px-3 mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Navigation</div>
                
                <!-- Link: Dashboard -->
                <a href="{{ url('admin/dashboard') }}" 
                   class="group flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'dashboard' ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <i class="fa-solid fa-chart-pie mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'dashboard' ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-600' }}"></i>
                    Dashboard
                </a>
                
                <!-- Link: Payment Proofs -->
                <a href="{{ url('admin/payment-proofs/index') }}" 
                   class="group flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'payment_proofs' ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <i class="fa-solid fa-file-invoice-dollar mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'payment_proofs' ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-600' }}"></i>
                    Payment Proofs
                </a>
                
                <!-- Link: Sizes -->
                <a href="{{ url('admin/size/index') }}" 
                   class="group flex items-center px-3.5 py-3 text-sm font-medium rounded-xl transition-all duration-150 {{ $active == 'size' ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <i class="fa-solid fa-ruler-combined mr-3 text-lg transition-transform group-hover:scale-110 {{ $active == 'size' ? 'text-indigo-600' : 'text-slate-400 group-hover:text-slate-600' }}"></i>
                    Size Parameters
                </a>
            </nav>
            
            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">
                        AD
                    </div>
                    <div>
                        <div class="text-xs font-bold text-slate-800">Admin Control</div>
                        <div class="text-[10px] text-slate-400">admin@gmc.edu.pk</div>
                    </div>
                </div>
            </div>
        </aside>
        
        <!-- Top Navbar Header -->
        <header class="fixed top-0 right-0 left-64 h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 z-20 flex items-center justify-between px-8">
            <!-- Left Header: Breadcrumbs -->
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ url('admin/dashboard') }}" class="text-slate-400 hover:text-indigo-600 transition-colors font-medium">Home</a>
                <span class="text-slate-300">/</span>
                <span class="text-slate-700 font-semibold">{{ $heading }}</span>
            </div>
            
            <!-- Right Header: User Actions -->
            <div class="flex items-center space-x-4">
                <div class="text-right hidden sm:block">
                    <span class="block text-xs font-bold text-slate-800">GMC Administrator</span>
                    <span class="block text-[10px] text-slate-400">Verified Session Auditor</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 font-bold">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
        </header>
        
        <!-- Content Container -->
        <main class="pl-64 min-h-screen bg-slate-50">
            <div class="pt-20 px-8 pb-12 max-w-[1600px] mx-auto">
                
                <!-- Dynamic Page Header -->
                <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-black font-sora text-slate-800 tracking-tight">{{ $heading }}</h1>
                        <p class="text-sm text-slate-500 mt-1">{{ $title ?? 'Manage your administration workspace.' }}</p>
                    </div>
                </div>
                
                <!-- Main Blade Content Injection -->
                @yield('content')
                
            </div>
        </main>
        
    </div>

    @yield('script')
</body>
</html>
