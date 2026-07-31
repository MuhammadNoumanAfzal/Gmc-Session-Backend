<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Support\SystemUserProvisioner;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        SystemUserProvisioner::ensureDefaultUsersExist();

        $this->call(HeroSectionSeeder::class);
        $this->call(PaymentProofSeeder::class);
    }
}
