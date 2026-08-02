<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FaqSection;
use Illuminate\Http\JsonResponse;

class FaqSectionController extends Controller
{
    public function show(): JsonResponse
    {
        $section = FaqSection::query()->firstOrCreate(
            ['page_key' => FaqSection::HOME_PAGE_KEY],
            FaqSection::defaultAttributes(),
        );

        return response()->json([
            'success' => true,
            'data' => [
                'badgeText' => $section->badge_text,
                'headingLine1' => $section->heading_line1,
                'headingLine2' => $section->heading_line2,
                'description' => $section->description,
                'faqItems' => $section->faq_items ?: FaqSection::defaultFaqItems(),
            ],
        ]);
    }
}
