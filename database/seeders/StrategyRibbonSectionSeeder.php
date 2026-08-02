<?php

namespace Database\Seeders;

use App\Models\StrategyRibbonSection;
use Illuminate\Database\Seeder;

class StrategyRibbonSectionSeeder extends Seeder
{
    public function run(): void
    {
        StrategyRibbonSection::query()->updateOrCreate(
            ['page_key' => StrategyRibbonSection::HOME_PAGE_KEY],
            StrategyRibbonSection::defaultAttributes(),
        );
    }
}
