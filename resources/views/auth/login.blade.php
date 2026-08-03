<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        if (localStorage.theme === 'dark' || !('theme' in localStorage)) {
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
                        gmcBlue: '#8b5cf6',
                        gmcBlueDark: '#6d28d9',
                        gmcGreen: '#c084fc',
                        gmcGreenDark: '#a855f7',
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
                            900: '#140f24',
                            950: '#090611',
                        }
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>GMC Session Panel Login</title>
</head>
<body class="min-h-full bg-slate-50 font-sans antialiased text-slate-800 transition-colors duration-200 dark:bg-slate-950 dark:text-slate-100">
    <div class="relative isolate min-h-screen overflow-hidden bg-[radial-gradient(circle_at_top_left,rgba(139,92,246,0.12),transparent_28%),radial-gradient(circle_at_85%_12%,rgba(192,132,252,0.08),transparent_24%),linear-gradient(180deg,#faf7ff_0%,#f5efff_34%,#ffffff_100%)] dark:bg-[radial-gradient(circle_at_top_left,rgba(139,92,246,0.18),transparent_28%),radial-gradient(circle_at_85%_12%,rgba(192,132,252,0.10),transparent_22%),linear-gradient(180deg,#1a1330_0%,#140f24_24%,#110c1f_60%,#0d0918_100%)]">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute left-[-8%] top-[8%] h-64 w-64 rounded-full bg-violet-400/10 blur-3xl dark:bg-violet-500/12"></div>
            <div class="absolute right-[-6%] bottom-[10%] h-72 w-72 rounded-full bg-fuchsia-400/10 blur-3xl dark:bg-fuchsia-500/10"></div>
        </div>

        <div class="absolute right-4 top-4 z-20 sm:right-6 sm:top-6">
            <button id="theme-toggle" class="rounded-2xl border border-slate-200 bg-white/90 p-3 text-slate-500 shadow-sm transition-all hover:bg-white focus:outline-none dark:border-violet-500/10 dark:bg-white/[0.04] dark:text-slate-300 dark:hover:bg-violet-500/10" title="Toggle Light / Dark Mode">
                <i id="theme-toggle-dark-icon" class="fa-solid fa-moon hidden text-base"></i>
                <i id="theme-toggle-light-icon" class="fa-solid fa-sun hidden text-base text-amber-400"></i>
            </button>
        </div>

        <main class="relative z-10 mx-auto flex min-h-screen w-full max-w-5xl items-center justify-center px-4 py-6 sm:px-6 lg:px-8">
            <div class="grid w-full max-w-[920px] items-stretch gap-5 lg:grid-cols-[0.86fr_1fr] xl:max-w-[980px]">
                <section class="hidden overflow-hidden rounded-[30px] border border-violet-200/70 bg-white/70 shadow-[0_28px_70px_rgba(91,33,182,0.10)] backdrop-blur-xl lg:flex dark:border-violet-500/10 dark:bg-white/[0.03] dark:shadow-[0_28px_70px_rgba(3,2,10,0.34)]">
                    <div class="relative flex w-full flex-col justify-between p-7 xl:p-8">
                        <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(circle_at_top_right,rgba(192,132,252,0.16),transparent_30%),linear-gradient(180deg,rgba(255,255,255,0.10),transparent_28%)] dark:bg-[radial-gradient(circle_at_top_right,rgba(192,132,252,0.12),transparent_30%),linear-gradient(180deg,rgba(255,255,255,0.05),transparent_26%)]"></div>

                        <div class="relative">
                            <div class="mb-7 inline-flex items-center gap-3 rounded-full border border-violet-200/80 bg-white/80 px-4 py-2 text-sm font-bold text-violet-700 dark:border-violet-500/15 dark:bg-white/[0.04] dark:text-violet-200">
                                <span class="flex h-8 w-8 items-center justify-center rounded-2xl bg-gradient-to-tr from-gmcBlue via-violet-500 to-gmcGreen text-white shadow-[0_12px_24px_rgba(139,92,246,0.24)]">
                                    <i class="fa-solid fa-graduation-cap text-sm"></i>
                                </span>
                                GMC Sessions
                            </div>

                            <p class="mb-3 text-[10px] font-extrabold uppercase tracking-[0.28em] text-violet-600 dark:text-violet-300">Luxury Admin Workspace</p>
                            <h1 class="max-w-md font-sora text-3xl font-extrabold leading-tight text-slate-900 dark:text-white xl:text-[2.5rem]">
                                Secure your team’s operations in one refined dashboard.
                            </h1>
                            <p class="mt-4 max-w-md text-sm leading-7 text-slate-600 dark:text-slate-300">
                                Access submissions, website content, employees, and revenue workflows through a cleaner admin experience.
                            </p>
                        </div>

                        <div class="relative mt-8 grid gap-3">
                            <div class="rounded-[22px] border border-violet-200/80 bg-white/82 p-4 dark:border-violet-500/10 dark:bg-white/[0.04]">
                                <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-2xl bg-violet-100 text-violet-700 dark:bg-violet-500/12 dark:text-violet-200">
                                    <i class="fa-solid fa-chart-line"></i>
                                </div>
                                <h2 class="text-sm font-bold text-slate-900 dark:text-white">Revenue View</h2>
                                <p class="mt-1.5 text-xs leading-6 text-slate-500 dark:text-slate-400">Track approvals and growth performance.</p>
                            </div>
                            <div class="rounded-[22px] border border-violet-200/80 bg-white/82 p-4 dark:border-violet-500/10 dark:bg-white/[0.04]">
                                <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-2xl bg-violet-100 text-violet-700 dark:bg-violet-500/12 dark:text-violet-200">
                                    <i class="fa-solid fa-window-maximize"></i>
                                </div>
                                <h2 class="text-sm font-bold text-slate-900 dark:text-white">Content Control</h2>
                                <p class="mt-1.5 text-xs leading-6 text-slate-500 dark:text-slate-400">Edit website sections with structured tools.</p>
                            </div>
                            <div class="rounded-[22px] border border-violet-200/80 bg-white/82 p-4 dark:border-violet-500/10 dark:bg-white/[0.04]">
                                <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-2xl bg-violet-100 text-violet-700 dark:bg-violet-500/12 dark:text-violet-200">
                                    <i class="fa-solid fa-shield-halved"></i>
                                </div>
                                <h2 class="text-sm font-bold text-slate-900 dark:text-white">Trusted Access</h2>
                                <p class="mt-1.5 text-xs leading-6 text-slate-500 dark:text-slate-400">Owner and employee accounts with controlled access.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="relative mx-auto w-full max-w-[520px] overflow-hidden rounded-[28px] border border-slate-200 bg-white/90 shadow-[0_28px_70px_rgba(15,23,42,0.10)] backdrop-blur-xl dark:border-violet-500/10 dark:bg-[#161124]/92 dark:shadow-[0_28px_70px_rgba(3,2,10,0.36)]">
                    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-violet-300/70 to-transparent dark:via-violet-400/30"></div>

                    <div class="relative px-5 py-5 sm:px-7 sm:py-6 lg:px-7 lg:py-7">
                        <div class="mb-6 text-center lg:hidden">
                            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-tr from-gmcBlue via-violet-500 to-gmcGreen text-white shadow-[0_16px_30px_rgba(139,92,246,0.26)]">
                                <i class="fa-solid fa-graduation-cap text-xl"></i>
                            </div>
                            <h1 class="font-sora text-xl font-extrabold tracking-tight text-slate-900 dark:text-white">GMC Sessions</h1>
                            <p class="mt-2 text-[10px] font-bold uppercase tracking-[0.22em] text-violet-600 dark:text-violet-300">Trusted Workspace Login</p>
                        </div>

                        <div class="mb-6 hidden lg:block">
                            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-tr from-gmcBlue via-violet-500 to-gmcGreen text-white shadow-[0_16px_30px_rgba(139,92,246,0.26)]">
                                <i class="fa-solid fa-graduation-cap text-lg"></i>
                            </div>
                            <p class="mb-2 text-[10px] font-extrabold uppercase tracking-[0.22em] text-violet-600 dark:text-violet-300">Trusted Workspace Login</p>
                            <h1 class="font-sora text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">Sign in to your workspace</h1>
                            <p class="mt-2 max-w-md text-sm leading-6 text-slate-500 dark:text-slate-400">
                                Use your assigned account to access the GMC sessions dashboard securely.
                            </p>
                        </div>

                        @if ($errors->any())
                            <div class="mb-6 rounded-[24px] border border-red-200/80 bg-red-50/90 p-4 text-sm leading-relaxed text-red-700 dark:border-red-900/30 dark:bg-red-950/20 dark:text-red-300">
                                <div class="mb-2 flex items-center font-bold">
                                    <i class="fa-solid fa-circle-exclamation mr-2 text-sm"></i>
                                    Sign-in issue
                                </div>
                                <ul class="list-disc space-y-1 pl-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login.perform') }}" method="POST" class="space-y-4">
                            @csrf

                            <div class="space-y-2">
                                <label for="email" class="block text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400 dark:text-slate-500">Email Address</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 dark:text-slate-500">
                                        <i class="fa-solid fa-envelope text-sm"></i>
                                    </span>
                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        value="{{ old('email') }}"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50/80 py-3 pl-11 pr-4 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-violet-500/12 dark:bg-white/[0.04] dark:text-white dark:placeholder:text-slate-500 dark:focus:border-violet-400 dark:focus:ring-violet-500/10"
                                        placeholder="owner@gmc.edu.pk"
                                        required
                                        autofocus
                                    >
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="password" class="block text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400 dark:text-slate-500">Password</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 dark:text-slate-500">
                                        <i class="fa-solid fa-lock text-sm"></i>
                                    </span>
                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50/80 py-3 pl-11 pr-12 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-violet-500/12 dark:bg-white/[0.04] dark:text-white dark:placeholder:text-slate-500 dark:focus:border-violet-400 dark:focus:ring-violet-500/10"
                                        placeholder="Enter your password"
                                        required
                                    >
                                    <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 transition hover:text-slate-600 dark:text-slate-500 dark:hover:text-slate-300" aria-label="Show password">
                                        <i id="toggle-password-icon" class="fa-solid fa-eye text-sm"></i>
                                    </button>
                                </div>
                                <p class="text-[11px] leading-5 text-slate-400 dark:text-slate-500">Use your trusted account credentials exactly as assigned by the system owner.</p>
                            </div>

                            <div class="flex flex-col gap-2.5 rounded-[22px] border border-slate-200/80 bg-slate-50/70 p-3.5 sm:flex-row sm:items-center sm:justify-between dark:border-violet-500/10 dark:bg-white/[0.03]">
                                <label for="remember" class="flex items-center text-sm font-semibold text-slate-600 dark:text-slate-300">
                                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-gmcBlue focus:ring-gmcBlue/20 dark:border-violet-500/20 dark:bg-slate-950">
                                    <span class="ml-2.5">Remember this device</span>
                                </label>
                                <span class="text-[11px] font-bold uppercase tracking-[0.22em] text-violet-600 dark:text-violet-300">Secure Access</span>
                            </div>

                            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-gmcBlue via-violet-600 to-gmcBlueDark py-3 text-sm font-bold text-white shadow-[0_16px_32px_rgba(109,40,217,0.26)] transition-all duration-200 hover:translate-y-[-1px] hover:shadow-[0_18px_36px_rgba(109,40,217,0.34)]">
                                <i class="fa-solid fa-right-to-bracket text-base"></i>
                                Sign In to Workspace
                            </button>
                        </form>

                        <div class="mt-6 rounded-[22px] border border-slate-200/80 bg-white/70 px-4 py-3 text-center text-[11px] text-slate-500 dark:border-violet-500/10 dark:bg-white/[0.03] dark:text-slate-400">
                            Secured Admin Gateway • Authorized Personnel Only
                        </div>
                    </div>
                </section>
            </div>
        </main>
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
