<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SessionAudienceSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SessionAudienceSectionController extends Controller
{
    public function edit(): View
    {
        $section = SessionAudienceSection::query()->firstOrCreate(
            ['page_key' => SessionAudienceSection::HOME_PAGE_KEY],
            SessionAudienceSection::defaultAttributes(),
        );

        return view('admin.website_content.session_audience.edit', [
            'section' => $section,
            'active' => 'website_content',
            'heading' => 'Website Content',
            'title' => 'Manage the session audience section for the React frontend.',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'badge_text' => ['required', 'string', 'max:160'],
            'heading_line1' => ['required', 'string', 'max:120'],
            'heading_line2' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:700'],
            'audience_cards' => ['required', 'array', 'size:4'],
            'audience_cards.*.icon_key' => ['required', 'string', 'in:graduation-cap,search-check,file-text,compass'],
            'audience_cards.*.title' => ['required', 'string', 'max:160'],
            'audience_cards.*.description' => ['required', 'string', 'max:260'],
        ]);

        SessionAudienceSection::query()->updateOrCreate(
            ['page_key' => SessionAudienceSection::HOME_PAGE_KEY],
            $validated + ['is_active' => true],
        );

        return redirect()
            ->route('website-content.session-audience.edit')
            ->with('success', 'Session audience section updated successfully.');
    }
}
