<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MediaProofSection;
use Illuminate\Http\JsonResponse;

class MediaProofSectionController extends Controller
{
    public function show(): JsonResponse
    {
        $section = MediaProofSection::query()->firstOrCreate(
            ['page_key' => MediaProofSection::HOME_PAGE_KEY],
            MediaProofSection::defaultAttributes(),
        );

        return response()->json([
            'success' => true,
            'data' => [
                'badgeText' => $section->badge_text,
                'heading' => $section->heading,
                'description' => $section->description,
                'videoItems' => $section->video_items ?: MediaProofSection::defaultVideoItems(),
                'reviewItems' => $section->review_items ?: MediaProofSection::defaultReviewItems(),
            ],
        ]);
    }
}
