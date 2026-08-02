<?php

namespace Database\Seeders;

use App\Models\MediaProofSection;
use Illuminate\Database\Seeder;

class MediaProofSectionSeeder extends Seeder
{
    public function run(): void
    {
        MediaProofSection::query()->updateOrCreate(
            ['page_key' => MediaProofSection::HOME_PAGE_KEY],
            MediaProofSection::defaultAttributes(),
        );
    }
}
