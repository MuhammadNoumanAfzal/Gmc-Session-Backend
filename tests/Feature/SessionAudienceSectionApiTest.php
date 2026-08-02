<?php

namespace Tests\Feature;

use App\Models\SessionAudienceSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SessionAudienceSectionApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_session_audience_section_content(): void
    {
        SessionAudienceSection::query()->create(SessionAudienceSection::defaultAttributes());

        $response = $this->getJson('/api/content/session-audience');

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.badgeText', 'For Whom Is This Session For?')
            ->assertJsonPath('data.audienceCards.0.iconKey', 'graduation-cap')
            ->assertJsonPath('data.audienceCards.0.title', 'Students planning funded admissions');
    }
}
