<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;

class EnrollToEventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRouteAUserAuth()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());
        $event = Event::factory()->create();

        $response = $this->post('/enroll/' . $event->id);

        $response->assertStatus(200);
    }

    public function testRouteIfAUserNotAuth()
    {
        $event = Event::factory()->create();

        $response = $this->post('/enroll/' . $event->id);

        $response->assertStatus(302);
    }

    public function testEnrollUserToEvent()
    {
        $this->withoutExceptionHandling();

        $event = Event::factory()->create();
        $this->actingAs(User::factory()->create());

        $response = $this->post('/enroll/' . $event->id);

        $response->assertStatus(200);
        $this->assertDatabaseCount('event_user', 1);
    }

    public function testCannotEnrollUserToEventTwice()
    {
        $this->withoutExceptionHandling();

        $event = Event::factory()->create();
        $this->actingAs(User::factory()->create());

        $this->post('/enroll/' . $event->id);
        $response = $this->post('/enroll/' . $event->id);

        $response->assertStatus(200);
        $this->assertDatabaseCount('event_user', 1);
    }


}
