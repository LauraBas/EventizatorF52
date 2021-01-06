<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class StoreEventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreEvent()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isAdmin'=>true]));
        
        $response =$this->post(route('store'), [
            'title' => 'Master', 
            'date' => '3/4/21', 
            'time' => '12:30', 
            'description' => 'lorem ipsum', 
            'capacity' => 100,  
            'requirements' => 'pc', 
            'image' => 'code image', 
            'link' => 'egrwerdwsa',
            'isHighlighted' => '1'
            ]);
              
        $response->assertRedirect('dashboard');    
        $this->assertDatabaseCount('events', 1);
        $this->assertDataBaseHas('events',['title' => 'Master']); 
    }
}
