@extends('layouts.admin')

@section('content')
    <style>
        .settings-shell {
            position: relative;
        }

        .settings-shell::before {
            content: '';
            position: absolute;
            inset: 0 auto auto 0;
            width: 320px;
            height: 320px;
            pointer-events: none;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.14) 0%, transparent 68%);
            filter: blur(12px);
        }

        .settings-panel {
            position: relative;
            overflow: hidden;
        }

        .settings-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.06), transparent 22%),
                radial-gradient(circle at top right, rgba(192, 132, 252, 0.08), transparent 34%);
        }

        .settings-card {
            position: relative;
            overflow: hidden;
        }

        .settings-card::before {
            content: '';
            position: absolute;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.06), transparent 28%),
                radial-gradient(circle at top right, rgba(167, 139, 250, 0.10), transparent 42%);
        }

        .settings-input {
            min-height: 54px;
        }

        .settings-label {
            letter-spacing: 0.14em;
        }
    </style>

    <div class="row animate-fade-in">
        <div class="col-xl-10 col-lg-11 col-md-12 col-sm-12 col-12">
            
            <div class="settings-shell">
            <!-- Tailwind Redesigned Settings Card (Light & Dark Theme Toggle) -->
            <div class="settings-panel admin-panel admin-glow bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-violet-500/10 rounded-[30px] overflow-hidden shadow-sm transition-colors duration-200">
                
                <div class="px-7 py-6 border-b border-slate-100 dark:border-violet-500/10 flex items-start justify-between bg-white/60 dark:bg-white/[0.02] transition-colors">
                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-100 text-gmcBlue shadow-sm dark:bg-violet-500/15 dark:text-violet-200">
                            <i class="fa-solid fa-gears text-lg"></i>
                        </div>
                        <div>
                            <h5 class="m-0 text-xl font-black font-sora text-slate-800 dark:text-white">
                                Account Settings
                            </h5>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                Manage your administrator profile, login email, and account security from one place.
                            </p>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center rounded-full border border-violet-200/80 bg-violet-50/80 px-3 py-1.5 text-[11px] font-bold uppercase tracking-[0.18em] text-violet-700 dark:border-violet-500/20 dark:bg-violet-500/10 dark:text-violet-200">
                        Trusted Admin
                    </div>
                </div>
                
                <div class="p-7 bg-white/20 dark:bg-transparent transition-colors">
                    @if (session('success'))
                        <div class="mb-6 flex items-center bg-emerald-50/90 dark:bg-emerald-950/20 border border-emerald-100 dark:border-emerald-900/30 text-gmcGreen dark:text-emerald-400 px-4 py-3.5 rounded-2xl text-sm font-medium shadow-sm">
                            <i class="fa-solid fa-circle-check mr-2 text-base text-gmcGreen"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50/90 dark:bg-red-950/20 border border-red-100 dark:border-red-900/30 text-red-750 dark:text-red-400 p-4 rounded-2xl text-sm shadow-sm">
                            <h5 class="font-bold mb-2 flex items-center">
                                <i class="fa-solid fa-circle-exclamation mr-2 text-base text-red-650"></i>
                                Form Validation Errors
                            </h5>
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('settings.update') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                            
                            <!-- Section: Basic Information -->
                            <section class="settings-card admin-panel rounded-[26px] border border-slate-200/80 bg-white/70 p-6 shadow-sm transition-colors dark:border-violet-500/10 dark:bg-white/[0.03]">
                                <div class="mb-6 flex items-start justify-between gap-4 border-b border-slate-200/70 pb-4 dark:border-violet-500/10">
                                    <div>
                                        <h4 class="text-base font-black font-sora text-slate-850 dark:text-white flex items-center">
                                            <i class="fa-solid fa-address-card text-gmcBlue dark:text-violet-200 mr-2"></i>
                                            Basic Information
                                        </h4>
                                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Profile details shown across the admin workspace.</p>
                                    </div>
                                    <span class="rounded-full bg-violet-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.16em] text-violet-700 dark:bg-violet-500/10 dark:text-violet-200">
                                        Profile
                                    </span>
                                </div>
                                
                                <div class="space-y-5">
                                <div class="space-y-2">
                                    <label for="name" class="settings-label block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase">Administrator Name</label>
                                    <input id="name" name="name" type="text" 
                                           class="settings-input w-full bg-white/95 dark:bg-slate-900 border border-slate-200 dark:border-violet-500/15 focus:border-gmcBlue dark:focus:border-violet-400 text-slate-805 dark:text-white rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-violet-500/10 transition shadow-sm" 
                                           value="{{ old('name', $user->name) }}" required>
                                </div>

                                <div class="space-y-2">
                                    <label for="email" class="settings-label block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase">Email Address</label>
                                    <input id="email" name="email" type="email" 
                                           class="settings-input w-full bg-white/95 dark:bg-slate-900 border border-slate-200 dark:border-violet-500/15 focus:border-gmcBlue dark:focus:border-violet-400 text-slate-805 dark:text-white rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-violet-500/10 transition shadow-sm" 
                                           value="{{ old('email', $user->email) }}" required>
                                </div>

                                <div class="space-y-2">
                                    <span class="settings-label block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase">Designated System Role</span>
                                    <div class="settings-input flex w-full items-center rounded-2xl border border-slate-200 bg-slate-50/90 px-4 py-3 text-sm font-bold capitalize text-slate-600 shadow-sm dark:border-violet-500/12 dark:bg-white/[0.04] dark:text-violet-100">
                                        {{ $user->role === 'owner' ? 'System Owner Admin' : 'Auditor Revenue Officer' }}
                                    </div>
                                </div>
                                </div>
                            </section>

                            <!-- Section: Password Management -->
                            <section class="settings-card admin-panel rounded-[26px] border border-slate-200/80 bg-white/70 p-6 shadow-sm transition-colors dark:border-violet-500/10 dark:bg-white/[0.03]">
                                <div class="mb-6 flex items-start justify-between gap-4 border-b border-slate-200/70 pb-4 dark:border-violet-500/10">
                                    <div>
                                        <h4 class="text-base font-black font-sora text-slate-850 dark:text-white flex items-center">
                                            <i class="fa-solid fa-key text-gmcGold mr-2"></i>
                                            Security Credentials
                                        </h4>
                                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Update sensitive login details with an extra verification step.</p>
                                    </div>
                                    <span class="rounded-full bg-amber-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.16em] text-amber-700 dark:bg-amber-500/10 dark:text-amber-300">
                                        Secure
                                    </span>
                                </div>

                                <div class="mb-5 rounded-2xl border border-amber-200/70 bg-amber-50/80 px-4 py-3.5 text-sm leading-6 text-amber-800 dark:border-amber-900/40 dark:bg-amber-950/20 dark:text-amber-300">
                                    To protect this trusted account, enter your current password whenever you change the email address or set a new password.
                                </div>

                                <div class="space-y-5">
                                <div class="space-y-2">
                                    <label for="current_password" class="settings-label block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase">Current Password</label>
                                    <input id="current_password" name="current_password" type="password" 
                                           class="settings-input w-full bg-white/95 dark:bg-slate-900 border border-slate-200 dark:border-violet-500/15 focus:border-gmcBlue dark:focus:border-violet-400 text-slate-805 dark:text-white rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-violet-500/10 transition placeholder-slate-300 dark:placeholder-slate-700 shadow-sm" 
                                           placeholder="Required for email or password changes">
                                </div>
                                
                                <div class="space-y-2">
                                    <label for="password" class="settings-label block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase">New Password</label>
                                    <input id="password" name="password" type="password" 
                                           class="settings-input w-full bg-white/95 dark:bg-slate-900 border border-slate-200 dark:border-violet-500/15 focus:border-gmcBlue dark:focus:border-violet-400 text-slate-805 dark:text-white rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-violet-500/10 transition placeholder-slate-300 dark:placeholder-slate-700 shadow-sm" 
                                           placeholder="Leave empty to keep current password">
                                </div>

                                <div class="space-y-2">
                                    <label for="password_confirmation" class="settings-label block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase">Confirm New Password</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" 
                                           class="settings-input w-full bg-white/95 dark:bg-slate-900 border border-slate-200 dark:border-violet-500/15 focus:border-gmcBlue dark:focus:border-violet-400 text-slate-805 dark:text-white rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-violet-500/10 transition placeholder-slate-300 dark:placeholder-slate-700 shadow-sm" 
                                           placeholder="Re-type new password to verify">
                                </div>
                                </div>
                            </section>
                            
                        </div>

                        <div class="pt-5 flex flex-col gap-4 border-t border-slate-100 dark:border-violet-500/10 md:flex-row md:items-center md:justify-between">
                            <div>
                                <a href="{{ route(auth()->user()->role === 'owner' ? 'admin.dashboard' : 'payment-proofs.index') }}" class="inline-flex items-center text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 transition-colors">
                                    <i class="fa-solid fa-arrow-left mr-2"></i>
                                    Back to Panel
                                </a>
                                <p class="mt-2 text-xs text-slate-400 dark:text-slate-500">Changes apply immediately after a successful save.</p>
                            </div>
                            <button type="submit" 
                                    class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-gmcBlue to-gmcBlueDark px-8 py-3.5 text-sm font-bold text-white shadow-[0_16px_34px_rgba(109,40,217,0.28)] transition-all hover:translate-y-[-1px] hover:shadow-[0_18px_40px_rgba(109,40,217,0.34)]">
                                <i class="fa-solid fa-floppy-disk mr-2"></i>
                                Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            
        </div>
    </div>
@endsection
