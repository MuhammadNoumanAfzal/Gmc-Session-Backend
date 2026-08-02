<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ScholarshipSolutionSection;
use Illuminate\Http\JsonResponse;

class ScholarshipSolutionSectionController extends Controller
{
    public function show(): JsonResponse
    {
        $section = ScholarshipSolutionSection::query()->firstOrCreate(
            ['page_key' => ScholarshipSolutionSection::HOME_PAGE_KEY],
            ScholarshipSolutionSection::defaultAttributes(),
        );
        $workflowCards = collect($section->workflow_cards ?: ScholarshipSolutionSection::defaultWorkflowCards())
            ->map(function (array $card) {
                return [
                    'iconKey' => $card['icon_key'] ?? '',
                    'title' => $card['title'] ?? '',
                    'description' => $card['description'] ?? '',
                    'details' => $card['details'] ?? '',
                ];
            })
            ->values()
            ->all();

        return response()->json([
            'success' => true,
            'data' => [
                'badgeText' => $section->badge_text,
                'heading' => $section->heading,
                'featurePills' => $section->feature_pills ?: ScholarshipSolutionSection::defaultFeaturePills(),
                'workflowCards' => $workflowCards,
                'ctaLabel' => $section->cta_label,
                'ctaUrl' => $section->cta_url,
            ],
        ]);
    }
}
