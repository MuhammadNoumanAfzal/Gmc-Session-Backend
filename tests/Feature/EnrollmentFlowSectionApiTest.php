<?php

namespace Tests\Feature;

use App\Models\EnrollmentFlowSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrollmentFlowSectionApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_enrollment_flow_section_content(): void
    {
        EnrollmentFlowSection::query()->create(EnrollmentFlowSection::defaultAttributes());

        $response = $this->getJson('/api/content/enrollment-flow');

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.stepItems.0.label', 'Review Slot')
            ->assertJsonPath('data.summaryHeading', 'Get enrolled now.')
            ->assertJsonPath('data.metaSessionType', 'GMC Scholarship Consultation');
    }
}
