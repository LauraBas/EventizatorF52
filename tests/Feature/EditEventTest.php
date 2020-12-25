<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;

class EditEventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRouteEditFormIfUserIsAuth()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isAdmin' => true]));
        $event = Event::factory()->create();

        $response = $this->get('event/edit/' . $event->id);

        $this->assertAuthenticated();
        $response->assertStatus(200);
    }

    public function testRouteEditFormIfUserIsNotAuth()
    {
        $this->actingAs(User::factory()->create());
        $event = Event::factory()->create();

        $response = $this->get('event/edit/' . $event->id);

        $response->assertStatus(401);
    }

    public function testReturnViewEditForm()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isAdmin' => true]));

        $event = Event::factory()->create();

        $response = $this->get('event/edit/' . $event->id);

        $response->assertStatus(200)
         ->assertViewIs('edit')
         ->assertViewHas(['event'=> $event]);
    }

}
