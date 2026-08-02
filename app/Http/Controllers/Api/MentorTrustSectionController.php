<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MentorTrustSection;
use Illuminate\Http\JsonResponse;

class MentorTrustSectionController extends Controller
{
    public function show(): JsonResponse
    {
        $section = MentorTrustSection::query()->firstOrCreate(
            ['page_key' => MentorTrustSection::HOME_PAGE_KEY],
            MentorTrustSection::defaultAttributes(),
        );

        return response()->json([
            'success' => true,
            'data' => [
                'badgeText' => $section->badge_text,
                'headingPrefix' => $section->heading_prefix,
                'headingAccent' => $section->heading_accent,
                'introParagraph' => $section->intro_paragraph,
                'bodyParagraphs' => $section->body_paragraphs ?: MentorTrustSection::defaultBodyParagraphs(),
                'highlights' => $section->highlights ?: MentorTrustSection::defaultHighlights(),
                'ctaLabel' => $section->cta_label,
                'ctaUrl' => $section->cta_url,
                'ctaNote' => $section->cta_note,
                'galleryCards' => $section->gallery_cards ?: MentorTrustSection::defaultGalleryCards(),
            ],
        ]);
    }
}
