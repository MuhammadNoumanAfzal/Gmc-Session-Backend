<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeroSectionController extends Controller
{
    public function edit(): View
    {
        $heroSection = HeroSection::query()->firstOrCreate(
            ['page_key' => HeroSection::HOME_PAGE_KEY],
            HeroSection::defaultAttributes(),
        );

        return view('admin.website_content.hero.edit', [
            'heroSection' => $heroSection,
            'active' => 'website_content',
            'heading' => 'Website Content',
            'title' => 'Manage homepage hero content for the React frontend.',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'announcement_text' => ['required', 'string', 'max:255'],
            'badge_text' => ['required', 'string', 'max:255'],
            'title_messages' => ['required', 'array', 'min:1', 'max:6'],
            'title_messages.*.line1' => ['required', 'string', 'max:255'],
            'title_messages.*.line2' => ['required', 'string', 'max:255'],
            'hero_image_url' => ['required', 'string', 'max:2048'],
            'hero_image_alt' => ['required', 'string', 'max:255'],
            'cta_eyebrow' => ['required', 'string', 'max:80'],
            'cta_label' => ['required', 'string', 'max:120'],
            'cta_url' => ['required', 'string', 'max:255'],
            'trust_title' => ['required', 'string', 'max:255'],
            'trust_description' => ['required', 'string', 'max:500'],
            'trust_avatar_count' => ['required', 'integer', 'min:1', 'max:6'],
        ]);

        HeroSection::query()->updateOrCreate(
            ['page_key' => HeroSection::HOME_PAGE_KEY],
            $validated + ['is_active' => true],
        );

        return redirect()
            ->route('website-content.hero.edit')
            ->with('success', 'Hero section content updated successfully.');
    }
}
