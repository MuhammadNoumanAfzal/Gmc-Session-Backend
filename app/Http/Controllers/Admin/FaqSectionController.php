<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqSectionController extends Controller
{
    public function edit(): View
    {
        $section = FaqSection::query()->firstOrCreate(
            ['page_key' => FaqSection::HOME_PAGE_KEY],
            FaqSection::defaultAttributes(),
        );

        return view('admin.website_content.faq.edit', [
            'section' => $section,
            'active' => 'website_content',
            'heading' => 'Website Content',
            'title' => 'Manage the FAQ section for the React frontend.',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'badge_text' => ['required', 'string', 'max:160'],
            'heading_line1' => ['required', 'string', 'max:120'],
            'heading_line2' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:700'],
            'faq_items' => ['required', 'array', 'size:6'],
            'faq_items.*.question' => ['required', 'string', 'max:220'],
            'faq_items.*.answer' => ['required', 'string', 'max:700'],
        ]);

        FaqSection::query()->updateOrCreate(
            ['page_key' => FaqSection::HOME_PAGE_KEY],
            $validated + ['is_active' => true],
        );

        return redirect()
            ->route('website-content.faq.edit')
            ->with('success', 'FAQ section updated successfully.');
    }
}
