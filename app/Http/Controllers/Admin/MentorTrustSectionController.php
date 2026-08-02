<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MentorTrustSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MentorTrustSectionController extends Controller
{
    public function edit(): View
    {
        $section = MentorTrustSection::query()->firstOrCreate(
            ['page_key' => MentorTrustSection::HOME_PAGE_KEY],
            MentorTrustSection::defaultAttributes(),
        );

        return view('admin.website_content.mentor_trust.edit', [
            'section' => $section,
            'active' => 'website_content',
            'heading' => 'Website Content',
            'title' => 'Manage the mentor guidance section for the React frontend.',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'badge_text' => ['required', 'string', 'max:120'],
            'heading_prefix' => ['required', 'string', 'max:80'],
            'heading_accent' => ['required', 'string', 'max:120'],
            'intro_paragraph' => ['required', 'string', 'max:700'],
            'body_paragraphs' => ['required', 'array', 'min:1', 'max:4'],
            'body_paragraphs.*' => ['required', 'string', 'max:700'],
            'highlights' => ['required', 'array', 'size:3'],
            'highlights.*.label' => ['required', 'string', 'max:60'],
            'highlights.*.text' => ['required', 'string', 'max:160'],
            'cta_label' => ['required', 'string', 'max:120'],
            'cta_url' => ['required', 'string', 'max:255'],
            'cta_note' => ['required', 'string', 'max:255'],
            'gallery_cards' => ['required', 'array', 'size:6'],
            'gallery_cards.*.image' => ['required', 'string', 'max:2048'],
            'gallery_cards.*.title' => ['required', 'string', 'max:120'],
            'gallery_cards.*.copy' => ['required', 'string', 'max:220'],
        ]);

        MentorTrustSection::query()->updateOrCreate(
            ['page_key' => MentorTrustSection::HOME_PAGE_KEY],
            $validated + ['is_active' => true],
        );

        return redirect()
            ->route('website-content.mentor-trust.edit')
            ->with('success', 'Mentor trust section updated successfully.');
    }
}
