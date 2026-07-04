@extends('layouts.admin')

@section('content')
    <div class="row animate-fade-in">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            
            <!-- Tailwind Redesigned Details Card (Light Theme) -->
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-white">
                    <h5 class="m-0 text-base font-bold font-sora text-slate-800 flex items-center">
                        <i class="fa-solid fa-circle-info text-indigo-500 mr-3 text-lg"></i>
                        Submission Info
                    </h5>
                    <span class="text-xs text-indigo-600 font-bold font-mono bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">
                        ID: {{ strtoupper($paymentProof->submission_id) }}
                    </span>
                </div>
                
                <div class="p-6">
                    
                    <!-- Stats Badge Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        
                        <!-- Block 1: Review Status -->
                        <div class="bg-slate-50 border border-slate-200 p-4 rounded-xl text-center flex flex-col items-center justify-center">
                            <span class="text-xs text-slate-400 uppercase tracking-wider mb-2 font-bold">Review Status</span>
                            @if($paymentProof->status === 'approved')
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase tracking-wide">
                                    Approved
                                </span>
                            @elseif($paymentProof->status === 'rejected')
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-red-50 text-red-600 border border-red-200 uppercase tracking-wide">
                                    Rejected
                                </span>
                            @else
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 uppercase tracking-wide animate-pulse">
                                    Pending Review
                                </span>
                            @endif
                        </div>
                        
                        <!-- Block 2: Amount Verified -->
                        <div class="bg-slate-50 border border-slate-200 p-4 rounded-xl text-center flex flex-col items-center justify-center">
                            <span class="text-xs text-slate-400 uppercase tracking-wider mb-1.5 font-bold">Amount Verified</span>
                            <span class="text-slate-800 font-extrabold text-2xl">${{ number_format($paymentProof->amount_paid, 2) }}</span>
                        </div>
                        
                        <!-- Block 3: Verification Alerts -->
                        <div class="bg-slate-50 border border-slate-200 p-4 rounded-xl text-center flex flex-col items-center justify-center">
                            <span class="text-xs text-slate-400 uppercase tracking-wider mb-2 font-bold">Fraud Detection</span>
                            @if($paymentProof->duplicate_submission)
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-red-50 text-red-600 border border-red-200 uppercase tracking-wide animate-bounce">
                                    Duplicate Detected
                                </span>
                            @else
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase tracking-wide">
                                    <i class="fa-solid fa-shield mr-1.5 text-emerald-600"></i> Unique Reference
                                </span>
                            @endif
                        </div>
                        
                    </div>

                    <!-- Split Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Student details -->
                        <div class="bg-white border border-slate-200 rounded-xl p-5">
                            <h4 class="text-sm font-bold font-sora text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center">
                                <i class="fa-solid fa-graduation-cap text-indigo-500 mr-2"></i>
                                Student & Course Allocation
                            </h4>
                            
                            <dl class="space-y-3 text-sm">
                                <div class="flex justify-between items-center">
                                    <dt class="text-slate-500 font-medium">Student Name</dt>
                                    <dd class="text-slate-800 font-bold">{{ $paymentProof->full_name }}</dd>
                                </div>
                                <div class="flex justify-between items-center">
                                    <dt class="text-slate-500 font-medium">WhatsApp Contact</dt>
                                    <dd>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $paymentProof->whatsapp_number) }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 hover:underline flex items-center font-bold">
                                            <i class="fa-brands fa-whatsapp mr-1.5 text-base"></i>
                                            {{ $paymentProof->whatsapp_number }}
                                        </a>
                                    </dd>
                                </div>
                                <div class="flex justify-between items-center">
                                    <dt class="text-slate-500 font-medium">Email Address</dt>
                                    <dd><a href="mailto:{{ $paymentProof->email }}" class="text-indigo-600 hover:text-indigo-700 hover:underline font-bold">{{ $paymentProof->email }}</a></dd>
                                </div>
                                <div class="flex justify-between items-center">
                                    <dt class="text-slate-500 font-medium">Enrolled Program</dt>
                                    <dd class="text-slate-800 font-bold text-right">
                                        @php
                                            $names = [
                                                'prog_fullstack_web' => 'Full-Stack Web Development',
                                                'prog_data_analytics' => 'Data Analytics Masterclass',
                                                'prog_uiux_design' => 'UI/UX Product Design',
                                                'prog_mobile_app' => 'Mobile App Development (React Native)'
                                            ];
                                            echo $names[$paymentProof->program_id] ?? ucwords(str_replace('_', ' ', $paymentProof->program_id));
                                        @endphp
                                    </dd>
                                </div>
                                <div class="flex justify-between items-center">
                                    <dt class="text-slate-500 font-medium">Session Category</dt>
                                    <dd class="text-slate-800 font-bold">{{ $paymentProof->session_type }}</dd>
                                </div>
                            </dl>
                        </div>
                        
                        <!-- Transaction details -->
                        <div class="bg-white border border-slate-200 rounded-xl p-5">
                            <h4 class="text-sm font-bold font-sora text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center">
                                <i class="fa-solid fa-bank text-amber-500 mr-2"></i>
                                Transaction Reference Info
                            </h4>
                            
                            <dl class="space-y-3 text-sm">
                                <div class="flex justify-between items-center">
                                    <dt class="text-slate-500 font-medium">Payment Method</dt>
                                    <dd class="text-slate-800 font-bold">{{ $paymentProof->payment_method }}</dd>
                                </div>
                                <div class="flex justify-between items-center">
                                    <dt class="text-slate-500 font-medium">Reference ID</dt>
                                    <dd><code class="text-slate-800 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded font-mono text-xs">{{ $paymentProof->transaction_reference }}</code></dd>
                                </div>
                                <div class="flex justify-between items-center">
                                    <dt class="text-slate-500 font-medium">Last 4 Digits</dt>
                                    <dd class="text-slate-800 font-mono font-bold">{{ $paymentProof->sender_account_last4 ?: 'Not Provided' }}</dd>
                                </div>
                                <div class="flex justify-between items-center">
                                    <dt class="text-slate-500 font-medium">Uploaded File</dt>
                                    <dd class="text-right">
                                        <div class="text-slate-800 font-bold truncate max-w-[200px]" title="{{ $paymentProof->payment_proof_original_name }}">{{ $paymentProof->payment_proof_original_name }}</div>
                                        <div class="text-xs text-slate-400 mt-0.5">{{ number_format($paymentProof->payment_proof_size / 1024, 2) }} KB ({{ $paymentProof->payment_proof_mime_type }})</div>
                                    </dd>
                                </div>
                                <div class="flex justify-between items-center">
                                    <dt class="text-slate-500 font-medium">Submission Notes</dt>
                                    <dd class="text-slate-800 font-bold max-w-[200px] text-right italic">{{ $paymentProof->notes ?: 'None' }}</dd>
                                </div>
                            </dl>
                        </div>
                        
                    </div>

                    <!-- System Timeline -->
                    <div class="mt-6 bg-slate-50 border border-slate-200 rounded-xl p-5">
                        <h4 class="text-sm font-bold font-sora text-slate-800 border-b border-slate-200 pb-2 mb-3 flex items-center">
                            <i class="fa-solid fa-clock text-emerald-600 mr-2"></i>
                            System Audit Logs
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-500">
                            <div>
                                <span class="block text-xs text-slate-400 font-semibold mb-0.5">Submitted Timestamp</span>
                                <span class="text-slate-800 font-bold">{{ $paymentProof->created_at->format('l, F d, Y - H:i:s') }}</span>
                            </div>
                            <div>
                                <span class="block text-xs text-slate-400 font-semibold mb-0.5">System Update Timestamp</span>
                                <span class="text-slate-800 font-bold">{{ $paymentProof->updated_at->format('l, F d, Y - H:i:s') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                        <div>
                            <a href="{{ route('payment-proofs.index') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">
                                <i class="fa-solid fa-arrow-left mr-2"></i>
                                Back to All Listings
                            </a>
                        </div>
                        <div class="flex flex-wrap items-center gap-3">
                            
                            <a href="{{ route('payment-proofs.download', $paymentProof->id) }}" class="px-4 py-2 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 text-sm font-semibold flex items-center transition-colors">
                                <i class="fa-solid fa-download mr-2 text-base"></i>
                                Download Proof
                            </a>
                            
                            <a href="{{ route('payment-proofs.slip', $paymentProof->id) }}" class="px-4 py-2 rounded-xl bg-slate-50 hover:bg-amber-50 text-slate-700 border border-slate-200 hover:border-amber-300 hover:text-amber-700 text-sm font-semibold flex items-center transition-colors" target="_blank">
                                <i class="fa-solid fa-file-invoice mr-2 text-base"></i>
                                View Slip
                            </a>
                            
                            <a href="{{ route('payment-proofs.edit', $paymentProof->id) }}" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm flex items-center shadow-md shadow-indigo-200 transition-colors">
                                <i class="fa-solid fa-user-shield mr-2 text-base"></i>
                                Review & Edit
                            </a>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
@endsection
