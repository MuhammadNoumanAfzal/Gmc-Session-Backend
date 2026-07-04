@extends('layouts.admin')

@section('content')
    <div class="row animate-fade-in">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            
            <!-- Tailwind Redesigned Form Card (Light & Dark Theme Toggle) -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-sm transition-colors duration-200">
                
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center bg-white dark:bg-slate-900 transition-colors">
                    <i class="fa-solid fa-user-shield text-gmcBlue dark:text-blue-400 mr-3 text-lg"></i>
                    <h5 class="m-0 text-base font-bold font-sora text-slate-800 dark:text-white">
                        Review Payment Submission
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

                    <form action="{{ route('payment-proofs.update') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="id" value="{{ $paymentProof->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Personal Info Section -->
                            <div class="bg-slate-50/50 dark:bg-slate-850/40 border border-slate-200 dark:border-slate-800 rounded-xl p-5 space-y-4 transition-colors">
                                <h4 class="text-sm font-bold font-sora text-slate-850 dark:text-white border-b border-slate-200/60 dark:border-slate-800 pb-3 flex items-center">
                                    <i class="fa-solid fa-user text-gmcBlue dark:text-blue-400 mr-2"></i>
                                    Personal Information
                                </h4>
                                
                                <div class="space-y-1">
                                    <label for="full_name" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Full Name</label>
                                    <input id="full_name" name="full_name" type="text" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                                           value="{{ old('full_name', $paymentProof->full_name) }}" required>
                                </div>

                                <div class="space-y-1">
                                    <label for="whatsapp_number" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">WhatsApp Number</label>
                                    <input id="whatsapp_number" name="whatsapp_number" type="text" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                                           value="{{ old('whatsapp_number', $paymentProof->whatsapp_number) }}" required>
                                </div>

                                <div class="space-y-1">
                                    <label for="email" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Email Address</label>
                                    <input id="email" name="email" type="email" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                                           value="{{ old('email', $paymentProof->email) }}" required>
                                </div>

                                <div class="space-y-1">
                                    <label for="program_id" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Program Course</label>
                                    <select id="program_id" name="program_id" 
                                            class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" required>
                                        <option value="prog_fullstack_web" @selected(old('program_id', $paymentProof->program_id) === 'prog_fullstack_web')>Full-Stack Web Development</option>
                                        <option value="prog_data_analytics" @selected(old('program_id', $paymentProof->program_id) === 'prog_data_analytics')>Data Analytics Masterclass</option>
                                        <option value="prog_uiux_design" @selected(old('program_id', $paymentProof->program_id) === 'prog_uiux_design')>UI/UX Product Design</option>
                                        <option value="prog_mobile_app" @selected(old('program_id', $paymentProof->program_id) === 'prog_mobile_app')>Mobile App Development (React Native)</option>
                                    </select>
                                </div>

                                <div class="space-y-1">
                                    <label for="session_type" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Session allocation</label>
                                    <input id="session_type" name="session_type" type="text" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                                           value="{{ old('session_type', $paymentProof->session_type) }}" required>
                                </div>
                            </div>

                            <!-- Payment details Section -->
                            <div class="bg-slate-50/50 dark:bg-slate-850/40 border border-slate-200 dark:border-slate-800 rounded-xl p-5 space-y-4 transition-colors">
                                <h4 class="text-sm font-bold font-sora text-slate-850 dark:text-white border-b border-slate-200/60 dark:border-slate-800 pb-3 flex items-center">
                                    <i class="fa-solid fa-wallet text-gmcGold mr-2"></i>
                                    Payment details
                                </h4>

                                <div class="space-y-1">
                                    <label for="payment_method" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Payment Method</label>
                                    <input id="payment_method" name="payment_method" type="text" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                                           value="{{ old('payment_method', $paymentProof->payment_method) }}" required>
                                </div>

                                <div class="space-y-1">
                                    <label for="transaction_reference" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Transaction Reference</label>
                                    <input id="transaction_reference" name="transaction_reference" type="text" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                                           value="{{ old('transaction_reference', $paymentProof->transaction_reference) }}" required>
                                </div>

                                <div class="space-y-1">
                                    <label for="sender_account_last4" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Sender Account Last 4</label>
                                    <input id="sender_account_last4" name="sender_account_last4" type="text" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                                           value="{{ old('sender_account_last4', $paymentProof->sender_account_last4) }}">
                                </div>

                                <div class="space-y-1">
                                    <label for="amount_paid" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Amount Paid ($)</label>
                                    <input id="amount_paid" name="amount_paid" type="text" 
                                           class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition" 
                                           value="{{ old('amount_paid', $paymentProof->amount_paid) }}" required>
                                </div>

                                <div class="space-y-1">
                                    <label for="duplicate_submission" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Security State</label>
                                    <select id="duplicate_submission" name="duplicate_submission" 
                                            class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition">
                                        <option value="0" @selected((string) old('duplicate_submission', $paymentProof->duplicate_submission ? '1' : '0') === '0')>No (Unique Submission)</option>
                                        <option value="1" @selected((string) old('duplicate_submission', $paymentProof->duplicate_submission ? '1' : '0') === '1')>Yes (Mark Duplicate Reference)</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>

                        <!-- Verification and Notes Section -->
                        <div class="bg-slate-50/50 dark:bg-slate-850/40 border border-slate-200 dark:border-slate-800 rounded-xl p-5 space-y-4 transition-colors">
                            <h4 class="text-sm font-bold font-sora text-slate-850 dark:text-white border-b border-slate-200/60 dark:border-slate-800 pb-3 flex items-center">
                                <i class="fa-solid fa-stamp text-gmcGreen mr-2"></i>
                                Audit Approval Review
                            </h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-1">
                                    <label for="status" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Verification Status</label>
                                    <select id="status" name="status" 
                                            class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}" @selected(old('status', $paymentProof->status) === $status)>
                                                {{ ucwords(str_replace('_', ' ', $status)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="space-y-1">
                                    <label for="notes" class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Internal Notes / Reject Reasons</label>
                                    <textarea id="notes" name="notes" rows="3" 
                                              class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:border-gmcBlue dark:focus:border-blue-500 text-slate-805 dark:text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-4 focus:ring-gmcBlue/10 dark:focus:ring-blue-500/10 transition placeholder-slate-300 dark:placeholder-slate-700"
                                              placeholder="E.g., invalid transaction hash, incorrect amount paid, fake screenshot details.">{{ old('notes', $paymentProof->notes) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 flex justify-between items-center border-t border-slate-100 dark:border-slate-800">
                            <a href="{{ route('payment-proofs.show', $paymentProof->id) }}" class="inline-flex items-center text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 transition-colors">
                                <i class="fa-solid fa-arrow-left mr-2"></i>
                                Cancel Review
                            </a>
                            <button type="submit" 
                                    class="px-8 py-3 rounded-xl bg-gmcBlue hover:bg-gmcBlueDark text-white font-bold text-sm shadow-md shadow-blue-150 dark:shadow-none transition-colors">
                                <i class="fa-solid fa-save mr-2"></i>
                                Save Review Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
@endsection
