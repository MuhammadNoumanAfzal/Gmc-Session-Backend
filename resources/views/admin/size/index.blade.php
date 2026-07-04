@extends('layouts.admin')

@section('content')
    <div class="row animate-fade-in">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            
            <!-- Tailwind Redesigned Card (Light & Dark Theme Toggle) -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-sm transition-colors duration-200">
                
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-white dark:bg-slate-900 transition-colors">
                    <h5 class="m-0 text-base font-bold font-sora text-slate-800 dark:text-white flex items-center">
                        <i class="fa-solid fa-ruler-combined text-gmcBlue dark:text-blue-400 mr-3 text-lg"></i>
                        Size Parameter Parameters
                    </h5>
                    <a href="{{ route('size.create') }}" class="px-4 py-2 rounded-xl bg-gmcBlue hover:bg-gmcBlueDark text-white font-bold text-xs flex items-center transition shadow-md shadow-blue-100 dark:shadow-none">
                        <i class="fa-solid fa-plus mr-1.5 text-xs"></i>
                        Add New Size
                    </a>
                </div>
                
                <div class="p-6 bg-white dark:bg-slate-900 transition-colors">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/60 text-slate-500 dark:text-slate-400 font-sora text-xs uppercase tracking-wider transition-colors">
                                    <th class="py-3 px-6 font-bold">Size Label</th>
                                    <th class="py-3 px-6 font-bold text-center">Edit</th>
                                    <th class="py-3 px-6 font-bold text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-600 dark:text-slate-450 bg-white dark:bg-slate-900 transition-colors">
                                @forelse ($values as $value)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors duration-150">
                                        <td class="py-3.5 px-6 font-bold text-slate-850 dark:text-white">
                                            {{ $value->size }}
                                        </td>
                                        <td class="py-3.5 px-6 text-center">
                                            <a href="{{ route('size.edit', $value->id) }}" 
                                               class="inline-flex items-center px-3.5 py-1.5 bg-slate-50 dark:bg-slate-800 hover:bg-blue-50 dark:hover:bg-blue-950/20 border border-slate-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-900 text-xs font-bold rounded-xl text-slate-650 dark:text-slate-400 hover:text-gmcBlue dark:hover:text-blue-400 transition">
                                                <i class="fa-solid fa-pen-to-square mr-1.5"></i>
                                                Edit
                                            </a>
                                        </td>
                                        <td class="py-3.5 px-6 text-center">
                                            <a href="{{ route('size.destroy', $value->id) }}" 
                                               onclick="return confirm('Are you sure you want to delete this size?')"
                                               class="inline-flex items-center px-3.5 py-1.5 bg-slate-50 dark:bg-slate-800 hover:bg-red-50 dark:hover:bg-red-950/20 border border-slate-200 dark:border-slate-700 hover:border-red-300 dark:hover:border-red-900 text-xs font-bold rounded-xl text-slate-650 dark:text-slate-400 hover:text-red-650 dark:hover:text-red-400 transition">
                                                <i class="fa-solid fa-trash-can mr-1.5"></i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-8 text-center text-slate-400">
                                            No size parameters found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
