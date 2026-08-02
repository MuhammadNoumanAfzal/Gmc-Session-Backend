<?php

namespace Tests\Feature;

use App\Models\MediaProofSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MediaProofSectionApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_media_proof_section_content(): void
    {
        MediaProofSection::query()->create(MediaProofSection::defaultAttributes());

        $response = $this->getJson('/api/content/media-proof');

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.badgeText', 'Real Proof')
            ->assertJsonPath('data.videoItems.0.title', 'Student Success Call');
    }
}
