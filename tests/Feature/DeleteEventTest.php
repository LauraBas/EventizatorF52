<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $this->actingAs(User::factory()->create());
        $event = Event::factory()->create();

        $response = $this->delete('delete/' . $event->id);

        $this->assertAuthenticated();
        $response->assertStatus(200);
    }

    public function testRouteIfUserIsNotAuth()
    {    
        $event = Event::factory()->create();

        $response = $this->delete('delete/' . $event->id);

        $response->assertStatus(302);
    }

    public function testDeleteEvent()
    {
        $this->actingAs(User::factory()->create());
        $event = Event::factory()->create();

        $this->delete('delete/' . $event->id);

        $this->assertDatabaseCount('events', 0);
        $this->assertDatabaseMissing('events', $event->toArray());
    }


}