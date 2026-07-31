<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AccountSettingsAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_stays_authenticated_after_profile_name_update(): void
    {
        $owner = User::query()->create([
            'name' => 'Owner User',
            'email' => 'owner@gmc.edu.pk',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'permissions' => ['dashboard', 'proofs', 'sizes'],
        ]);

        $response = $this->actingAs($owner)->post(route('settings.update'), [
            'name' => 'Updated Owner',
            'email' => 'owner@gmc.edu.pk',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertRedirect(route('settings.index'));
        $this->assertAuthenticatedAs($owner->fresh());
        $this->assertDatabaseHas('users', [
            'email' => 'owner@gmc.edu.pk',
            'name' => 'Updated Owner',
        ]);
    }

    public function test_login_page_recreates_default_users_when_table_is_empty(): void
    {
        $this->assertDatabaseCount('users', 0);

        $response = $this->get(route('login'));

        $response->assertOk();
        $this->assertDatabaseHas('users', [
            'email' => 'owner@gmc.edu.pk',
            'role' => 'owner',
        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'revenue@gmc.edu.pk',
            'role' => 'revenueOfficer',
        ]);
    }
}
