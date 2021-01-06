<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CreateEventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testReturnsErrorIfNotAdmin()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        
        $response = $this->get('/event/create');

        $response->assertStatus(401);
    }

    public function testReturnsViewIfAdmin()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isAdmin'=>true]));
        
        $response = $this->get('/event/create');

        $this->assertAuthenticated();
        $response->assertStatus(200)
            ->assertViewIs('create');
    }

}
