<?php

namespace Database\Seeders;

use App\Models\FaqSection;
use Illuminate\Database\Seeder;

class FaqSectionSeeder extends Seeder
{
    public function run(): void
    {
        FaqSection::query()->updateOrCreate(
            ['page_key' => FaqSection::HOME_PAGE_KEY],
            FaqSection::defaultAttributes(),
        );
    }
}
