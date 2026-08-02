@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl space-y-6">
        @php
            $guaranteePoints = old('guarantee_points', $section->guarantee_points ?? []);
        @endphp

        <section class="rounded-[26px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-7">
            <div class="flex flex-col gap-6 xl:flex-row xl:items-start xl:justify-between">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-indigo-700 dark:bg-indigo-950/30 dark:text-indigo-300">
                        <i class="fa-solid fa-shield-heart text-[10px]"></i>
                        Website Content
                    </div>
                    <h2 class="mt-3 font-sora text-2xl font-black tracking-tight text-slate-800 dark:text-white">Guarantee section</h2>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Manage the accountability and guarantee section including the top badge, headings, checklist items, principle card, and seal text.
                    </p>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 xl:w-[430px]">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Checklist Points</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ count($guaranteePoints) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Seal Value</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ old('seal_value_text', $section->seal_value_text) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:col-span-2 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">API Endpoint</div>
                        <div class="mt-2 break-all text-sm font-semibold text-slate-800 dark:text-white">{{ url('/api/content/guarantee') }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap gap-2">
                <a href="{{ route('website-content.hero.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Hero Section</a>
                <a href="{{ route('website-content.scholarship-solution.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Section Below Hero</a>
                <a href="{{ route('website-content.strategy-ribbon.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Strategy Ribbon</a>
                <a href="{{ route('website-content.mentor-trust.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Mentor Section</a>
                <a href="{{ route('website-content.guarantee.edit') }}" class="rounded-full border border-slate-200 bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white dark:border-slate-700 dark:bg-white dark:text-slate-900">Guarantee Section</a>
            </div>
        </section>

        <form action="{{ route('website-content.guarantee.update') }}" method="POST" class="space-y-6" id="guarantee-form">
            @csrf

            <div class="grid gap-6 lg:grid-cols-2">
                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-indigo-700 dark:bg-indigo-950/30 dark:text-indigo-300">
                            <i class="fa-solid fa-align-left text-[10px]"></i>
                            Section Copy
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Badges and headings</h2>
                        <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">Update the visible copy for the top badge, section badge, headings, and main paragraph.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Top Badge Text</label>
                            <input type="text" name="top_badge_text" value="{{ old('top_badge_text', $section->top_badge_text) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        </div>
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Section Badge Text</label>
                            <input type="text" name="section_badge_text" value="{{ old('section_badge_text', $section->section_badge_text) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Heading Line 1</label>
                                <input type="text" name="heading_line1" value="{{ old('heading_line1', $section->heading_line1) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            </div>
                            <div>
                                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Heading Line 2</label>
                                <input type="text" name="heading_line2" value="{{ old('heading_line2', $section->heading_line2) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            </div>
                        </div>
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Description</label>
                            <textarea name="description" rows="5" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ old('description', $section->description) }}</textarea>
                        </div>
                    </div>
                </section>

                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-fuchsia-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-fuchsia-700 dark:bg-fuchsia-950/30 dark:text-fuchsia-300">
                            <i class="fa-solid fa-award text-[10px]"></i>
                            Seal Content
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Seal and principle card</h2>
                        <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">Control the text used in the floating seal and the principle card below the checklist.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Principle Label</label>
                            <input type="text" name="principle_label" value="{{ old('principle_label', $section->principle_label) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        </div>
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Principle Title</label>
                            <input type="text" name="principle_title" value="{{ old('principle_title', $section->principle_title) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        </div>
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Principle Description</label>
                            <textarea name="principle_description" rows="3" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ old('principle_description', $section->principle_description) }}</textarea>
                        </div>
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Seal Badge Text</label>
                            <input type="text" name="seal_badge_text" value="{{ old('seal_badge_text', $section->seal_badge_text) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Seal Value Text</label>
                                <input type="text" name="seal_value_text" value="{{ old('seal_value_text', $section->seal_value_text) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            </div>
                            <div>
                                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Seal Footer Text</label>
                                <input type="text" name="seal_footer_text" value="{{ old('seal_footer_text', $section->seal_footer_text) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="mb-6">
                    <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-300">
                        <i class="fa-solid fa-list-check text-[10px]"></i>
                        Checklist
                    </div>
                    <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Guarantee points</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">These checklist rows appear on the left side of the section.</p>
                </div>

                <div class="space-y-4">
                    @foreach ($guaranteePoints as $index => $point)
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Checklist Point {{ $index + 1 }}</label>
                            <input type="text" name="guarantee_points[]" value="{{ $point }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
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
                <button type="submit" id="save-guarantee-button" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gmcBlue px-6 py-3 text-sm font-bold text-white transition hover:bg-gmcBlueDark focus:outline-none focus:ring-4 focus:ring-gmcBlue/15">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    Save Guarantee Section
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('guarantee-form');
            const submitButton = document.getElementById('save-guarantee-button');

            if (!form || !submitButton) {
                return;
            }

            form.addEventListener('submit', function () {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-xs"></i> Saving...';

                Swal.fire({
                    title: 'Saving guarantee section...',
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
