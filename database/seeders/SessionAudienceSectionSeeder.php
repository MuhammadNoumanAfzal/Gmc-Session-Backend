<?php

namespace Database\Seeders;

use App\Models\SessionAudienceSection;
use Illuminate\Database\Seeder;

class SessionAudienceSectionSeeder extends Seeder
{
    public function run(): void
    {
        SessionAudienceSection::query()->updateOrCreate(
            ['page_key' => SessionAudienceSection::HOME_PAGE_KEY],
            SessionAudienceSection::defaultAttributes(),
        );
    }
}
