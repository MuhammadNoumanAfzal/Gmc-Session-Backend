@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl space-y-6">
        @php
            $videoItems = old('video_items', $section->video_items ?? []);
            $reviewItems = old('review_items', $section->review_items ?? []);
        @endphp

        <section class="rounded-[26px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-7">
            <div class="flex flex-col gap-6 xl:flex-row xl:items-start xl:justify-between">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-cyan-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-cyan-700 dark:bg-cyan-950/30 dark:text-cyan-300">
                        <i class="fa-solid fa-comments text-[10px]"></i>
                        Website Content
                    </div>
                    <h2 class="mt-3 font-sora text-2xl font-black tracking-tight text-slate-800 dark:text-white">Media proof section</h2>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Manage the proof section with the top video-style cards and bottom review/screenshot cards.
                    </p>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 xl:w-[430px]">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Video Cards</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ count($videoItems) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Review Cards</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ count($reviewItems) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:col-span-2 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">API Endpoint</div>
                        <div class="mt-2 break-all text-sm font-semibold text-slate-800 dark:text-white">{{ url('/api/content/media-proof') }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap gap-2">
                <a href="{{ route('website-content.hero.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Hero Section</a>
                <a href="{{ route('website-content.scholarship-solution.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Section Below Hero</a>
                <a href="{{ route('website-content.strategy-ribbon.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Strategy Ribbon</a>
                <a href="{{ route('website-content.mentor-trust.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Mentor Section</a>
                <a href="{{ route('website-content.guarantee.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Guarantee Section</a>
                <a href="{{ route('website-content.media-proof.edit') }}" class="rounded-full border border-slate-200 bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white dark:border-slate-700 dark:bg-white dark:text-slate-900">Media Proof Section</a>
            </div>
        </section>

        <form action="{{ route('website-content.media-proof.update') }}" method="POST" class="space-y-6" id="media-proof-form">
            @csrf

            <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="mb-6">
                    <div class="inline-flex items-center gap-2 rounded-full bg-cyan-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-cyan-700 dark:bg-cyan-950/30 dark:text-cyan-300">
                        <i class="fa-solid fa-heading text-[10px]"></i>
                        Intro Content
                    </div>
                    <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Heading area</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">Update the badge, main heading, and support description shown above the two tracks.</p>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Badge Text</label>
                        <input type="text" name="badge_text" value="{{ old('badge_text', $section->badge_text) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Heading</label>
                        <input type="text" name="heading" value="{{ old('heading', $section->heading) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Description</label>
                    <textarea name="description" rows="3" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ old('description', $section->description) }}</textarea>
                </div>
            </section>

            <div class="grid gap-6 xl:grid-cols-2">
                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-violet-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-violet-700 dark:bg-violet-950/30 dark:text-violet-300">
                            <i class="fa-solid fa-circle-play text-[10px]"></i>
                            Top Track
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Video proof cards</h2>
                        <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">These cards appear in the top moving row.</p>
                    </div>

                    <div class="space-y-5">
                        @foreach ($videoItems as $index => $item)
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                                <div class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Video Card {{ $index + 1 }}</div>
                                <div class="space-y-3">
                                    <input type="text" name="video_items[{{ $index }}][title]" value="{{ $item['title'] ?? '' }}" placeholder="Title" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                                    <input type="text" name="video_items[{{ $index }}][subtitle]" value="{{ $item['subtitle'] ?? '' }}" placeholder="Subtitle" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                                    <input type="text" name="video_items[{{ $index }}][image]" value="{{ $item['image'] ?? '' }}" placeholder="Image URL" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-fuchsia-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-fuchsia-700 dark:bg-fuchsia-950/30 dark:text-fuchsia-300">
                            <i class="fa-solid fa-quote-left text-[10px]"></i>
                            Bottom Track
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Review proof cards</h2>
                        <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">These cards appear in the bottom moving row.</p>
                    </div>

                    <div class="space-y-5">
                        @foreach ($reviewItems as $index => $item)
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                                <div class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Review Card {{ $index + 1 }}</div>
                                <div class="space-y-3">
                                    <input type="text" name="review_items[{{ $index }}][title]" value="{{ $item['title'] ?? '' }}" placeholder="Title" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                                    <input type="text" name="review_items[{{ $index }}][subtitle]" value="{{ $item['subtitle'] ?? '' }}" placeholder="Subtitle" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                                    <input type="text" name="review_items[{{ $index }}][image]" value="{{ $item['image'] ?? '' }}" placeholder="Image URL" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                                </div>
                            </div>
                        @endforeach
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
                <button type="submit" id="save-media-proof-button" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gmcBlue px-6 py-3 text-sm font-bold text-white transition hover:bg-gmcBlueDark focus:outline-none focus:ring-4 focus:ring-gmcBlue/15">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    Save Media Proof Section
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('media-proof-form');
            const submitButton = document.getElementById('save-media-proof-button');

            if (!form || !submitButton) {
                return;
            }

            form.addEventListener('submit', function () {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-xs"></i> Saving...';

                Swal.fire({
                    title: 'Saving media proof section...',
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
