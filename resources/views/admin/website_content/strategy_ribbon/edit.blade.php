@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl space-y-6">
        @php
            $frontRibbonItems = old('front_ribbon_items', $section->front_ribbon_items ?? []);
            $backRibbonItems = old('back_ribbon_items', $section->back_ribbon_items ?? []);
        @endphp

        <section class="rounded-[26px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-7">
            <div class="flex flex-col gap-6 xl:flex-row xl:items-start xl:justify-between">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-violet-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-violet-700 dark:bg-violet-950/30 dark:text-violet-300">
                        <i class="fa-solid fa-wave-square text-[10px]"></i>
                        Website Content
                    </div>
                    <h2 class="mt-3 font-sora text-2xl font-black tracking-tight text-slate-800 dark:text-white">Strategy ribbon section</h2>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                        Manage the animated ribbon texts shown below the scholarship solution section. Update both the front and back ribbon rows.
                    </p>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 xl:w-[430px]">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Front Items</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ count($frontRibbonItems) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">Back Items</div>
                        <div class="mt-2 text-2xl font-black text-slate-800 dark:text-white">{{ count($backRibbonItems) }}</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:col-span-2 dark:border-slate-800 dark:bg-slate-950/50">
                        <div class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">API Endpoint</div>
                        <div class="mt-2 break-all text-sm font-semibold text-slate-800 dark:text-white">{{ url('/api/content/strategy-ribbon') }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap gap-2">
                <a href="{{ route('website-content.hero.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Hero Section</a>
                <a href="{{ route('website-content.scholarship-solution.edit') }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:bg-slate-950/50 dark:text-slate-300">Section Below Hero</a>
                <a href="{{ route('website-content.strategy-ribbon.edit') }}" class="rounded-full border border-slate-200 bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white dark:border-slate-700 dark:bg-white dark:text-slate-900">Strategy Ribbon</a>
            </div>
        </section>

        <form action="{{ route('website-content.strategy-ribbon.update') }}" method="POST" class="space-y-6" id="strategy-ribbon-form">
            @csrf

            <div class="grid gap-6 lg:grid-cols-2">
                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-purple-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-purple-700 dark:bg-purple-950/30 dark:text-purple-300">
                            <i class="fa-solid fa-forward text-[10px]"></i>
                            Front Ribbon
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Primary moving row</h2>
                        <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">This is the brighter front ribbon that sits on top visually.</p>
                    </div>

                    <div class="space-y-4">
                        @foreach ($frontRibbonItems as $index => $item)
                            <div>
                                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Front Item {{ $index + 1 }}</label>
                                <input type="text" name="front_ribbon_items[]" value="{{ $item }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em] text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                            <i class="fa-solid fa-backward text-[10px]"></i>
                            Back Ribbon
                        </div>
                        <h2 class="mt-3 font-sora text-xl font-black text-slate-800 dark:text-white">Secondary moving row</h2>
                        <p class="mt-1 text-sm leading-6 text-slate-500 dark:text-slate-400">This is the darker background ribbon that moves in the opposite direction.</p>
                    </div>

                    <div class="space-y-4">
                        @foreach ($backRibbonItems as $index => $item)
                            <div>
                                <label class="mb-2 block text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Back Item {{ $index + 1 }}</label>
                                <input type="text" name="back_ribbon_items[]" value="{{ $item }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-gmcBlue focus:ring-4 focus:ring-gmcBlue/10 dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
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
                <button type="submit" id="save-strategy-ribbon-button" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gmcBlue px-6 py-3 text-sm font-bold text-white transition hover:bg-gmcBlueDark focus:outline-none focus:ring-4 focus:ring-gmcBlue/15">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    Save Ribbon Content
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('strategy-ribbon-form');
            const submitButton = document.getElementById('save-strategy-ribbon-button');

            if (!form || !submitButton) {
                return;
            }

            form.addEventListener('submit', function () {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-xs"></i> Saving...';

                Swal.fire({
                    title: 'Saving ribbon content...',
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
