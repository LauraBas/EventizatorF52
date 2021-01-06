<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Event;
use App\Models\User;

class DeleteEventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRouteIfUserIsAuth()
    {
        $this->actingAs(User::factory()->create(['isAdmin' => true]));
        $event = Event::factory()->create();

        $response = $this->delete('event/delete/' . $event->id);

        $this->assertAuthenticated();
        $response->assertStatus(302);
    }

    public function testRouteIfUserIsNotAuth()
    {
        $this->actingAs(User::factory()->create());
        $event = Event::factory()->create();

        $response = $this->delete('event/delete/' . $event->id);

        $response->assertStatus(401);
    }

    public function testDeleteEvent()
    {
        $this->actingAs(User::factory()->create(['isAdmin' => true]));
        $event = Event::factory()->create();

        $this->delete('event/delete/' . $event->id);

        $this->assertDatabaseCount('events', 0);
        $this->assertDatabaseMissing('events', $event->toArray());
    }

    public function testReturnViewDashboard()
    {
        $this->actingAs(User::factory()->create(['isAdmin' => true]));
        $event = Event::factory()->create();

        $response = $this->delete('event/delete/' . $event->id);
        $response->assertRedirect('dashboard');
    }


}
