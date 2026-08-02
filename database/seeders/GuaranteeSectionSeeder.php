<?php

namespace Database\Seeders;

use App\Models\GuaranteeSection;
use Illuminate\Database\Seeder;

class GuaranteeSectionSeeder extends Seeder
{
    public function run(): void
    {
        GuaranteeSection::query()->updateOrCreate(
            ['page_key' => GuaranteeSection::HOME_PAGE_KEY],
            GuaranteeSection::defaultAttributes(),
        );
    }
}
