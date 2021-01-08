<?php

namespace Tests\Feature;

use App\Mail\UnenrollEventEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;

class UnenrollToEventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRouteAUserAuth()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());
        $event = Event::factory()->create();

        $response = $this->post('/unenroll/' . $event->id);

        $response->assertStatus(302);
    }

    public function testRouteIfAUserNotAuth()
    {
        $event = Event::factory()->create();

        $response = $this->post('/unenroll/' . $event->id);

        $response->assertStatus(302);
    }

    public function testUnenrollUserToEvent()
    {
        $this->withoutExceptionHandling();

        $event = Event::factory()->create();
        $this->actingAs(User::factory()->create());

        $this->post('/enroll/' . $event->id);
        $this->post('/unenroll/' . $event->id);

        $this->assertDatabaseCount('event_user', 0);
    }

    public function testSendEmailWhenUserUnenrollEvent()
    {
        $this->withoutExceptionHandling();
        Mail::fake();
        $event = Event::factory()->create();
        $this->actingAs(User::factory()->create());

        $this->post('/enroll/' . $event->id);
        $this->post('/unenroll/' . $event->id);

        Mail::assertSent(UnenrollEventEmail::class);
    }

    public function testEmailContent()
    {
        $event = Event::factory()->create(['title'=>'Laravel']);
        $mailable = new UnenrollEventEmail($event);

        $mailable->assertSeeInHtml('eventizatorF52.com');
        $mailable->assertSeeInHtml('Laravel');
        $mailable->assertSeeInHtml('You unenrolled');
        $mailable->assertSeeInHtml($event->date);
        $mailable->assertSeeInHtml($event->time);
        $mailable->assertSeeInHtml($event->requirements);
        $mailable->assertSeeInHtml($event->link);
    }

    public function testReturnUserViewAfterUnenroll()
    {
        $event = Event::factory()->create();
        $this->actingAs(User::factory()->create());

        $this->post('/enroll/' . $event->id);
        $response = $this->post('/unenroll/' . $event->id);
        $response->assertRedirect('user');        
    }

    public function testDecrementParticipantsInDBAfterUserUnenroll()
    {
        $event = Event::factory()->create(['capacity'=> 10, 'participants'=> 0]);
        $this->actingAs(User::factory()->create());

        $this->post('/enroll/' . $event->id);
        $this->assertDatabaseHas('events', ['participants'=> 1]);

        $this->post('/unenroll/' . $event->id);
        $this->assertDatabaseHas('events', ['participants'=> 0]);
    }
}
