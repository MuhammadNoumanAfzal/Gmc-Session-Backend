@extends('layouts.admin')

@section('content')
    <div class="row animate-fade-in">
        <div class="col-xl-8 col-lg-10 col-md-12 col-sm-12 col-12">
            
            <!-- Tailwind Redesigned Settings Card (Light & Dark Theme Toggle) -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-sm transition-colors duration-200">
                
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center bg-white dark:bg-slate-900 transition-colors">
                    <i class="fa-solid fa-gears text-gmcBlue dark:text-blue-400 mr-3 text-lg"></i>
                    <h5 class="m-0 text-base font-bold font-sora text-slate-800 dark:text-white">
                        System Admin Profile Profile Settings
                    </h5>
                </div>
                
                <div class="p-6 bg-white dark:bg-slate-900 transition-colors">
                    @if (session('success'))
                        <div class="mb-6 flex items-center bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-100 dark:border-emerald-900/30 text-gmcGreen dark:text-emerald-400 px-4 py-3 rounded-xl text-sm font-medium">
                            <i class="fa-solid fa-circle-check mr-2 text-base text-gmcGreen"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 dark:bg-red-950/20 border border-red-100 dark:border-red-900/30 text-red-750 dark:text-red-400 p-4 rounded-xl text-sm">
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

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Section: Basic Information -->
                            <div class="bg-slate-50/50 dark:bg-slate-850/40 border border-slate-200 dark:border-slate-800 rounded-xl p-5 space-y-4 transition-colors">
                                <h4 class="text-sm font-bold font-sora text-slate-850 dark:text-white border-b border-slate-200/60 dark:border-slate-800 pb-3 flex items-center">
                                    <i class="fa-solid fa-address-card text-gmcBlue dark:text-blue-400 mr-2"></i>
                                    Basic Information
                                </h4>
                                
                                <div class="space-y-1">
                                    <label for="name" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Administrator Name</label>
                                    <input id="name" name="name" type="text" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                                           value="{{ old('name', $user->name) }}" required>
                                </div>

                                <div class="space-y-1">
                                    <label for="email" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Email Address</label>
                                    <input id="email" name="email" type="email" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                                           value="{{ old('email', $user->email) }}" required>
                                </div>

                                <div class="space-y-1">
                                    <span class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Designated System Role</span>
                                    <div class="w-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-750 text-slate-500 dark:text-slate-450 rounded-xl px-4 py-2.5 text-sm font-bold capitalize">
                                        {{ $user->role === 'owner' ? 'System Owner Admin' : 'Auditor Revenue Officer' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Password Management -->
                            <div class="bg-slate-50/50 dark:bg-slate-850/40 border border-slate-200 dark:border-slate-800 rounded-xl p-5 space-y-4 transition-colors">
                                <h4 class="text-sm font-bold font-sora text-slate-850 dark:text-white border-b border-slate-200/60 dark:border-slate-800 pb-3 flex items-center">
                                    <i class="fa-solid fa-key text-gmcGold mr-2"></i>
                                    Security Credentials
                                </h4>
                                
                                <div class="space-y-1">
                                    <label for="password" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">New Password</label>
                                    <input id="password" name="password" type="password" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition placeholder-slate-300 dark:placeholder-slate-700" 
                                           placeholder="Leave empty to keep current password">
                                </div>

                                <div class="space-y-1">
                                    <label for="password_confirmation" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Confirm New Password</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition placeholder-slate-300 dark:placeholder-slate-700" 
                                           placeholder="Re-type new password to verify">
                                </div>
                            </div>
                            
                        </div>

                        <div class="pt-4 flex justify-between items-center border-t border-slate-100 dark:border-slate-850">
                            <a href="{{ route('payment-proofs.index') }}" class="inline-flex items-center text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-350 transition-colors">
                                <i class="fa-solid fa-arrow-left mr-2"></i>
                                Back to Panel
                            </a>
                            <button type="submit" 
                                    class="px-8 py-3 rounded-xl bg-gmcBlue hover:bg-gmcBlueDark text-white font-bold text-sm shadow-md shadow-blue-150 dark:shadow-none transition-colors">
                                <i class="fa-solid fa-floppy-disk mr-2"></i>
                                Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
@endsection
