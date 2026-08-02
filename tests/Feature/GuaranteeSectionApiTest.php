<?php

namespace Tests\Feature;

use App\Models\GuaranteeSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuaranteeSectionApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_guarantee_section_content(): void
    {
        GuaranteeSection::query()->create(GuaranteeSection::defaultAttributes());

        $response = $this->getJson('/api/content/guarantee');

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.headingLine1', 'Serious guidance.')
            ->assertJsonPath('data.sealValueText', '100%');
    }
}
