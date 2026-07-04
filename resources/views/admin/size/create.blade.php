@extends('layouts.admin')

@section('content')
    <div class="row animate-fade-in">
        <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 col-12">
            
            <!-- Tailwind Redesigned Card (Light & Dark Theme Toggle) -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-sm transition-colors duration-200">
                
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center bg-white dark:bg-slate-900 transition-colors">
                    <i class="fa-solid fa-plus-circle text-gmcBlue dark:text-blue-400 mr-3 text-lg"></i>
                    <h5 class="m-0 text-base font-bold font-sora text-slate-800 dark:text-white">
                        Create New Size Parameter
                    </h5>
                </div>
                
                <div class="p-6 bg-white dark:bg-slate-900 transition-colors">
                    <form action="{{ route('size.store') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        <div class="space-y-1">
                            <label for="size" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Size Label</label>
                            <input id="size" name="size" type="text" 
                                   class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                                   placeholder="E.g., Small, Medium, Large, A4, 1-on-1" required>
                        </div>

                        <div class="pt-4 flex justify-between items-center border-t border-slate-100 dark:border-slate-850">
                            <a href="{{ route('size.index') }}" class="inline-flex items-center text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-350 transition-colors">
                                <i class="fa-solid fa-arrow-left mr-2"></i>
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2.5 rounded-xl bg-gmcBlue hover:bg-gmcBlueDark text-white font-bold text-sm shadow-md shadow-blue-100 dark:shadow-none transition-colors">
                                <i class="fa-solid fa-save mr-2"></i>
                                Save Size Parameter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
@endsection
