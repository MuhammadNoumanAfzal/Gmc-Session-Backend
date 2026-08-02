<?php

namespace Database\Seeders;

use App\Models\ScholarshipSolutionSection;
use Illuminate\Database\Seeder;

class ScholarshipSolutionSectionSeeder extends Seeder
{
    public function run(): void
    {
        ScholarshipSolutionSection::query()->updateOrCreate(
            ['page_key' => ScholarshipSolutionSection::HOME_PAGE_KEY],
            ScholarshipSolutionSection::defaultAttributes(),
        );
    }
}
