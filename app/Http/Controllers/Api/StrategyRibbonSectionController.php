<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StrategyRibbonSection;
use Illuminate\Http\JsonResponse;

class StrategyRibbonSectionController extends Controller
{
    public function show(): JsonResponse
    {
        $section = StrategyRibbonSection::query()->firstOrCreate(
            ['page_key' => StrategyRibbonSection::HOME_PAGE_KEY],
            StrategyRibbonSection::defaultAttributes(),
        );

        return response()->json([
            'success' => true,
            'data' => [
                'frontRibbonItems' => $section->front_ribbon_items ?: StrategyRibbonSection::defaultFrontRibbonItems(),
                'backRibbonItems' => $section->back_ribbon_items ?: StrategyRibbonSection::defaultBackRibbonItems(),
            ],
        ]);
    }
}
