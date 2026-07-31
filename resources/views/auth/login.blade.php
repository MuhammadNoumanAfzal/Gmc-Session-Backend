<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Sora:wght@600;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
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
                            800: '#2d3039',
                            850: '#282b33',
                            855: '#323642',
                            900: '#23262d',
                            950: '#181a1f',
                        }
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>GMC Session Panel Login</title>
</head>
<body class="relative flex h-full items-center justify-center overflow-hidden bg-slate-50 p-4 font-sans antialiased text-slate-800 transition-colors duration-200 dark:bg-slate-950 dark:text-slate-100">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(57,181,74,0.12),transparent_32%),radial-gradient(circle_at_bottom_right,rgba(14,61,129,0.16),transparent_34%)]"></div>

    <div class="absolute right-6 top-6">
        <button id="theme-toggle" class="rounded-xl border border-slate-200 bg-white p-2.5 text-slate-500 shadow-sm transition-all hover:bg-slate-50 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400 dark:hover:bg-slate-800" title="Toggle Light / Dark Mode">
            <i id="theme-toggle-dark-icon" class="fa-solid fa-moon hidden text-base"></i>
            <i id="theme-toggle-light-icon" class="fa-solid fa-sun hidden text-base text-amber-500"></i>
        </button>
    </div>

    <div class="relative w-full max-w-[460px] overflow-hidden rounded-[30px] border border-slate-200 bg-white p-8 shadow-[0_30px_80px_rgba(15,23,42,0.12)] transition-colors duration-200 dark:border-slate-800 dark:bg-slate-900 dark:shadow-2xl">
        <div class="absolute inset-x-0 top-0 h-[5px] bg-gradient-to-r from-gmcBlue via-[#1760c2] to-gmcGreen"></div>

        <div class="mb-8 mt-4 text-center">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-tr from-gmcBlue to-gmcGreen text-white shadow-md shadow-blue-200/70 dark:shadow-none">
                <i class="fa-solid fa-graduation-cap text-xl"></i>
            </div>
            <h1 class="font-sora text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">GMC Sessions</h1>
            <p class="mt-2 text-xs font-semibold uppercase tracking-[0.25em] text-slate-400 dark:text-slate-500">Trusted Workspace Login</p>
            <p class="mx-auto mt-4 max-w-sm text-sm leading-6 text-slate-500 dark:text-slate-400">
                Sign in with your assigned owner or employee account to access the admin workspace securely.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-red-100 bg-red-50 p-4 text-xs font-semibold leading-relaxed text-red-700 dark:border-red-900/30 dark:bg-red-950/20 dark:text-red-400">
                <div class="mb-1 flex items-center">
                    <i class="fa-solid fa-circle-exclamation mr-2 text-sm text-red-600"></i>
                    <span>Sign-in issue</span>
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

            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 dark:text-slate-500">
                        <i class="fa-solid fa-envelope text-sm"></i>
                    </span>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50/60 py-3 pl-10 pr-4 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-800 dark:bg-slate-950/50 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10"
                        placeholder="owner@gmc.edu.pk"
                        required
                        autofocus
                    >
                </div>
            </div>

            <div class="space-y-1.5">
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 dark:text-slate-500">
                        <i class="fa-solid fa-lock text-sm"></i>
                    </span>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50/60 py-3 pl-10 pr-12 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-800 dark:bg-slate-950/50 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10"
                        placeholder="Enter your password"
                        required
                    >
                    <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 transition hover:text-slate-600 dark:text-slate-500 dark:hover:text-slate-300" aria-label="Show password">
                        <i id="toggle-password-icon" class="fa-solid fa-eye text-sm"></i>
                    </button>
                </div>
                <p class="text-[11px] text-slate-400 dark:text-slate-500">Use your trusted account credentials exactly as assigned by the system owner.</p>
            </div>

            <div class="flex items-center justify-between gap-4">
                <label for="remember" class="flex items-center text-xs font-semibold text-slate-500 dark:text-slate-400">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-gmcBlue focus:ring-gmcBlue/20 dark:border-slate-700 dark:bg-slate-950">
                    <span class="ml-2">Remember this device</span>
                </label>
                <span class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-300 dark:text-slate-600">Secure Access</span>
            </div>

            <button type="submit" class="mt-2 flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-gmcBlue to-gmcBlueDark py-3 text-sm font-bold text-white shadow-md shadow-blue-200/50 transition-all duration-200 hover:from-gmcBlueDark hover:to-gmcBlue dark:shadow-none">
                <i class="fa-solid fa-right-to-bracket text-base"></i>
                Sign In to Workspace
            </button>
        </form>

        <p class="mt-8 text-center text-[10px] text-slate-400 dark:text-slate-600">
            Secured Admin Gateway • Authorized Personnel Only
        </p>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');
            const passwordInput = document.getElementById('password');
            const togglePasswordButton = document.getElementById('toggle-password');
            const togglePasswordIcon = document.getElementById('toggle-password-icon');

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

            if (togglePasswordButton && passwordInput && togglePasswordIcon) {
                togglePasswordButton.addEventListener('click', function () {
                    const isPasswordHidden = passwordInput.type === 'password';

                    passwordInput.type = isPasswordHidden ? 'text' : 'password';
                    togglePasswordIcon.classList.toggle('fa-eye', !isPasswordHidden);
                    togglePasswordIcon.classList.toggle('fa-eye-slash', isPasswordHidden);
                    togglePasswordButton.setAttribute('aria-label', isPasswordHidden ? 'Hide password' : 'Show password');
                });
            }
        });
    </script>
</body>
</html>
