<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Event; 

class GetEventTest extends TestCase
{
    use RefreshDatabase; 
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_retrive_one_event()
    {
        $this->withoutExceptionHandling(); 
        
        Event::factory()->create(); 

        $response = $this->get('/events/' . 1);

        $response->assertStatus(200);
    }
}
