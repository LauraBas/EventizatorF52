<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Event; 

class GetEventsTest extends TestCase
{
    use RefreshDatabase; 
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_retrive_all_events()
    {
        // $this->withoutExceptionHandling(); 

        $events = Event::factory(5)->create();

        $this->assertCount(5, $events);

        $events= Event::all();

        $response = $this->get(route('events'))
            ->assertStatus(200)
            ->assertViewIs('events')
            ->assertViewHas('events', $events)
            ->assertSee($events[0] ->title);
    }
}
