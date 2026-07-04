<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Sora:wght@600;800&display=swap" rel="stylesheet">

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
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Manrope', 'sans-serif'],
                        sora: ['Sora', 'sans-serif'],
                    },
                    colors: {
                        gmcBlue: '#0e3d81',
                        gmcBlueDark: '#0a2a5a',
                        gmcGreen: '#39b54a',
                        gmcGreenDark: '#2c8f3a',
                        slate: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#2d3039', // clean dark charcoal for light mode text & dark mode borders
                            850: '#282b33', // dark charcoal inner elements
                            855: '#323642', // secondary dark charcoal details
                            900: '#23262d', // premium charcoal panel/sidebar bg
                            950: '#181a1f', // premium charcoal body bg
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- FontAwesome v6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <title>GMC Session Panel Login</title>
</head>
<body class="h-full font-sans antialiased text-slate-800 dark:text-slate-100 bg-slate-50 dark:bg-slate-950 transition-colors duration-200 flex items-center justify-center p-4">

    <!-- Top Right Theme Switcher -->
    <div class="absolute top-6 right-6">
        <button id="theme-toggle" class="p-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all focus:outline-none shadow-sm" title="Toggle Light / Dark Mode">
            <i id="theme-toggle-dark-icon" class="fa-solid fa-moon text-base hidden"></i>
            <i id="theme-toggle-light-icon" class="fa-solid fa-sun text-base hidden text-amber-500"></i>
        </button>
    </div>

    <!-- Glassmorphic Login Card -->
    <div class="w-full max-w-[420px] bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 shadow-xl dark:shadow-2xl relative overflow-hidden transition-colors duration-200">
        
        <!-- Colored top brand stripe -->
        <div class="absolute top-0 left-0 w-100% w-full height-[5px] h-[5px] bg-gradient-to-r from-gmcBlue to-gmcGreen"></div>
        
        <!-- Header -->
        <div class="flex flex-col items-center text-center mt-4 mb-8">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-gmcBlue to-gmcGreen flex items-center justify-center text-white shadow-md shadow-blue-200 dark:shadow-none mb-3">
                <i class="fa-solid fa-graduation-cap text-lg"></i>
            </div>
            <h1 class="brand-name font-sora font-extrabold text-xl text-slate-900 dark:text-white tracking-tight">GMC SESSIONS</h1>
            <p class="text-xs text-slate-400 dark:text-slate-500 font-semibold uppercase tracking-wider mt-1">Workspace Verification</p>
        </div>

        @if ($errors->any())
            <div class="mb-5 bg-red-50 dark:bg-red-950/20 border border-red-100 dark:border-red-900/30 text-red-750 dark:text-red-400 p-3.5 rounded-xl text-xs font-semibold leading-relaxed">
                <div class="flex items-center mb-1">
                    <i class="fa-solid fa-circle-exclamation mr-2 text-red-650 text-sm"></i>
                    <span>Authentication failed:</span>
                </div>
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.perform') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Field: Email -->
            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 dark:text-slate-500">
                        <i class="fa-solid fa-envelope text-sm"></i>
                    </span>
                    <input id="email" name="email" type="email" 
                           class="w-full bg-slate-50/50 dark:bg-slate-950/50 border border-slate-200 dark:border-slate-850 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                           placeholder="admin@gmc.edu.pk" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <!-- Field: Password -->
            <div class="space-y-1.5">
                <label for="password" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 dark:text-slate-500">
                        <i class="fa-solid fa-lock text-sm"></i>
                    </span>
                    <input id="password" name="password" type="password" 
                           class="w-full bg-slate-50/50 dark:bg-slate-950/50 border border-slate-200 dark:border-slate-855 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                           placeholder="••••••••" required>
                </div>
            </div>

            <!-- Remember Me checkbox -->
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox" 
                       class="h-4 w-4 rounded border-slate-300 dark:border-slate-800 text-gmcBlue focus:ring-gmcBlue/20 dark:bg-slate-950">
                <label for="remember" class="ml-2 block text-xs font-semibold text-slate-500 dark:text-slate-400">Remember this device</label>
            </div>

            <!-- Action Button -->
            <button type="submit" 
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-gmcBlue to-gmcBlueDark hover:from-gmcBlueDark hover:to-gmcBlue text-white font-bold text-sm shadow-md shadow-blue-200/50 dark:shadow-none transition-all duration-200 flex items-center justify-center gap-2 mt-2">
                <i class="fa-solid fa-right-to-bracket text-base"></i>
                Sign In to Workspace
            </button>
        </form>

        <!-- Footer -->
        <p class="text-center text-[10px] text-slate-400 dark:text-slate-600 mt-8">
            Secured Admin Gateway • Authorized Personnel Only
        </p>

    </div>

    <!-- Theme Toggle Handler -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');

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
            });
        });
    </script>

</body>
</html>
