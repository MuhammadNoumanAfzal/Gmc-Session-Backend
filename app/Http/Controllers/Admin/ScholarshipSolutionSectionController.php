<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScholarshipSolutionSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ScholarshipSolutionSectionController extends Controller
{
    public function edit(): View
    {
        $section = ScholarshipSolutionSection::query()->firstOrCreate(
            ['page_key' => ScholarshipSolutionSection::HOME_PAGE_KEY],
            ScholarshipSolutionSection::defaultAttributes(),
        );

        return view('admin.website_content.scholarship_solution.edit', [
            'section' => $section,
            'availableIcons' => $this->availableIcons(),
            'active' => 'website_content',
            'heading' => 'Website Content',
            'title' => 'Manage the scholarship solution section for the React frontend.',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $iconKeys = array_keys($this->availableIcons());

        $validated = $request->validate([
            'badge_text' => ['required', 'string', 'max:255'],
            'heading' => ['required', 'string', 'max:255'],
            'feature_pills' => ['required', 'array', 'min:1', 'max:6'],
            'feature_pills.*' => ['required', 'string', 'max:80'],
            'workflow_cards' => ['required', 'array', 'size:8'],
            'workflow_cards.*.icon_key' => ['required', Rule::in($iconKeys)],
            'workflow_cards.*.title' => ['required', 'string', 'max:120'],
            'workflow_cards.*.description' => ['required', 'string', 'max:220'],
            'workflow_cards.*.details' => ['required', 'string', 'max:420'],
            'cta_label' => ['required', 'string', 'max:120'],
            'cta_url' => ['required', 'string', 'max:255'],
        ]);

        ScholarshipSolutionSection::query()->updateOrCreate(
            ['page_key' => ScholarshipSolutionSection::HOME_PAGE_KEY],
            $validated + ['is_active' => true],
        );

        return redirect()
            ->route('website-content.scholarship-solution.edit')
            ->with('success', 'Scholarship solution section updated successfully.');
    }

    private function availableIcons(): array
    {
        return [
            'GraduationCap' => 'Graduation Cap',
            'MessageSquareText' => 'Message Square',
            'FileCheck2' => 'File Check',
            'Target' => 'Target',
            'BrainCircuit' => 'Brain Circuit',
            'CalendarClock' => 'Calendar Clock',
            'BookOpenCheck' => 'Book Open Check',
            'Handshake' => 'Handshake',
        ];
    }
}
