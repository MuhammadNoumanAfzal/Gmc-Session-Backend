<?php

namespace Tests\Feature;

use App\Models\ScholarshipSolutionSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScholarshipSolutionSectionApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_scholarship_solution_section_content(): void
    {
        ScholarshipSolutionSection::query()->create(ScholarshipSolutionSection::defaultAttributes());

        $response = $this->getJson('/api/content/scholarship-solution');

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.badgeText', 'A smarter path for ambitious scholarship applicants')
            ->assertJsonPath('data.ctaUrl', '/program');
    }
}
