@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            
            <!-- Tailwind Redesigned Card (Light & Dark Theme) -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-sm transition-colors duration-200">
                
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-white dark:bg-slate-900 transition-colors">
                    <h5 class="m-0 text-base font-bold font-sora text-slate-850 dark:text-white flex items-center">
                        <i class="fa-solid fa-file-invoice text-gmcBlue dark:text-blue-400 mr-3 text-lg"></i>
                        Payment Submissions
                    </h5>
                    <span class="text-xs text-slate-500 dark:text-slate-400 font-semibold bg-slate-100 dark:bg-slate-800 px-3 py-1.5 rounded-full border border-slate-200 dark:border-slate-700">
                        {{ count($values) }} Submissions Total
                    </span>
                </div>
                
                <div class="p-6 bg-white dark:bg-slate-900 transition-colors">
                    @if (session('success'))
                        <div class="mb-5 flex items-center bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-100 dark:border-emerald-900/30 text-gmcGreen dark:text-emerald-400 px-4 py-3 rounded-xl text-sm font-medium">
                            <i class="fa-solid fa-circle-check mr-2 text-base text-gmcGreen"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Responsive Streamlined Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/60 text-slate-550 dark:text-slate-400 font-sora text-xs uppercase tracking-wider transition-colors">
                                    <th class="py-3.5 px-4 font-bold">Student details</th>
                                    <th class="py-3.5 px-4 font-bold">Allocation</th>
                                    <th class="py-3.5 px-4 font-bold">Amount Paid</th>
                                    <th class="py-3.5 px-4 font-bold">Status</th>
                                    <th class="py-3.5 px-4 font-bold text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm text-slate-600 dark:text-slate-400 bg-white dark:bg-slate-900 transition-colors">
                                @forelse ($values as $value)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors duration-150">
                                        
                                        <!-- Column 1: Student details (Name + WhatsApp + Duplicate alert) -->
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-slate-850 dark:text-white font-extrabold text-base">{{ $value->full_name }}</span>
                                                @if($value->duplicate_submission)
                                                    <span class="bg-red-50 dark:bg-red-950/30 text-red-550 dark:text-red-400 border border-red-100 dark:border-red-900/30 text-[10px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wide" title="Duplicate Reference Alert">
                                                        Dup
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="flex items-center space-x-3 mt-1 text-xs">
                                                <span class="text-gmcBlue dark:text-blue-400 font-bold font-mono">{{ strtoupper($value->submission_id) }}</span>
                                                <span class="text-slate-200 dark:text-slate-800">|</span>
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $value->whatsapp_number) }}" target="_blank" class="text-slate-500 dark:text-slate-450 hover:text-gmcGreen dark:hover:text-emerald-400 transition-colors flex items-center font-medium">
                                                    <i class="fa-brands fa-whatsapp mr-1 text-gmcGreen"></i>
                                                    {{ $value->whatsapp_number }}
                                                </a>
                                            </div>
                                        </td>
                                        
                                        <!-- Column 2: Allocation (Program & Session type) -->
                                        <td class="py-4 px-4">
                                            <div class="text-slate-850 dark:text-white font-bold">
                                                @php
                                                    $names = [
                                                        'prog_fullstack_web' => 'Full-Stack Web',
                                                        'prog_data_analytics' => 'Data Analytics',
                                                        'prog_uiux_design' => 'UI/UX Design',
                                                        'prog_mobile_app' => 'Mobile App Dev'
                                                    ];
                                                    echo $names[$value->program_id] ?? ucwords(str_replace('_', ' ', $value->program_id));
                                                @endphp
                                            </div>
                                            <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">{{ $value->session_type }}</div>
                                        </td>
                                        
                                        <!-- Column 3: Amount Paid -->
                                        <td class="py-4 px-4">
                                            <span class="text-slate-850 dark:text-white font-extrabold text-base">${{ number_format((float) $value->amount_paid, 2) }}</span>
                                        </td>
                                        
                                        <!-- Column 4: Status -->
                                        <td class="py-4 px-4">
                                            @if($value->status === 'approved')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-950/20 text-gmcGreen border border-emerald-100 dark:border-emerald-900/30 uppercase tracking-wide">
                                                    <span class="w-1.5 h-1.5 bg-gmcGreen rounded-full mr-1.5"></span>
                                                    Approved
                                                </span>
                                            @elseif($value->status === 'rejected')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-50 dark:bg-red-950/20 text-red-600 dark:text-red-400 border border-red-100 dark:border-red-900/30 uppercase tracking-wide">
                                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                                    Rejected
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-50 dark:bg-amber-950/20 text-gmcGold border border-amber-100 dark:border-amber-900/30 uppercase tracking-wide">
                                                    <span class="w-1.5 h-1.5 bg-gmcGold rounded-full mr-1.5 animate-pulse"></span>
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        
                                        <!-- Column 5: Actions -->
                                        <td class="py-4 px-4 text-center">
                                            <div class="inline-flex items-center space-x-1.5">
                                                
                                                <!-- Action: View details -->
                                                <a href="{{ route('payment-proofs.show', $value->id) }}" 
                                                   class="p-2 bg-slate-50 dark:bg-slate-800 hover:bg-blue-50 dark:hover:bg-blue-950/30 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:text-gmcBlue dark:hover:text-blue-400 rounded-xl transition duration-150" 
                                                   title="View Full Details">
                                                    <i class="fa-solid fa-eye text-sm"></i>
                                                </a>
                                                
                                                <!-- Action: Edit / Review -->
                                                <a href="{{ route('payment-proofs.edit', $value->id) }}" 
                                                   class="p-2 bg-slate-50 dark:bg-slate-800 hover:bg-emerald-50 dark:hover:bg-emerald-950/30 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:text-gmcGreen dark:hover:text-emerald-455 rounded-xl transition duration-150" 
                                                   title="Edit Submission">
                                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                                </a>
                                                
                                                <!-- Action: Receipt Slip -->
                                                <a href="{{ route('payment-proofs.slip', $value->id) }}" 
                                                   class="p-2 bg-slate-50 dark:bg-slate-800 hover:bg-amber-50 dark:hover:bg-amber-950/30 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:text-gmcGold rounded-xl transition duration-150" 
                                                   title="Generate Receipt Slip" target="_blank">
                                                    <i class="fa-solid fa-file-invoice text-sm"></i>
                                                </a>
                                                
                                                <!-- Action: Download Proof File -->
                                                <a href="{{ route('payment-proofs.download', $value->id) }}" 
                                                   class="p-2 bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:text-slate-850 dark:hover:text-white rounded-xl transition duration-150" 
                                                   title="Download Proof File">
                                                    <i class="fa-solid fa-download text-sm"></i>
                                                </a>
                                                
                                                <!-- Action: Delete -->
                                                <a href="{{ route('payment-proofs.destroy', $value->id) }}"
                                                   onclick="return confirm('Are you sure you want to delete this submission?')"
                                                   class="p-2 bg-slate-50 dark:bg-slate-800 hover:bg-red-50 dark:hover:bg-red-950/30 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:text-red-600 rounded-xl transition duration-150" 
                                                   title="Delete Submission">
                                                    <i class="fa-solid fa-trash-can text-sm"></i>
                                                </a>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-12 px-4 text-center text-slate-400">
                                            <i class="fa-solid fa-folder-open text-4xl mb-3 text-slate-200 dark:text-slate-850 block"></i>
                                            No payment proof submissions found.
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
