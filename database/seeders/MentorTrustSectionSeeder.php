<?php

namespace Database\Seeders;

use App\Models\MentorTrustSection;
use Illuminate\Database\Seeder;

class MentorTrustSectionSeeder extends Seeder
{
    public function run(): void
    {
        MentorTrustSection::query()->updateOrCreate(
            ['page_key' => MentorTrustSection::HOME_PAGE_KEY],
            MentorTrustSection::defaultAttributes(),
        );
    }
}
