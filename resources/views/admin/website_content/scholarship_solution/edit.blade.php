@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl space-y-6">
        @php
            $featurePills = old('feature_pills', $section->feature_pills ?? []);
            $workflowCards = old('workflow_cards', $section->workflow_cards ?? []);
        @endphp

        <section class="rounded-[26px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-7">
            <div class="flex flex-col gap-6 xl:flex-row xl:items-start xl:justify-between">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-300">
                        <i class="fa-solid fa-layer-group text-[10px]"></i>
                        Website Content
                    </div>
                    <h2 class="mt-3 font-sora text-2xl font-black tracking-tight text-slate-800 dark:text-white">Scholarship solution section</h2>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Manage the section directly below the homepage hero, including the intro text, benefit pills, workflow cards, and CTA.
                    </p>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 xl:w-[430px]">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Feature Pills</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ count($featurePills) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Workflow Cards</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ count($workflowCards) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:col-span-2 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">API Endpoint</div>
                        <div class="mt-2 break-all text-sm font-semibold text-slate-800 dark:text-white">{{ url('/api/content/scholarship-solution') }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap gap-2">
                <a href="{{ route('website-content.hero.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Hero Section</a>
                <a href="{{ route('website-content.scholarship-solution.edit') }}" class="rounded-full border border-slate-200 bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white dark:border-slate-700 dark:bg-white dark:text-slate-900">Section Below Hero</a>
            </div>
        </section>

        <form action="{{ route('website-content.scholarship-solution.update') }}" method="POST" class="space-y-6" id="scholarship-solution-form">
            @csrf

            <div class="grid gap-6 lg:grid-cols-2">
                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-gmcBlue dark:bg-blue-950/30 dark:text-blue-300">
                            <i class="fa-solid fa-pen-ruler text-[10px]"></i>
                            Intro Content
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Heading and highlights</h2>
                        <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">Update the badge, main heading, and feature pills shown above the slider.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Badge Text</label>
                            <input type="text" name="badge_text" value="{{ old('badge_text', $section->badge_text) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        </div>

                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Main Heading</label>
                            <textarea name="heading" rows="3" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ old('heading', $section->heading) }}</textarea>
                        </div>

                        <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50/80 px-4 py-3 text-xs leading-6 text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">
                            <strong class="font-bold text-slate-800 dark:text-white">Production note:</strong>
                            Keep the heading concise enough to fit neatly across desktop and mobile layouts.
                        </div>

                        @foreach ($featurePills as $index => $pill)
                            <div>
                                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Feature Pill {{ $index + 1 }}</label>
                                <input type="text" name="feature_pills[]" value="{{ $pill }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-300">
                            <i class="fa-solid fa-link text-[10px]"></i>
                            CTA
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Call to action</h2>
                        <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">Update the button label and destination at the bottom of the section.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">CTA Label</label>
                            <input type="text" name="cta_label" value="{{ old('cta_label', $section->cta_label) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        </div>

                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">CTA URL</label>
                            <input type="text" name="cta_url" value="{{ old('cta_url', $section->cta_url) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        </div>
                    </div>
                </section>
            </div>

            <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="mb-6">
                    <div class="inline-flex items-center gap-2 rounded-full bg-purple-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-purple-700 dark:bg-purple-950/30 dark:text-purple-300">
                        <i class="fa-solid fa-cards-blank text-[10px]"></i>
                        Workflow Cards
                    </div>
                    <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Slider cards</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">Each card powers the continuously moving slider below the intro content. Keep titles compact and descriptions readable.</p>
                </div>

                <div class="grid gap-5 xl:grid-cols-2">
                    @foreach ($workflowCards as $index => $card)
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 dark:border-slate-800 dark:bg-slate-950/50">
                            <div class="mb-4 flex items-center justify-between gap-3">
                                <div class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Card {{ $index + 1 }}</div>
                                <span class="rounded-full bg-white px-3 py-1 text-[11px] font-semibold text-slate-500 ring-1 ring-slate-200 dark:bg-slate-900 dark:text-slate-300 dark:ring-slate-700">Slider item</span>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Icon</label>
                                    <select name="workflow_cards[{{ $index }}][icon_key]" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                                        @foreach ($availableIcons as $iconKey => $iconLabel)
                                            <option value="{{ $iconKey }}" @selected(($card['icon_key'] ?? '') === $iconKey)>{{ $iconLabel }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Title</label>
                                    <input type="text" name="workflow_cards[{{ $index }}][title]" value="{{ $card['title'] ?? '' }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                                </div>

                                <div>
                                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Front Description</label>
                                    <textarea name="workflow_cards[{{ $index }}][description]" rows="3" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ $card['description'] ?? '' }}</textarea>
                                </div>

                                <div>
                                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Back Details</label>
                                    <textarea name="workflow_cards[{{ $index }}][details]" rows="4" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ $card['details'] ?? '' }}</textarea>
                                </div>
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
                <button type="submit" id="save-scholarship-solution-button" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gmcBlue px-6 py-3 text-sm font-bold text-white transition hover:bg-gmcBlueDark focus:outline-none focus:ring-4 focus:ring-gmcBlue/15">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    Save Section Content
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('scholarship-solution-form');
            const submitButton = document.getElementById('save-scholarship-solution-button');

            if (!form || !submitButton) {
                return;
            }

            form.addEventListener('submit', function () {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-xs"></i> Saving...';

                Swal.fire({
                    title: 'Saving section content...',
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
