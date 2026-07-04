<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed default owner account
        \App\Models\User::create([
            'name' => 'Muhammad Nouman AFZAL',
            'email' => 'owner@gmc.edu.pk',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'owner',
            'permissions' => ['dashboard', 'proofs', 'sizes', 'employees'],
        ]);

        // Seed default revenueOfficer account
        \App\Models\User::create([
            'name' => 'Revenue Officer',
            'email' => 'revenue@gmc.edu.pk',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'revenueOfficer',
            'permissions' => ['proofs'],
        ]);

        $this->call(PaymentProofSeeder::class);
    }
}
