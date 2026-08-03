<?php

namespace Database\Seeders;

use App\Models\EnrollmentFlowSection;
use Illuminate\Database\Seeder;

class EnrollmentFlowSectionSeeder extends Seeder
{
    public function run(): void
    {
        EnrollmentFlowSection::query()->updateOrCreate(
            ['page_key' => EnrollmentFlowSection::HOME_PAGE_KEY],
            EnrollmentFlowSection::defaultAttributes(),
        );
    }
}
