<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuaranteeSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GuaranteeSectionController extends Controller
{
    public function edit(): View
    {
        $section = GuaranteeSection::query()->firstOrCreate(
            ['page_key' => GuaranteeSection::HOME_PAGE_KEY],
            GuaranteeSection::defaultAttributes(),
        );

        return view('admin.website_content.guarantee.edit', [
            'section' => $section,
            'active' => 'website_content',
            'heading' => 'Website Content',
            'title' => 'Manage the guarantee section for the React frontend.',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'top_badge_text' => ['required', 'string', 'max:160'],
            'section_badge_text' => ['required', 'string', 'max:120'],
            'heading_line1' => ['required', 'string', 'max:120'],
            'heading_line2' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:700'],
            'guarantee_points' => ['required', 'array', 'min:1', 'max:5'],
            'guarantee_points.*' => ['required', 'string', 'max:220'],
            'principle_label' => ['required', 'string', 'max:80'],
            'principle_title' => ['required', 'string', 'max:140'],
            'principle_description' => ['required', 'string', 'max:220'],
            'seal_badge_text' => ['required', 'string', 'max:120'],
            'seal_value_text' => ['required', 'string', 'max:40'],
            'seal_footer_text' => ['required', 'string', 'max:160'],
        ]);

        GuaranteeSection::query()->updateOrCreate(
            ['page_key' => GuaranteeSection::HOME_PAGE_KEY],
            $validated + ['is_active' => true],
        );

        return redirect()
            ->route('website-content.guarantee.edit')
            ->with('success', 'Guarantee section updated successfully.');
    }
}
