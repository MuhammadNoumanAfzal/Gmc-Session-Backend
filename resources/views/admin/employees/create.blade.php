@extends('layouts.admin')

@section('content')
    <div class="row animate-fade-in">
        <div class="col-xl-8 col-lg-10 col-md-12 col-sm-12 col-12">
            
            <!-- Tailwind Redesigned Card (Light & Dark Theme Toggle) -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-sm transition-colors duration-200">
                
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center bg-white dark:bg-slate-900 transition-colors">
                    <i class="fa-solid fa-plus-circle text-gmcBlue dark:text-blue-400 mr-3 text-lg"></i>
                    <h5 class="m-0 text-base font-bold font-sora text-slate-800 dark:text-white">
                        Create New Employee Account
                    </h5>
                </div>
                
                <div class="p-6 bg-white dark:bg-slate-900 transition-colors">
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

                    <form action="{{ route('employees.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Section: Account Credentials -->
                            <div class="bg-slate-50/50 dark:bg-slate-850/40 border border-slate-200 dark:border-slate-800 rounded-xl p-5 space-y-4 transition-colors">
                                <h4 class="text-sm font-bold font-sora text-slate-850 dark:text-white border-b border-slate-200/60 dark:border-slate-800 pb-3 flex items-center">
                                    <i class="fa-solid fa-user-plus text-gmcBlue dark:text-blue-400 mr-2"></i>
                                    Account Credentials
                                </h4>
                                
                                <div class="space-y-1">
                                    <label for="name" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Employee Name</label>
                                    <input id="name" name="name" type="text" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                                           placeholder="E.g., John Doe" value="{{ old('name') }}" required>
                                </div>

                                <div class="space-y-1">
                                    <label for="email" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Email Address</label>
                                    <input id="email" name="email" type="email" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                                           placeholder="john.doe@gmc.edu.pk" value="{{ old('email') }}" required>
                                </div>

                                <div class="space-y-1">
                                    <label for="password" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Initial Password</label>
                                    <input id="password" name="password" type="password" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition placeholder-slate-350 dark:placeholder-slate-700" 
                                           placeholder="Minimum 6 characters" required>
                                </div>
                            </div>

                            <!-- Section: Access Privileges / Permissions -->
                            <div class="bg-slate-50/50 dark:bg-slate-850/40 border border-slate-200 dark:border-slate-800 rounded-xl p-5 space-y-4 transition-colors">
                                <h4 class="text-sm font-bold font-sora text-slate-850 dark:text-white border-b border-slate-200/60 dark:border-slate-800 pb-3 flex items-center">
                                    <i class="fa-solid fa-shield-halved text-gmcGold mr-2"></i>
                                    Module Access Permissions
                                </h4>
                                
                                <p class="text-xs text-slate-400 dark:text-slate-500 leading-relaxed mb-2 font-medium">
                                    Select which sections of the GMC Sessions workspace this employee will be permitted to access.
                                </p>

                                <div class="space-y-3">
                                    
                                    <!-- Option: Dashboard -->
                                    <label class="flex items-start p-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer hover:border-blue-300 dark:hover:border-blue-900 transition">
                                        <input type="checkbox" name="permissions[]" value="dashboard" 
                                               class="h-4.5 w-4.5 mt-0.5 rounded border-slate-300 dark:border-slate-800 text-gmcBlue focus:ring-gmcBlue/20 dark:bg-slate-950">
                                        <div class="ml-3">
                                            <span class="block text-xs font-bold text-slate-800 dark:text-white uppercase tracking-wider">Dashboard module</span>
                                            <span class="block text-[10px] text-slate-400 dark:text-slate-550 mt-0.5">Allows accessing statistics, revenue line charts, recent transaction feeds, and methodology maps.</span>
                                        </div>
                                    </label>

                                    <!-- Option: Payment Proofs -->
                                    <label class="flex items-start p-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer hover:border-gmcGreen/30 dark:hover:border-gmcGreen/30 transition">
                                        <input type="checkbox" name="permissions[]" value="proofs" 
                                               class="h-4.5 w-4.5 mt-0.5 rounded border-slate-300 dark:border-slate-800 text-gmcGreen focus:ring-gmcGreen/20 dark:bg-slate-950" checked>
                                        <div class="ml-3">
                                            <span class="block text-xs font-bold text-slate-800 dark:text-white uppercase tracking-wider">Payment Proofs</span>
                                            <span class="block text-[10px] text-slate-400 dark:text-slate-550 mt-0.5">Allows viewing lists, auditing student proofs, updating verification status, downloading screenshots, and printing slips.</span>
                                        </div>
                                    </label>

                                    <!-- Option: Size Parameters -->
                                    <label class="flex items-start p-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer hover:border-gmcGold/30 dark:hover:border-gmcGold/30 transition">
                                        <input type="checkbox" name="permissions[]" value="sizes" 
                                               class="h-4.5 w-4.5 mt-0.5 rounded border-slate-300 dark:border-slate-800 text-gmcGold focus:ring-gmcGold/20 dark:bg-slate-950">
                                        <div class="ml-3">
                                            <span class="block text-xs font-bold text-slate-800 dark:text-white uppercase tracking-wider">Size Parameters CRUD</span>
                                            <span class="block text-[10px] text-slate-400 dark:text-slate-550 mt-0.5">Allows updating configurations, sizes parameters list, creation panels, and parameter deletions.</span>
                                        </div>
                                    </label>

                                </div>
                            </div>
                            
                        </div>

                        <div class="pt-4 flex justify-between items-center border-t border-slate-100 dark:border-slate-850">
                            <a href="{{ route('employees.index') }}" class="inline-flex items-center text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-350 transition-colors">
                                <i class="fa-solid fa-arrow-left mr-2"></i>
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-8 py-3 rounded-xl bg-gmcBlue hover:bg-gmcBlueDark text-white font-bold text-sm shadow-md shadow-blue-150 dark:shadow-none transition-colors">
                                <i class="fa-solid fa-save mr-2"></i>
                                Save Employee Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
@endsection
