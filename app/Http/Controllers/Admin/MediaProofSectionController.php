<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaProofSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaProofSectionController extends Controller
{
    public function edit(): View
    {
        $section = MediaProofSection::query()->firstOrCreate(
            ['page_key' => MediaProofSection::HOME_PAGE_KEY],
            MediaProofSection::defaultAttributes(),
        );

        return view('admin.website_content.media_proof.edit', [
            'section' => $section,
            'active' => 'website_content',
            'heading' => 'Website Content',
            'title' => 'Manage the proof and feedback section for the React frontend.',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'badge_text' => ['required', 'string', 'max:120'],
            'heading' => ['required', 'string', 'max:160'],
            'description' => ['required', 'string', 'max:400'],
            'video_items' => ['required', 'array', 'size:4'],
            'video_items.*.title' => ['required', 'string', 'max:120'],
            'video_items.*.subtitle' => ['required', 'string', 'max:180'],
            'video_items.*.image' => ['required', 'string', 'max:2048'],
            'review_items' => ['required', 'array', 'size:4'],
            'review_items.*.title' => ['required', 'string', 'max:120'],
            'review_items.*.subtitle' => ['required', 'string', 'max:180'],
            'review_items.*.image' => ['required', 'string', 'max:2048'],
        ]);

        MediaProofSection::query()->updateOrCreate(
            ['page_key' => MediaProofSection::HOME_PAGE_KEY],
            $validated + ['is_active' => true],
        );

        return redirect()
            ->route('website-content.media-proof.edit')
            ->with('success', 'Media proof section updated successfully.');
    }
}
