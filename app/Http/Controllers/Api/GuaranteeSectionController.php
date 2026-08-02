<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GuaranteeSection;
use Illuminate\Http\JsonResponse;

class GuaranteeSectionController extends Controller
{
    public function show(): JsonResponse
    {
        $section = GuaranteeSection::query()->firstOrCreate(
            ['page_key' => GuaranteeSection::HOME_PAGE_KEY],
            GuaranteeSection::defaultAttributes(),
        );

        return response()->json([
            'success' => true,
            'data' => [
                'topBadgeText' => $section->top_badge_text,
                'sectionBadgeText' => $section->section_badge_text,
                'headingLine1' => $section->heading_line1,
                'headingLine2' => $section->heading_line2,
                'description' => $section->description,
                'guaranteePoints' => $section->guarantee_points ?: GuaranteeSection::defaultGuaranteePoints(),
                'principleLabel' => $section->principle_label,
                'principleTitle' => $section->principle_title,
                'principleDescription' => $section->principle_description,
                'sealBadgeText' => $section->seal_badge_text,
                'sealValueText' => $section->seal_value_text,
                'sealFooterText' => $section->seal_footer_text,
            ],
        ]);
    }
}
