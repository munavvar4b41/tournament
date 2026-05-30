<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_admin(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_players_cannot_access_admin(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('admin.dashboard'));

        $response->assertForbidden();
    }

    public function test_admins_can_access_admin_dashboard(): void
    {
        $user = User::factory()->admin()->create();
        $this->actingAs($user);

        $response = $this->get(route('admin.dashboard'));

        $response->assertOk();
    }

    public function test_super_admins_can_access_admin_dashboard(): void
    {
        $user = User::factory()->superAdmin()->create();
        $this->actingAs($user);

        $response = $this->get(route('admin.dashboard'));

        $response->assertOk();
    }
}
