<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_display_events_index(): void
    {
        Event::create([
            'event_name' => 'Festival Erau Pelas Benua',
            'location' => 'Tenggarong',
            'start_date' => '2026-09-20',
            'end_date' => '2026-09-28',
            'organizer' => 'Kesultanan Kutai Kartanegara',
            'description' => 'Upacara sakral adat budaya tertua.',
        ]);

        $response = $this->get(route('events.index'));

        $response->assertStatus(200);
        $response->assertSee('Festival Erau Pelas Benua');
        $response->assertSee('Tenggarong');
    }

    public function test_can_create_event(): void
    {
        $payload = [
            'event_name' => 'Balikpapan Fest 2026',
            'location' => 'BSCC Dome Balikpapan',
            'start_date' => '2026-10-15',
            'end_date' => '2026-10-18',
            'organizer' => 'Disporapar Balikpapan',
            'description' => 'Pesta industri kreatif dan pariwisata akbar.',
        ];

        $response = $this->post(route('events.store'), $payload);

        $response->assertRedirect(route('events.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('events', [
            'event_name' => 'Balikpapan Fest 2026',
            'location' => 'BSCC Dome Balikpapan',
        ]);
    }

    public function test_can_update_event(): void
    {
        $event = Event::create([
            'event_name' => 'Festival Mahakam',
            'location' => 'Tepian Mahakam',
            'start_date' => '2026-11-06',
            'end_date' => '2026-11-08',
            'organizer' => 'Pemkot Samarinda',
            'description' => 'Perayaan pesona Sungai Mahakam.',
        ]);

        $updatePayload = [
            'event_name' => 'Festival Mahakam Internasional 2026',
            'location' => 'Tepian Mahakam, Samarinda',
            'start_date' => '2026-11-06',
            'end_date' => '2026-11-09',
            'organizer' => 'Pemkot Samarinda & Dispar',
            'description' => 'Perayaan pesona internasional Sungai Mahakam.',
        ];

        $response = $this->put(route('events.update', $event), $updatePayload);

        $response->assertRedirect(route('events.index'));
        $response->assertSessionHas('success');

        $event->refresh();
        $this->assertEquals('Festival Mahakam Internasional 2026', $event->event_name);
    }

    public function test_can_delete_event(): void
    {
        $event = Event::create([
            'event_name' => 'Event Uji Coba',
            'location' => 'Bontang',
            'start_date' => '2026-12-01',
            'end_date' => '2026-12-02',
            'organizer' => 'Komunitas',
            'description' => 'Deskripsi event.',
        ]);

        $response = $this->delete(route('events.destroy', $event));

        $response->assertRedirect(route('events.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }
}

