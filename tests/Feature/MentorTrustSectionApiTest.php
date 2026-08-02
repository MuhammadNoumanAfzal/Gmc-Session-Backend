<?php

namespace Tests\Feature;

use App\Models\MentorTrustSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MentorTrustSectionApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_mentor_trust_section_content(): void
    {
        MentorTrustSection::query()->create(MentorTrustSection::defaultAttributes());

        $response = $this->getJson('/api/content/mentor-trust');

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.badgeText', 'Your Scholarship Mentor')
            ->assertJsonPath('data.headingAccent', 'GMC Guidance');
    }
}
