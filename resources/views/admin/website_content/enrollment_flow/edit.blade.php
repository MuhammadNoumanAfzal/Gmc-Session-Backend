@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl space-y-6">
        @php
            $stepItems = old('step_items', $section->step_items ?? []);
            $includesItems = old('includes_items', $section->includes_items ?? []);
            $bankDetails = old('bank_details', $section->bank_details ?? []);
            $supportNotes = old('support_notes', $section->support_notes ?? []);
        @endphp

        <section class="rounded-[26px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-7">
            <div class="flex flex-col gap-6 xl:flex-row xl:items-start xl:justify-between">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-300">
                        <i class="fa-solid fa-credit-card text-[10px]"></i>
                        Website Content
                    </div>
                    <h2 class="mt-3 font-sora text-2xl font-black tracking-tight text-slate-800 dark:text-white">Enrollment flow section</h2>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Manage the booking page header, 3-step tracker, payment summary, bank transfer panel, and proof upload copy from one place.
                    </p>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 xl:w-[430px]">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Step Labels</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ count($stepItems) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Bank Fields</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ count($bankDetails) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:col-span-2 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">API Endpoint</div>
                        <div class="mt-2 break-all text-sm font-semibold text-slate-800 dark:text-white">{{ url('/api/content/enrollment-flow') }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap gap-2">
                <a href="{{ route('website-content.hero.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Hero Section</a>
                <a href="{{ route('website-content.scholarship-solution.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Section Below Hero</a>
                <a href="{{ route('website-content.strategy-ribbon.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Strategy Ribbon</a>
                <a href="{{ route('website-content.mentor-trust.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Mentor Section</a>
                <a href="{{ route('website-content.guarantee.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Guarantee Section</a>
                <a href="{{ route('website-content.enrollment-flow.edit') }}" class="rounded-full border border-slate-200 bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white dark:border-slate-700 dark:bg-white dark:text-slate-900">Enrollment Flow</a>
                <a href="{{ route('website-content.faq.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">FAQ Section</a>
                <a href="{{ route('website-content.media-proof.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Media Proof Section</a>
                <a href="{{ route('website-content.session-audience.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Session Audience Section</a>
            </div>
        </section>

        <form action="{{ route('website-content.enrollment-flow.update') }}" method="POST" class="space-y-6" id="enrollment-flow-form">
            @csrf

            <div class="grid gap-6 xl:grid-cols-2">
                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-300">
                            <i class="fa-solid fa-heading text-[10px]"></i>
                            Header
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Top booking header</h2>
                    </div>

                    <div class="space-y-4">
                        <input type="text" name="header_badge_text" value="{{ old('header_badge_text', $section->header_badge_text) }}" placeholder="Header badge text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        <input type="text" name="header_heading_line1" value="{{ old('header_heading_line1', $section->header_heading_line1) }}" placeholder="Heading line 1" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        <input type="text" name="header_heading_highlight" value="{{ old('header_heading_highlight', $section->header_heading_highlight) }}" placeholder="Highlighted heading text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        <input type="text" name="back_button_text" value="{{ old('back_button_text', $section->back_button_text) }}" placeholder="Back button text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                    </div>
                </section>

                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-violet-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-violet-700 dark:bg-violet-950/30 dark:text-violet-300">
                            <i class="fa-solid fa-list-ol text-[10px]"></i>
                            Step Tracker
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Three step labels</h2>
                    </div>

                    <div class="space-y-4">
                        @foreach ($stepItems as $index => $item)
                            <div class="grid gap-3 sm:grid-cols-[100px_1fr]">
                                <input type="number" name="step_items[{{ $index }}][step]" value="{{ $item['step'] ?? $index + 1 }}" min="1" max="3" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                                <input type="text" name="step_items[{{ $index }}][label]" value="{{ $item['label'] ?? '' }}" placeholder="Step label" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <div class="grid gap-6 xl:grid-cols-2">
                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-cyan-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-cyan-700 dark:bg-cyan-950/30 dark:text-cyan-300">
                            <i class="fa-solid fa-wallet text-[10px]"></i>
                            Review Slot
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Summary card content</h2>
                    </div>

                    <div class="space-y-4">
                        <input type="text" name="summary_badge_text" value="{{ old('summary_badge_text', $section->summary_badge_text) }}" placeholder="Summary badge" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        <input type="text" name="summary_heading" value="{{ old('summary_heading', $section->summary_heading) }}" placeholder="Summary heading" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        <textarea name="summary_subtitle" rows="3" placeholder="Summary subtitle" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ old('summary_subtitle', $section->summary_subtitle) }}</textarea>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <input type="text" name="price_label" value="{{ old('price_label', $section->price_label) }}" placeholder="Price label" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            <input type="text" name="summary_button_text" value="{{ old('summary_button_text', $section->summary_button_text) }}" placeholder="Summary button text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <input type="text" name="discounted_price" value="{{ old('discounted_price', $section->discounted_price) }}" placeholder="Discounted price" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            <input type="text" name="original_price" value="{{ old('original_price', $section->original_price) }}" placeholder="Original price" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <input type="text" name="discounted_amount_value" value="{{ old('discounted_amount_value', $section->discounted_amount_value) }}" placeholder="Numeric amount value" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            <input type="text" name="urgency_text" value="{{ old('urgency_text', $section->urgency_text) }}" placeholder="Urgency text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        </div>
                        <input type="number" name="progress_percentage" value="{{ old('progress_percentage', $section->progress_percentage) }}" min="0" max="100" placeholder="Progress percentage" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        <input type="text" name="includes_heading" value="{{ old('includes_heading', $section->includes_heading) }}" placeholder="Includes heading" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        @foreach ($includesItems as $index => $item)
                            <input type="text" name="includes_items[]" value="{{ $item }}" placeholder="Included item {{ $index + 1 }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-amber-700 dark:bg-amber-950/30 dark:text-amber-300">
                            <i class="fa-solid fa-building-columns text-[10px]"></i>
                            Bank Transfer
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Transfer step content</h2>
                    </div>

                    <div class="space-y-4">
                        <input type="text" name="transfer_title" value="{{ old('transfer_title', $section->transfer_title) }}" placeholder="Transfer card title" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        <input type="text" name="support_notes_heading" value="{{ old('support_notes_heading', $section->support_notes_heading) }}" placeholder="Support notes heading" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <input type="text" name="transfer_back_button_text" value="{{ old('transfer_back_button_text', $section->transfer_back_button_text) }}" placeholder="Back button text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            <input type="text" name="transfer_button_text" value="{{ old('transfer_button_text', $section->transfer_button_text) }}" placeholder="Continue button text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        </div>

                        @foreach ($bankDetails as $index => $detail)
                            <div class="grid gap-3 sm:grid-cols-2">
                                <input type="text" name="bank_details[{{ $index }}][label]" value="{{ $detail['label'] ?? '' }}" placeholder="Bank detail label" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                                <input type="text" name="bank_details[{{ $index }}][value]" value="{{ $detail['value'] ?? '' }}" placeholder="Bank detail value" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            </div>
                        @endforeach

                        @foreach ($supportNotes as $index => $note)
                            <textarea name="support_notes[]" rows="2" placeholder="Support note {{ $index + 1 }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ $note }}</textarea>
                        @endforeach
                    </div>
                </section>
            </div>

            <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="mb-6">
                    <div class="inline-flex items-center gap-2 rounded-full bg-fuchsia-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-fuchsia-700 dark:bg-fuchsia-950/30 dark:text-fuchsia-300">
                        <i class="fa-solid fa-upload text-[10px]"></i>
                        Verify Proof
                    </div>
                    <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Proof upload and submission meta</h2>
                </div>

                <div class="grid gap-4 lg:grid-cols-2">
                    <input type="text" name="proof_badge_text" value="{{ old('proof_badge_text', $section->proof_badge_text) }}" placeholder="Proof badge text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                    <input type="text" name="proof_heading" value="{{ old('proof_heading', $section->proof_heading) }}" placeholder="Proof heading" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                    <textarea name="proof_warning_text" rows="3" placeholder="Proof warning text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white lg:col-span-2" required>{{ old('proof_warning_text', $section->proof_warning_text) }}</textarea>
                    <input type="text" name="proof_support_text" value="{{ old('proof_support_text', $section->proof_support_text) }}" placeholder="Support link text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                    <input type="text" name="proof_back_button_text" value="{{ old('proof_back_button_text', $section->proof_back_button_text) }}" placeholder="Proof back button text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                    <input type="text" name="proof_submit_button_text" value="{{ old('proof_submit_button_text', $section->proof_submit_button_text) }}" placeholder="Proof submit button text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                    <input type="text" name="meta_program_id" value="{{ old('meta_program_id', $section->meta_program_id) }}" placeholder="Program ID" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                    <input type="text" name="meta_session_type" value="{{ old('meta_session_type', $section->meta_session_type) }}" placeholder="Session type" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                    <input type="text" name="meta_payment_method" value="{{ old('meta_payment_method', $section->meta_payment_method) }}" placeholder="Payment method" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white lg:col-span-2" required>
                </div>
            </section>

            <div class="sticky bottom-6 z-10 flex flex-col gap-4 rounded-[20px] border border-slate-200 bg-white/95 px-5 py-4 shadow-[0_16px_40px_rgba(15,23,42,0.08)] backdrop-blur dark:border-slate-800 dark:bg-slate-900/95 md:flex-row md:items-center md:justify-between">
                <div class="min-w-0">
                    <div class="text-sm font-bold text-slate-800 dark:text-white">Ready to save updates</div>
                    <div class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">
                        Saving here updates the API content for the complete 3-step booking flow.
                    </div>
                </div>
                <button type="submit" id="save-enrollment-flow-button" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gmcBlue px-6 py-3 text-sm font-bold text-white transition hover:bg-gmcBlueDark focus:outline-none focus:ring-4 focus:ring-gmcBlue/15">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    Save Enrollment Flow
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('enrollment-flow-form');
            const submitButton = document.getElementById('save-enrollment-flow-button');

            if (!form || !submitButton) {
                return;
            }

            form.addEventListener('submit', function () {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-xs"></i> Saving...';

                Swal.fire({
                    title: 'Saving enrollment flow...',
                    text: 'Please wait while we update the booking page content source.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            });
        });
    </script>
@endsection
