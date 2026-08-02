<?php

namespace Tests\Feature;

use App\Models\FaqSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqSectionApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_faq_section_content(): void
    {
        FaqSection::query()->create(FaqSection::defaultAttributes());

        $response = $this->getJson('/api/content/faq');

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.badgeText', 'Frequently Asked Questions')
            ->assertJsonPath('data.faqItems.0.question', 'Who is this consultation best for?');
    }
}
