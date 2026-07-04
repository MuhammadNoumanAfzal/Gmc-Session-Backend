@extends('layouts.admin')

@section('content')
    <div class="row animate-fade-in">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            
            <!-- Tailwind Redesigned Card (Light & Dark Theme Toggle) -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-sm transition-colors duration-200">
                
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-white dark:bg-slate-900 transition-colors">
                    <h5 class="m-0 text-base font-bold font-sora text-slate-800 dark:text-white flex items-center">
                        <i class="fa-solid fa-users-gear text-gmcBlue dark:text-blue-400 mr-3 text-lg"></i>
                        Authorized Workspace Employees
                    </h5>
                    <a href="{{ route('employees.create') }}" class="px-4 py-2 rounded-xl bg-gmcBlue hover:bg-gmcBlueDark text-white font-bold text-xs flex items-center transition shadow-md shadow-blue-100 dark:shadow-none">
                        <i class="fa-solid fa-plus-circle mr-1.5 text-xs"></i>
                        Add Employee Account
                    </a>
                </div>
                
                <div class="p-6 bg-white dark:bg-slate-900 transition-colors">
                    @if (session('success'))
                        <div class="mb-5 flex items-center bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-100 dark:border-emerald-900/30 text-gmcGreen dark:text-emerald-400 px-4 py-3 rounded-xl text-sm font-medium">
                            <i class="fa-solid fa-circle-check mr-2 text-base text-gmcGreen"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/60 text-slate-550 dark:text-slate-400 font-sora text-xs uppercase tracking-wider transition-colors">
                                    <th class="py-3.5 px-6 font-bold">Employee Name</th>
                                    <th class="py-3.5 px-6 font-bold">Email Address</th>
                                    <th class="py-3.5 px-6 font-bold">Access Privileges</th>
                                    <th class="py-3.5 px-6 font-bold text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-600 dark:text-slate-400 bg-white dark:bg-slate-900 transition-colors">
                                @forelse ($employees as $employee)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors duration-150">
                                        
                                        <!-- Column 1: Name -->
                                        <td class="py-4 px-6">
                                            <span class="text-slate-850 dark:text-white font-extrabold text-base">{{ $employee->name }}</span>
                                        </td>

                                        <!-- Column 2: Email -->
                                        <td class="py-4 px-6">
                                            <span class="font-bold text-slate-500 dark:text-slate-400">{{ $employee->email }}</span>
                                        </td>

                                        <!-- Column 3: Active Permissions -->
                                        <td class="py-4 px-6">
                                            <div class="flex flex-wrap gap-1.5">
                                                @if(is_array($employee->permissions) && count($employee->permissions) > 0)
                                                    @foreach($employee->permissions as $permission)
                                                        @if($permission === 'dashboard')
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 dark:bg-blue-950/20 text-gmcBlue dark:text-blue-400 border border-blue-100 dark:border-blue-900/30 uppercase tracking-wide">
                                                                Dashboard
                                                            </span>
                                                        @elseif($permission === 'proofs')
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 dark:bg-emerald-950/20 text-gmcGreen dark:text-emerald-400 border border-emerald-100 dark:border-emerald-900/30 uppercase tracking-wide">
                                                                Proofs
                                                            </span>
                                                        @elseif($permission === 'sizes')
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 dark:bg-amber-950/20 text-gmcGold border border-amber-100 dark:border-amber-900/30 uppercase tracking-wide">
                                                                Sizes
                                                            </span>
                                                        @else
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700 uppercase tracking-wide">
                                                                {{ $permission }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <span class="text-xs text-slate-400 italic">No Access Granted</span>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- Column 4: CRUD Actions -->
                                        <td class="py-4 px-6 text-center">
                                            <div class="inline-flex items-center space-x-2">
                                                
                                                <!-- Action: Edit -->
                                                <a href="{{ route('employees.edit', $employee->id) }}" 
                                                   class="inline-flex items-center px-3.5 py-1.5 bg-slate-50 dark:bg-slate-800 hover:bg-blue-50 dark:hover:bg-blue-950/20 border border-slate-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-900 text-xs font-bold rounded-xl text-slate-650 dark:text-slate-400 hover:text-gmcBlue dark:hover:text-blue-400 transition" 
                                                   title="Edit Employee Credentials">
                                                    <i class="fa-solid fa-pen-to-square mr-1.5"></i>
                                                    Edit
                                                </a>
                                                
                                                <!-- Action: Delete -->
                                                <a href="{{ route('employees.destroy', $employee->id) }}" 
                                                   onclick="return confirm('Are you sure you want to delete this employee account?')"
                                                   class="inline-flex items-center px-3.5 py-1.5 bg-slate-50 dark:bg-slate-800 hover:bg-red-50 dark:hover:bg-red-950/20 border border-slate-200 dark:border-slate-700 hover:border-red-300 dark:hover:border-red-900 text-xs font-bold rounded-xl text-slate-655 dark:text-slate-400 hover:text-red-650 dark:hover:text-red-400 transition" 
                                                   title="Delete Account">
                                                    <i class="fa-solid fa-trash-can mr-1.5"></i>
                                                    Delete
                                                </a>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-12 px-6 text-center text-slate-400">
                                            <i class="fa-solid fa-users-slash text-4xl mb-3 text-slate-200 dark:text-slate-800 block"></i>
                                            No employee accounts found.
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
