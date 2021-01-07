<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;

class SeeUsersInEventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCanNotSeeUsersInEventIfNotAdmin()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/event/1/users');

        $response->assertStatus(401);
    }

    public function testSeeUsersInEventIfAdmin()
    {
        $event = Event::factory()->create();
        $this->actingAs(User::factory()->create(['isAdmin' => true]));
        $response = $this->get('/event/' . $event->id . '/users');

        $response->assertStatus(200);
    }
    public function testViewHasParticipantsInEventView()
    {
        $this->withoutExceptionHandling();
        $event = Event::factory()->create();
        $this->actingAs(User::factory()->create(['name'=> 'Laura']));      
        $this->post('/enroll/' . $event->id);  
        
        $this->actingAs(User::factory()->create(['name'=> 'Carmen']));      
        $this->post('/enroll/' . $event->id);  
        
        $this->actingAs(User::factory()->create(['isAdmin' => true]));
        $response = $this->get('/event/' . $event->id . '/users');
       
        $response->assertViewIs('participantsInEvent')
                ->assertViewHas('participantsInEvent',  [0 => "Laura", 1 => 'Carmen']);
    }
}
