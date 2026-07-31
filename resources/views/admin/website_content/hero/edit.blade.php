@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl space-y-6">
        @php
            $titleMessages = old('title_messages', $heroSection->title_messages ?? []);
        @endphp

        <section class="rounded-[26px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-7">
            <div class="flex flex-col gap-6 xl:flex-row xl:items-start xl:justify-between">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-gmcBlue dark:bg-blue-950/30 dark:text-blue-300">
                        <i class="fa-solid fa-window-maximize text-[10px]"></i>
                        Website Content
                    </div>
                    <h2 class="mt-3 font-sora text-2xl font-black tracking-tight text-slate-800 dark:text-white">Homepage hero content</h2>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Update the hero section content used by the React frontend. Keep the copy short and clear so the page stays balanced on desktop and mobile.
                    </p>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 xl:w-[430px]">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Headline Slides</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ count($titleMessages) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Trust Avatars</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ old('trust_avatar_count', $heroSection->trust_avatar_count) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:col-span-2 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">API Endpoint</div>
                        <div class="mt-2 break-all text-sm font-semibold text-slate-800 dark:text-white">{{ url('/api/content/hero') }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap gap-2">
                <span class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Announcement bar</span>
                <span class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Headline slides</span>
                <span class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">CTA content</span>
                <span class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Trust section</span>
            </div>
        </section>

        <form action="{{ route('website-content.hero.update') }}" method="POST" class="space-y-6" id="hero-content-form">
            @csrf

            <div class="grid gap-6 lg:grid-cols-2">
                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6 flex items-start justify-between gap-4">
                        <div>
                            <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-gmcBlue dark:bg-blue-950/30 dark:text-blue-300">
                                <i class="fa-solid fa-heading text-[10px]"></i>
                                Messaging
                            </div>
                            <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Content copy</h2>
                            <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">Control the announcement, badge, and rotating headline copy visitors see first.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Announcement Text</label>
                            <input
                                type="text"
                                name="announcement_text"
                                value="{{ old('announcement_text', $heroSection->announcement_text) }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                required
                            >
                            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Short urgency message shown in the top strip above the hero.</p>
                        </div>

                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Badge Text</label>
                            <input
                                type="text"
                                name="badge_text"
                                value="{{ old('badge_text', $heroSection->badge_text) }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                required
                            >
                            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Small highlight label displayed above the main headline card.</p>
                        </div>
                        
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50/80 px-4 py-3 text-xs leading-6 text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">
                            <strong class="font-bold text-slate-800 dark:text-white">Headline rotation tip:</strong>
                            Each slide has two lines. Keep them concise so the frontend animation stays clean on desktop and mobile.
                        </div>

                        @foreach ($titleMessages as $index => $message)
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                                <div class="mb-3 flex items-center justify-between gap-3">
                                    <div class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Headline Slide {{ $index + 1 }}</div>
                                    <span class="rounded-full bg-white px-3 py-1 text-[11px] font-semibold text-slate-500 ring-1 ring-slate-200 dark:bg-slate-900 dark:text-slate-300 dark:ring-slate-700">Animated text</span>
                                </div>
                                <div class="space-y-3">
                                    <input
                                        type="text"
                                        name="title_messages[{{ $index }}][line1]"
                                        value="{{ $message['line1'] ?? '' }}"
                                        placeholder="First line"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
                                        required
                                    >
                                    <input
                                        type="text"
                                        name="title_messages[{{ $index }}][line2]"
                                        value="{{ $message['line2'] ?? '' }}"
                                        placeholder="Second line"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
                                        required
                                    >
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400">Line 1 appears in white. Line 2 appears in the purple gradient accent.</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-300">
                            <i class="fa-solid fa-image text-[10px]"></i>
                            Visual + CTA
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Visual and CTA</h2>
                        <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">Manage the hero image, button copy, CTA link, and the trust section under the main artwork.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Hero Image URL</label>
                            <input
                                type="text"
                                name="hero_image_url"
                                value="{{ old('hero_image_url', $heroSection->hero_image_url) }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                required
                            >
                            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Use `/hero.png` for frontend public images or a full `https://...` URL.</p>
                        </div>

                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Hero Image Alt Text</label>
                            <input
                                type="text"
                                name="hero_image_alt"
                                value="{{ old('hero_image_alt', $heroSection->hero_image_alt) }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                required
                            >
                            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Describe the image for accessibility and SEO.</p>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">CTA Eyebrow</label>
                                <input
                                    type="text"
                                    name="cta_eyebrow"
                                    value="{{ old('cta_eyebrow', $heroSection->cta_eyebrow) }}"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                    required
                                >
                                <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Small label above the main CTA text.</p>
                            </div>
                            <div>
                                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">CTA Label</label>
                                <input
                                    type="text"
                                    name="cta_label"
                                    value="{{ old('cta_label', $heroSection->cta_label) }}"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                    required
                                >
                                <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Main text inside the large CTA button.</p>
                            </div>
                        </div>

                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">CTA URL</label>
                            <input
                                type="text"
                                name="cta_url"
                                value="{{ old('cta_url', $heroSection->cta_url) }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                required
                            >
                            <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Example: `/program`, `/turkey-visa`, or any internal route you create later.</p>
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 dark:border-slate-800 dark:bg-slate-950/50">
                            <div class="mb-4 flex items-center gap-3">
                                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white text-gmcBlue shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-700">
                                    <i class="fa-solid fa-users-viewfinder"></i>
                                </div>
                                <div>
                                    <h3 class="font-sora text-base font-black text-slate-800 dark:text-white">Trust block</h3>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">This content appears just below the CTA button.</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Trust Title</label>
                                    <input
                                        type="text"
                                        name="trust_title"
                                        value="{{ old('trust_title', $heroSection->trust_title) }}"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                        required
                                    >
                                </div>

                                <div>
                                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Trust Description</label>
                                    <textarea
                                        name="trust_description"
                                        rows="4"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                        required
                                    >{{ old('trust_description', $heroSection->trust_description) }}</textarea>
                                </div>

                                <div>
                                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Trust Avatar Count</label>
                                    <input
                                        type="number"
                                        min="1"
                                        max="6"
                                        name="trust_avatar_count"
                                        value="{{ old('trust_avatar_count', $heroSection->trust_avatar_count) }}"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="sticky bottom-6 z-10 flex flex-col gap-4 rounded-[20px] border border-slate-200 bg-white/95 px-5 py-4 shadow-[0_16px_40px_rgba(15,23,42,0.08)] backdrop-blur dark:border-slate-800 dark:bg-slate-900/95 md:flex-row md:items-center md:justify-between">
                <div class="min-w-0">
                    <div class="text-sm font-bold text-slate-800 dark:text-white">Ready to save updates</div>
                    <div class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">
                        Saving here updates the backend content used by the React frontend API.
                    </div>
                </div>
                <button type="submit" id="save-hero-content-button" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gmcBlue px-6 py-3 text-sm font-bold text-white transition hover:bg-gmcBlueDark focus:outline-none focus:ring-4 focus:ring-gmcBlue/15">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    Save Hero Content
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('hero-content-form');
            const submitButton = document.getElementById('save-hero-content-button');

            if (!form || !submitButton) {
                return;
            }

            form.addEventListener('submit', function () {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-xs"></i> Saving...';

                Swal.fire({
                    title: 'Saving hero content...',
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
