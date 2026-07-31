<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    public function run(): void
    {
        HeroSection::query()->updateOrCreate(
            ['page_key' => HeroSection::HOME_PAGE_KEY],
            HeroSection::defaultAttributes(),
        );
    }
}
