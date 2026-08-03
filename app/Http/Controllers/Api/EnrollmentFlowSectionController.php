<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EnrollmentFlowSection;
use Illuminate\Http\JsonResponse;

class EnrollmentFlowSectionController extends Controller
{
    public function show(): JsonResponse
    {
        $section = EnrollmentFlowSection::query()->firstOrCreate(
            ['page_key' => EnrollmentFlowSection::HOME_PAGE_KEY],
            EnrollmentFlowSection::defaultAttributes(),
        );

        return response()->json([
            'success' => true,
            'data' => [
                'headerBadgeText' => $section->header_badge_text,
                'headerHeadingLine1' => $section->header_heading_line1,
                'headerHeadingHighlight' => $section->header_heading_highlight,
                'backButtonText' => $section->back_button_text,
                'stepItems' => $section->step_items ?: EnrollmentFlowSection::defaultStepItems(),
                'summaryBadgeText' => $section->summary_badge_text,
                'summaryHeading' => $section->summary_heading,
                'summarySubtitle' => $section->summary_subtitle,
                'priceLabel' => $section->price_label,
                'discountedPrice' => $section->discounted_price,
                'discountedAmountValue' => $section->discounted_amount_value,
                'originalPrice' => $section->original_price,
                'urgencyText' => $section->urgency_text,
                'progressPercentage' => $section->progress_percentage,
                'includesHeading' => $section->includes_heading,
                'includesItems' => $section->includes_items ?: EnrollmentFlowSection::defaultIncludesItems(),
                'summaryButtonText' => $section->summary_button_text,
                'transferTitle' => $section->transfer_title,
                'bankDetails' => $section->bank_details ?: EnrollmentFlowSection::defaultBankDetails(),
                'supportNotesHeading' => $section->support_notes_heading,
                'supportNotes' => $section->support_notes ?: EnrollmentFlowSection::defaultSupportNotes(),
                'transferBackButtonText' => $section->transfer_back_button_text,
                'transferButtonText' => $section->transfer_button_text,
                'proofBadgeText' => $section->proof_badge_text,
                'proofHeading' => $section->proof_heading,
                'proofWarningText' => $section->proof_warning_text,
                'proofSupportText' => $section->proof_support_text,
                'proofBackButtonText' => $section->proof_back_button_text,
                'proofSubmitButtonText' => $section->proof_submit_button_text,
                'metaProgramId' => $section->meta_program_id,
                'metaSessionType' => $section->meta_session_type,
                'metaPaymentMethod' => $section->meta_payment_method,
            ],
        ]);
    }
}
