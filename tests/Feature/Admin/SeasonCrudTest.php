<?php

namespace Tests\Feature\Admin;

use App\Enums\SeasonStatus;
use App\Models\Season;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeasonCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_players_cannot_list_seasons(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('admin.seasons.index'));

        $response->assertForbidden();
    }

    public function test_admins_can_list_seasons(): void
    {
        $user = User::factory()->admin()->create();
        Season::factory()->count(2)->create();
        $this->actingAs($user);

        $response = $this->get(route('admin.seasons.index'));

        $response->assertOk();
    }

    public function test_admins_cannot_create_seasons(): void
    {
        $user = User::factory()->admin()->create();
        $this->actingAs($user);

        $response = $this->get(route('admin.seasons.create'));

        $response->assertForbidden();
    }

    public function test_super_admin_can_create_season(): void
    {
        $user = User::factory()->superAdmin()->create();
        $this->actingAs($user);

        $response = $this->post(route('admin.seasons.store'), [
            'name' => 'Summer League',
            'game_type' => 'cricket',
            'starts_at' => '2026-06-01',
            'ends_at' => '2026-08-31',
            'registration_opens_at' => '2026-05-01T00:00',
            'registration_closes_at' => '2026-05-31T23:59',
            'status' => SeasonStatus::Draft->value,
        ]);

        $response->assertRedirect(route('admin.seasons.index'));
        $this->assertDatabaseHas('seasons', [
            'name' => 'Summer League',
            'game_type' => 'cricket',
            'status' => SeasonStatus::Draft->value,
        ]);
    }

    public function test_super_admin_can_update_season(): void
    {
        $user = User::factory()->superAdmin()->create();
        $season = Season::factory()->create(['name' => 'Old Name']);
        $this->actingAs($user);

        $response = $this->put(route('admin.seasons.update', $season), [
            'name' => 'New Name',
            'game_type' => $season->game_type,
            'starts_at' => $season->starts_at?->format('Y-m-d'),
            'ends_at' => $season->ends_at?->format('Y-m-d'),
            'registration_opens_at' => $season->registration_opens_at?->format('Y-m-d\TH:i'),
            'registration_closes_at' => $season->registration_closes_at?->format('Y-m-d\TH:i'),
            'status' => SeasonStatus::RegistrationOpen->value,
        ]);

        $response->assertRedirect(route('admin.seasons.index'));
        $this->assertDatabaseHas('seasons', [
            'id' => $season->id,
            'name' => 'New Name',
            'status' => SeasonStatus::RegistrationOpen->value,
        ]);
    }

    public function test_admins_cannot_update_seasons(): void
    {
        $user = User::factory()->admin()->create();
        $season = Season::factory()->create();
        $this->actingAs($user);

        $response = $this->put(route('admin.seasons.update', $season), [
            'name' => 'Blocked',
            'game_type' => $season->game_type,
            'status' => SeasonStatus::Draft->value,
        ]);

        $response->assertForbidden();
    }
}
