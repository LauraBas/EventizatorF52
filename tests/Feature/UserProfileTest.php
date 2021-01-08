<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;


class UserProfileTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testReturnUserProfileIfUserAuth()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get('user');

        $response->assertStatus(200);           
    }

    public function testNotReturnUserProfileIfUserNotAuth()
    {
        $response = $this->get('user');

        $response->assertStatus(302);
            
    }

    public function testReturnUserProfileView()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get('user');

        $response->assertViewIs('user');
            
    }

    public function testReturnUserProfileWithEvents()
    {
        $this->withoutExceptionHandling();

        $event = Event::factory()->create(['title'=>'Java']);
        $this->actingAs(User::factory()->create());  
        $this->post('/enroll/' . $event->id);
                    
        $response = $this->get('/user');
        $response->assertViewIs('user')
                ->assertViewHasAll(['pastEvents','commingEvents']);
    }
}
