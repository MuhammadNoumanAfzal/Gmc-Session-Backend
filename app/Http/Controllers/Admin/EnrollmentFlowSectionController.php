<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EnrollmentFlowSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnrollmentFlowSectionController extends Controller
{
    public function edit(): View
    {
        $section = EnrollmentFlowSection::query()->firstOrCreate(
            ['page_key' => EnrollmentFlowSection::HOME_PAGE_KEY],
            EnrollmentFlowSection::defaultAttributes(),
        );

        return view('admin.website_content.enrollment_flow.edit', [
            'section' => $section,
            'active' => 'website_content',
            'heading' => 'Website Content',
            'title' => 'Manage the enrollment flow section for the React frontend.',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'header_badge_text' => ['required', 'string', 'max:160'],
            'header_heading_line1' => ['required', 'string', 'max:160'],
            'header_heading_highlight' => ['required', 'string', 'max:160'],
            'back_button_text' => ['required', 'string', 'max:80'],
            'step_items' => ['required', 'array', 'size:3'],
            'step_items.*.step' => ['required', 'integer', 'min:1', 'max:3'],
            'step_items.*.label' => ['required', 'string', 'max:80'],
            'summary_badge_text' => ['required', 'string', 'max:120'],
            'summary_heading' => ['required', 'string', 'max:120'],
            'summary_subtitle' => ['required', 'string', 'max:320'],
            'price_label' => ['required', 'string', 'max:120'],
            'discounted_price' => ['required', 'string', 'max:40'],
            'discounted_amount_value' => ['required', 'string', 'max:20'],
            'original_price' => ['required', 'string', 'max:40'],
            'urgency_text' => ['required', 'string', 'max:60'],
            'progress_percentage' => ['required', 'integer', 'min:0', 'max:100'],
            'includes_heading' => ['required', 'string', 'max:120'],
            'includes_items' => ['required', 'array', 'size:4'],
            'includes_items.*' => ['required', 'string', 'max:180'],
            'summary_button_text' => ['required', 'string', 'max:80'],
            'transfer_title' => ['required', 'string', 'max:120'],
            'bank_details' => ['required', 'array', 'size:4'],
            'bank_details.*.label' => ['required', 'string', 'max:80'],
            'bank_details.*.value' => ['required', 'string', 'max:190'],
            'support_notes_heading' => ['required', 'string', 'max:120'],
            'support_notes' => ['required', 'array', 'size:3'],
            'support_notes.*' => ['required', 'string', 'max:240'],
            'transfer_back_button_text' => ['required', 'string', 'max:50'],
            'transfer_button_text' => ['required', 'string', 'max:80'],
            'proof_badge_text' => ['required', 'string', 'max:120'],
            'proof_heading' => ['required', 'string', 'max:160'],
            'proof_warning_text' => ['required', 'string', 'max:240'],
            'proof_support_text' => ['required', 'string', 'max:80'],
            'proof_back_button_text' => ['required', 'string', 'max:50'],
            'proof_submit_button_text' => ['required', 'string', 'max:80'],
            'meta_program_id' => ['required', 'string', 'max:120'],
            'meta_session_type' => ['required', 'string', 'max:120'],
            'meta_payment_method' => ['required', 'string', 'max:80'],
        ]);

        EnrollmentFlowSection::query()->updateOrCreate(
            ['page_key' => EnrollmentFlowSection::HOME_PAGE_KEY],
            $validated + ['is_active' => true],
        );

        return redirect()
            ->route('website-content.enrollment-flow.edit')
            ->with('success', 'Enrollment flow section updated successfully.');
    }
}
