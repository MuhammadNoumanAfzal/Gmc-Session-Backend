<?php

namespace Tests\Feature;

use App\Models\HeroSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HeroSectionApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_hero_section_content(): void
    {
        HeroSection::query()->create(HeroSection::defaultAttributes());

        $response = $this->getJson('/api/content/hero');

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.badgeText', 'Learn From Students Who Won Fully Funded Scholarships')
            ->assertJsonPath('data.ctaUrl', '/program');
    }
}
