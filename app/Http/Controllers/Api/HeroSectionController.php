<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\JsonResponse;

class HeroSectionController extends Controller
{
    public function show(): JsonResponse
    {
        $heroSection = HeroSection::query()->firstOrCreate(
            ['page_key' => HeroSection::HOME_PAGE_KEY],
            HeroSection::defaultAttributes(),
        );

        return response()->json([
            'success' => true,
            'data' => [
                'announcementText' => $heroSection->announcement_text,
                'badgeText' => $heroSection->badge_text,
                'titleMessages' => $heroSection->title_messages ?: HeroSection::defaultTitleMessages(),
                'heroImageUrl' => $heroSection->hero_image_url,
                'heroImageAlt' => $heroSection->hero_image_alt,
                'ctaEyebrow' => $heroSection->cta_eyebrow,
                'ctaLabel' => $heroSection->cta_label,
                'ctaUrl' => $heroSection->cta_url,
                'trustTitle' => $heroSection->trust_title,
                'trustDescription' => $heroSection->trust_description,
                'trustAvatarCount' => $heroSection->trust_avatar_count,
            ],
        ]);
    }
}
