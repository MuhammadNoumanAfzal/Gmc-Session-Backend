@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl space-y-6">
        @php
            $faqItems = old('faq_items', $section->faq_items ?? []);
        @endphp

        <section class="rounded-[26px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-7">
            <div class="flex flex-col gap-6 xl:flex-row xl:items-start xl:justify-between">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-violet-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-violet-700 dark:bg-violet-950/30 dark:text-violet-300">
                        <i class="fa-solid fa-circle-question text-[10px]"></i>
                        Website Content
                    </div>
                    <h2 class="mt-3 font-sora text-2xl font-black tracking-tight text-slate-800 dark:text-white">FAQ section</h2>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Manage the frequently asked questions section including the heading area and all accordion answers.
                    </p>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 xl:w-[430px]">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">FAQ Items</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ count($faqItems) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Badge Text</div>
                        <div class="mt-2 text-sm font-bold text-slate-800 dark:text-white">{{ old('badge_text', $section->badge_text) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:col-span-2 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">API Endpoint</div>
                        <div class="mt-2 break-all text-sm font-semibold text-slate-800 dark:text-white">{{ url('/api/content/faq') }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap gap-2">
                <a href="{{ route('website-content.hero.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Hero Section</a>
                <a href="{{ route('website-content.scholarship-solution.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Section Below Hero</a>
                <a href="{{ route('website-content.strategy-ribbon.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Strategy Ribbon</a>
                <a href="{{ route('website-content.mentor-trust.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Mentor Section</a>
                <a href="{{ route('website-content.guarantee.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Guarantee Section</a>
                <a href="{{ route('website-content.media-proof.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Media Proof Section</a>
                <a href="{{ route('website-content.session-audience.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Session Audience Section</a>
                <a href="{{ route('website-content.faq.edit') }}" class="rounded-full border border-slate-200 bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white dark:border-slate-700 dark:bg-white dark:text-slate-900">FAQ Section</a>
            </div>
        </section>

        <form action="{{ route('website-content.faq.update') }}" method="POST" class="space-y-6" id="faq-form">
            @csrf

            <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="mb-6">
                    <div class="inline-flex items-center gap-2 rounded-full bg-violet-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-violet-700 dark:bg-violet-950/30 dark:text-violet-300">
                        <i class="fa-solid fa-heading text-[10px]"></i>
                        Intro Copy
                    </div>
                    <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Badge, heading, and paragraph</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">Update the FAQ section heading area shown above the accordion.</p>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Badge Text</label>
                        <input type="text" name="badge_text" value="{{ old('badge_text', $section->badge_text) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Heading Line 1</label>
                        <input type="text" name="heading_line1" value="{{ old('heading_line1', $section->heading_line1) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                    </div>
                </div>

                <div class="mt-4 grid gap-4">
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Heading Line 2</label>
                        <input type="text" name="heading_line2" value="{{ old('heading_line2', $section->heading_line2) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Description</label>
                        <textarea name="description" rows="4" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ old('description', $section->description) }}</textarea>
                    </div>
                </div>
            </section>

            <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="mb-6">
                    <div class="inline-flex items-center gap-2 rounded-full bg-fuchsia-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-fuchsia-700 dark:bg-fuchsia-950/30 dark:text-fuchsia-300">
                        <i class="fa-solid fa-list text-[10px]"></i>
                        FAQ Items
                    </div>
                    <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Questions and answers</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">These six items power the accordion on the frontend.</p>
                </div>

                <div class="grid gap-5 xl:grid-cols-2">
                    @foreach ($faqItems as $index => $item)
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                            <div class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-slate-500">FAQ Item {{ $index + 1 }}</div>
                            <div class="space-y-3">
                                <input type="text" name="faq_items[{{ $index }}][question]" value="{{ $item['question'] ?? '' }}" placeholder="Question" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                                <textarea name="faq_items[{{ $index }}][answer]" rows="4" placeholder="Answer" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ $item['answer'] ?? '' }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <div class="sticky bottom-6 z-10 flex flex-col gap-4 rounded-[20px] border border-slate-200 bg-white/95 px-5 py-4 shadow-[0_16px_40px_rgba(15,23,42,0.08)] backdrop-blur dark:border-slate-800 dark:bg-slate-900/95 md:flex-row md:items-center md:justify-between">
                <div class="min-w-0">
                    <div class="text-sm font-bold text-slate-800 dark:text-white">Ready to save updates</div>
                    <div class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">
                        Saving here updates the backend content used by the React frontend API.
                    </div>
                </div>
                <button type="submit" id="save-faq-button" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gmcBlue px-6 py-3 text-sm font-bold text-white transition hover:bg-gmcBlueDark focus:outline-none focus:ring-4 focus:ring-gmcBlue/15">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    Save FAQ Section
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('faq-form');
            const submitButton = document.getElementById('save-faq-button');

            if (!form || !submitButton) {
                return;
            }

            form.addEventListener('submit', function () {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-xs"></i> Saving...';

                Swal.fire({
                    title: 'Saving FAQ section...',
                    text: 'Please wait while we update the frontend content source.',
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
