@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl space-y-6">
        @php
            $bodyParagraphs = old('body_paragraphs', $section->body_paragraphs ?? []);
            $highlights = old('highlights', $section->highlights ?? []);
            $galleryCards = old('gallery_cards', $section->gallery_cards ?? []);
        @endphp

        <section class="rounded-[26px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-7">
            <div class="flex flex-col gap-6 xl:flex-row xl:items-start xl:justify-between">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-fuchsia-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-fuchsia-700 dark:bg-fuchsia-950/30 dark:text-fuchsia-300">
                        <i class="fa-solid fa-user-graduate text-[10px]"></i>
                        Website Content
                    </div>
                    <h2 class="mt-3 font-sora text-2xl font-black tracking-tight text-slate-800 dark:text-white">Mentor guidance section</h2>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Manage the dark mentor section with the scrolling gallery, mentor introduction, highlight cards, and CTA content.
                    </p>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 xl:w-[430px]">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Highlights</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ count($highlights) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Gallery Cards</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ count($galleryCards) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:col-span-2 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">API Endpoint</div>
                        <div class="mt-2 break-all text-sm font-semibold text-slate-800 dark:text-white">{{ url('/api/content/mentor-trust') }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap gap-2">
                <a href="{{ route('website-content.hero.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Hero Section</a>
                <a href="{{ route('website-content.scholarship-solution.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Section Below Hero</a>
                <a href="{{ route('website-content.strategy-ribbon.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Strategy Ribbon</a>
                <a href="{{ route('website-content.mentor-trust.edit') }}" class="rounded-full border border-slate-200 bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white dark:border-slate-700 dark:bg-white dark:text-slate-900">Mentor Section</a>
            </div>
        </section>

        <form action="{{ route('website-content.mentor-trust.update') }}" method="POST" class="space-y-6" id="mentor-trust-form">
            @csrf

            <div class="grid gap-6 lg:grid-cols-2">
                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-fuchsia-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-fuchsia-700 dark:bg-fuchsia-950/30 dark:text-fuchsia-300">
                            <i class="fa-solid fa-pen-ruler text-[10px]"></i>
                            Intro Content
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Mentor copy</h2>
                        <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">Update the badge, heading, intro paragraph, detailed paragraphs, and CTA content.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Badge Text</label>
                            <input type="text" name="badge_text" value="{{ old('badge_text', $section->badge_text) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Heading Prefix</label>
                                <input type="text" name="heading_prefix" value="{{ old('heading_prefix', $section->heading_prefix) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            </div>
                            <div>
                                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Heading Accent</label>
                                <input type="text" name="heading_accent" value="{{ old('heading_accent', $section->heading_accent) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Intro Paragraph</label>
                            <textarea name="intro_paragraph" rows="5" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ old('intro_paragraph', $section->intro_paragraph) }}</textarea>
                        </div>

                        @foreach ($bodyParagraphs as $index => $paragraph)
                            <div>
                                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Body Paragraph {{ $index + 1 }}</label>
                                <textarea name="body_paragraphs[]" rows="4" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ $paragraph }}</textarea>
                            </div>
                        @endforeach

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">CTA Label</label>
                                <input type="text" name="cta_label" value="{{ old('cta_label', $section->cta_label) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            </div>
                            <div>
                                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">CTA URL</label>
                                <input type="text" name="cta_url" value="{{ old('cta_url', $section->cta_url) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">CTA Note</label>
                            <input type="text" name="cta_note" value="{{ old('cta_note', $section->cta_note) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        </div>
                    </div>
                </section>

                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-violet-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-violet-700 dark:bg-violet-950/30 dark:text-violet-300">
                            <i class="fa-solid fa-list-check text-[10px]"></i>
                            Highlights
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Highlight cards</h2>
                        <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">These three cards appear below the mentor body copy.</p>
                    </div>

                    <div class="space-y-4">
                        @foreach ($highlights as $index => $highlight)
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                                <div class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Highlight {{ $index + 1 }}</div>
                                <div class="space-y-3">
                                    <input type="text" name="highlights[{{ $index }}][label]" value="{{ $highlight['label'] ?? '' }}" placeholder="Label" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                                    <textarea name="highlights[{{ $index }}][text]" rows="3" placeholder="Short supporting text" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ $highlight['text'] ?? '' }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="mb-6">
                    <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-300">
                        <i class="fa-solid fa-images text-[10px]"></i>
                        Gallery Cards
                    </div>
                    <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Scrolling gallery</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">Update the 6 gallery cards used in the two-column scrolling image wall.</p>
                </div>

                <div class="grid gap-5 xl:grid-cols-2">
                    @foreach ($galleryCards as $index => $card)
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 dark:border-slate-800 dark:bg-slate-950/50">
                            <div class="mb-4 flex items-center justify-between gap-3">
                                <div class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Gallery Card {{ $index + 1 }}</div>
                                <span class="rounded-full bg-white px-3 py-1 text-[11px] font-semibold text-slate-500 ring-1 ring-slate-200 dark:bg-slate-900 dark:text-slate-300 dark:ring-slate-700">Media item</span>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Image URL</label>
                                    <input type="text" name="gallery_cards[{{ $index }}][image]" value="{{ $card['image'] ?? '' }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                                </div>

                                <div>
                                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Title</label>
                                    <input type="text" name="gallery_cards[{{ $index }}][title]" value="{{ $card['title'] ?? '' }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                                </div>

                                <div>
                                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Supporting Copy</label>
                                    <textarea name="gallery_cards[{{ $index }}][copy]" rows="3" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ $card['copy'] ?? '' }}</textarea>
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
                <button type="submit" id="save-mentor-trust-button" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gmcBlue px-6 py-3 text-sm font-bold text-white transition hover:bg-gmcBlueDark focus:outline-none focus:ring-4 focus:ring-gmcBlue/15">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    Save Mentor Section
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('mentor-trust-form');
            const submitButton = document.getElementById('save-mentor-trust-button');

            if (!form || !submitButton) {
                return;
            }

            form.addEventListener('submit', function () {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-xs"></i> Saving...';

                Swal.fire({
                    title: 'Saving mentor section...',
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
