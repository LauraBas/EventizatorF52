<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;

class UpdateEventTest extends TestCase
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

        $response = $this->put(route('update', $event) , $event->toArray());

        $this->assertAuthenticated();
        $response->assertStatus(200);
    }
    
    public function testRouteIfUserIsNotAuth()
    {
        $event = Event::factory()->create();

        $response = $this->put(route('update', $event) , $event->toArray());

        $response->assertStatus(302);
    }

    public function testDataBaseHasUpdatedEvent()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $event = Event::factory()->create();
        $event->title = 'Tortus';
        
        $this->put(route('update', $event) , $event->toArray());
        $this->assertDatabaseHas('events', ['id' => $event->id, 'title' => 'Tortus']);
    }

}