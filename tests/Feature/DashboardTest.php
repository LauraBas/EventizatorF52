<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User; 
use App\Models\Event; 

class DashboardTest extends TestCase
{
    use RefreshDatabase; 
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdminDashboardHasEventsList()
    {
        $this->withoutExceptionHandling(); 
        $this->actingAs(User::factory()->create(['isAdmin' => true]));

        $events = Event::factory(5)->create();
        $this->assertCount(5, $events); 
       $events = Event::all(); 

        $response = $this->get('/dashboard')
            ->assertStatus(200)
            ->assertViewIs('dashboard')
            ->assertViewHasAll(['events']);         
    }

    public function testNoAdminCanNotAcessDashboard() 
    {
        $this->get('/dashboard')
            ->assertStatus(401);
    }
}
