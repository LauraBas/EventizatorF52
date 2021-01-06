<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $this->withoutExceptionHandling(); 

        Event::factory()->create(['date' => '2006-08-22']);
        Event::factory()->create(['date' => '2026-08-22']);
        
        $this->get(route('events'))
            ->assertStatus(200)
            ->assertViewIs('events')
            ->assertViewHasAll(['pastEvents','commingEvents']);
    }
}
