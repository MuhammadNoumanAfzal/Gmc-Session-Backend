<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SystemUserProvisioner
{
    public static function ensureDefaultUsersExist(): void
    {
        self::ensureOwnerExists();
        self::ensureRevenueOfficerExists();
    }

    public static function ensureOwnerExists(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'owner@gmc.edu.pk'],
            [
                'name' => 'Muhammad Nouman AFZAL',
                'password' => Hash::make('password'),
                'role' => 'owner',
                'permissions' => ['dashboard', 'proofs', 'sizes', 'employees'],
            ],
        );
    }

    public static function ensureRevenueOfficerExists(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'revenue@gmc.edu.pk'],
            [
                'name' => 'Revenue Officer',
                'password' => Hash::make('password'),
                'role' => 'revenueOfficer',
                'permissions' => ['proofs'],
            ],
        );
    }
}
