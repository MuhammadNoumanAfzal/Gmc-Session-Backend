<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SessionAudienceSection;
use Illuminate\Http\JsonResponse;

class SessionAudienceSectionController extends Controller
{
    public function show(): JsonResponse
    {
        $section = SessionAudienceSection::query()->firstOrCreate(
            ['page_key' => SessionAudienceSection::HOME_PAGE_KEY],
            SessionAudienceSection::defaultAttributes(),
        );

        $cards = collect($section->audience_cards ?: SessionAudienceSection::defaultAudienceCards())
            ->map(fn (array $card) => [
                'iconKey' => $card['icon_key'] ?? 'graduation-cap',
                'title' => $card['title'] ?? '',
                'description' => $card['description'] ?? '',
            ])
            ->values()
            ->all();

        return response()->json([
            'success' => true,
            'data' => [
                'badgeText' => $section->badge_text,
                'headingLine1' => $section->heading_line1,
                'headingLine2' => $section->heading_line2,
                'description' => $section->description,
                'audienceCards' => $cards,
            ],
        ]);
    }
}
