<?php

namespace Tests\Feature;

use App\Mail\EnrollEventEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Mail\InvoicePaid;

class EnrollToEventTest extends TestCase
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

        $response = $this->post('/enroll/' . $event->id);

        $response->assertStatus(200);
    }

    public function testRouteIfAUserNotAuth()
    {
        $event = Event::factory()->create();

        $response = $this->post('/enroll/' . $event->id);

        $response->assertStatus(302);
    }

    public function testEnrollUserToEvent()
    {
        $this->withoutExceptionHandling();

        $event = Event::factory()->create();
        $this->actingAs(User::factory()->create());

        $response = $this->post('/enroll/' . $event->id);

        $response->assertStatus(200);
        $this->assertDatabaseCount('event_user', 1);
    }

    public function testSendsEmailWhenUserEnrolls()
    {
        $this->withoutExceptionHandling();
        Mail::fake();
        $event = Event::factory()->create();
        $this->actingAs(User::factory()->create());

        $this->post('/enroll/' . $event->id);

        Mail::assertSent(EnrollEventEmail::class);

    }

    public function testMailContent()
    {
        $event = Event::factory()->create(['title'=>'Laravel']);

        $mailable = new EnrollEventEmail($event);

        $mailable->assertSeeInHtml('eventizatorF52.com');
        $mailable->assertSeeInHtml('Laravel');
        $mailable->assertSeeInHtml($event->date);
        $mailable->assertSeeInHtml($event->time);
        $mailable->assertSeeInHtml($event->requirements);
        $mailable->assertSeeInHtml($event->link);
        $mailable->assertSeeInHtml('See you');
    }

    public function testCannotEnrollUserToEventTwice()
    {
        $this->withoutExceptionHandling();
        $event = Event::factory()->create();
        $this->actingAs(User::factory()->create());

        $this->post('/enroll/' . $event->id);
        $response = $this->post('/enroll/' . $event->id);

        $response->assertStatus(200);
        $this->assertDatabaseCount('event_user', 1);
    }

    public function testCanNotEnrollIfEventHasNoCapacity()
    {
        $this->withoutExceptionHandling();
        $event = Event::factory()->create(['capacity'=> 0]);

        $this->actingAs(User::factory()->create());

        $this->post('/enroll/' . $event->id);

        $this->assertDatabaseCount('event_user', 0);
    }

    public function testCanEnrollIfEventHasCapacity()
    {
        $this->withoutExceptionHandling();
        $event = Event::factory()->create(['capacity'=> 5, 'participants'=> 1]);

        $this->actingAs(User::factory()->create());

        $this->post('/enroll/' . $event->id);

        $this->assertDatabaseCount('event_user', 1);
        $this->assertDatabaseHas('events', ['participants'=> 2]);
    }

    public function testReturnConfirmationMessageAfterEnroll()
    {

        $this->withoutExceptionHandling();
        $event = Event::factory()->create();

        $this->actingAs(User::factory()->create());

        $response = $this->post('/enroll/' . $event->id);        

        $response->assertViewIs('responses.enrollResponse')
            ->assertViewHas(["message" => "You're enroll in the event " . $event->title]);
    }

    public function testReturnResponseWhenUserIsAlreadyEnrollInEvent()
    {
        $this->withoutExceptionHandling();
        $event = Event::factory()->create();
        $this->actingAs(User::factory()->create());

        $this->post('/enroll/' . $event->id);
        $response = $this->post('/enroll/' . $event->id);

        $response->assertViewIs('responses.enrollFailedResponse')
            ->assertViewHas(["message" => "You're already enroll in the event " . $event->title]);
    }

}
