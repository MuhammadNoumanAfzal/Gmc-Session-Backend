<?php

namespace Tests\Feature;

use App\Models\StrategyRibbonSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StrategyRibbonSectionApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_strategy_ribbon_section_content(): void
    {
        StrategyRibbonSection::query()->create(StrategyRibbonSection::defaultAttributes());

        $response = $this->getJson('/api/content/strategy-ribbon');

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.frontRibbonItems.0', 'GMC Scholarship Strategy')
            ->assertJsonPath('data.backRibbonItems.0', 'Scholarship Positioning');
    }
}
