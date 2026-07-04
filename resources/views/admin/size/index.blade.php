@extends('layouts.admin')

@section('content')
    <div class="row animate-fade-in">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            
            <!-- Tailwind Redesigned Card -->
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-white">
                    <h5 class="m-0 text-base font-bold font-sora text-slate-800 flex items-center">
                        <i class="fa-solid fa-ruler-combined text-indigo-500 mr-3 text-lg"></i>
                        Size Parameter Parameters
                    </h5>
                    <a href="{{ route('size.create') }}" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs flex items-center transition shadow-md shadow-indigo-150">
                        <i class="fa-solid fa-plus mr-1.5 text-xs"></i>
                        Add New Size
                    </a>
                </div>
                
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50 text-slate-500 font-sora text-xs uppercase tracking-wider">
                                    <th class="py-3 px-6 font-bold">Size Label</th>
                                    <th class="py-3 px-6 font-bold text-center">Edit</th>
                                    <th class="py-3 px-6 font-bold text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-600 bg-white">
                                @forelse ($values as $value)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="py-3.5 px-6 font-bold text-slate-800">
                                            {{ $value->size }}
                                        </td>
                                        <td class="py-3.5 px-6 text-center">
                                            <a href="{{ route('size.edit', $value->id) }}" 
                                               class="inline-flex items-center px-3.5 py-1.5 bg-slate-50 hover:bg-indigo-50 border border-slate-200 hover:border-indigo-300 text-xs font-bold rounded-xl text-slate-650 hover:text-indigo-600 transition">
                                                <i class="fa-solid fa-pen-to-square mr-1.5"></i>
                                                Edit
                                            </a>
                                        </td>
                                        <td class="py-3.5 px-6 text-center">
                                            <a href="{{ route('size.destroy', $value->id) }}" 
                                               onclick="return confirm('Are you sure you want to delete this size?')"
                                               class="inline-flex items-center px-3.5 py-1.5 bg-slate-50 hover:bg-red-50 border border-slate-200 hover:border-red-300 text-xs font-bold rounded-xl text-slate-650 hover:text-red-600 transition">
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
