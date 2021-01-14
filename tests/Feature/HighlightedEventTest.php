<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Event;

class HighlightedEventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRouteHome()
    {
        Event::factory(4)->create();

        $response = $this->get(route('home'));

        $response->assertStatus(200);
            
    }

    public function testReturnViewWithHighlightedEvents()
    {
        $this->withoutExceptionHandling();

        Event::factory(1)->create(['isHighlighted' => 1]);
       
        $response = $this->get(route('home'));

        $response->assertViewIs('welcome')
            ->assertViewHasAll(['highlightedEvents']);
    }
}
