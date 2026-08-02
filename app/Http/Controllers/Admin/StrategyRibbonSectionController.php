<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrategyRibbonSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StrategyRibbonSectionController extends Controller
{
    public function edit(): View
    {
        $section = StrategyRibbonSection::query()->firstOrCreate(
            ['page_key' => StrategyRibbonSection::HOME_PAGE_KEY],
            StrategyRibbonSection::defaultAttributes(),
        );

        return view('admin.website_content.strategy_ribbon.edit', [
            'section' => $section,
            'active' => 'website_content',
            'heading' => 'Website Content',
            'title' => 'Manage the animated strategy ribbon section for the React frontend.',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'front_ribbon_items' => ['required', 'array', 'min:2', 'max:8'],
            'front_ribbon_items.*' => ['required', 'string', 'max:120'],
            'back_ribbon_items' => ['required', 'array', 'min:2', 'max:8'],
            'back_ribbon_items.*' => ['required', 'string', 'max:120'],
        ]);

        StrategyRibbonSection::query()->updateOrCreate(
            ['page_key' => StrategyRibbonSection::HOME_PAGE_KEY],
            $validated + ['is_active' => true],
        );

        return redirect()
            ->route('website-content.strategy-ribbon.edit')
            ->with('success', 'Strategy ribbon section updated successfully.');
    }
}
