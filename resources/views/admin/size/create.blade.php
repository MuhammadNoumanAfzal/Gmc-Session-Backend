@extends('layouts.admin')

@section('content')
    <div class="row animate-fade-in">
        <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 col-12">
            
            <!-- Tailwind Redesigned Card -->
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                
                <div class="px-6 py-4 border-b border-slate-100 flex items-center bg-white">
                    <i class="fa-solid fa-plus-circle text-indigo-500 mr-3 text-lg"></i>
                    <h5 class="m-0 text-base font-bold font-sora text-slate-800">
                        Create New Size Parameter
                    </h5>
                </div>
                
                <div class="p-6">
                    <form action="{{ route('size.store') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        <div class="space-y-1">
                            <label for="size" class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Size Label</label>
                            <input id="size" name="size" type="text" 
                                   class="w-full bg-white border border-slate-200 focus:border-indigo-500 text-slate-800 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-indigo-500/10 transition" 
                                   placeholder="E.g., Small, Medium, Large, A4, 1-on-1" required>
                        </div>

                        <div class="pt-4 flex justify-between items-center border-t border-slate-100">
                            <a href="{{ route('size.index') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors">
                                <i class="fa-solid fa-arrow-left mr-2"></i>
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-md shadow-indigo-100 transition-colors">
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
