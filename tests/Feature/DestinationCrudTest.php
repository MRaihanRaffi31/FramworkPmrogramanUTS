<?php

namespace Tests\Feature;

use App\Models\Destination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DestinationCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_display_destinations_index(): void
    {
        Destination::create([
            'name' => 'Pulau Derawan',
            'slug' => 'pulau-derawan',
            'category' => 'Wisata Bahari',
            'location_city' => 'Berau',
            'ticket_price' => 50000,
            'description' => 'Destinasi laut nan indah.',
            'opening_hours' => '24 Jam',
        ]);

        $response = $this->get(route('destinations.index'));

        $response->assertStatus(200);
        $response->assertSee('Pulau Derawan');
        $response->assertSee('Berau');
    }

    public function test_can_create_destination_with_image_upload(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('derawan.jpg', 100, 'image/jpeg');

        $payload = [
            'name' => 'Danau Labuan Cermin',
            'category' => 'Wisata Alam',
            'location_city' => 'Berau',
            'ticket_price' => 30000,
            'opening_hours' => '08:00 - 17:00',
            'description' => 'Danau dua rasa yang sangat jernih.',
            'image' => $file,
        ];

        $response = $this->post(route('destinations.store'), $payload);

        $response->assertRedirect(route('destinations.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('destinations', [
            'name' => 'Danau Labuan Cermin',
            'slug' => 'danau-labuan-cermin',
            'location_city' => 'Berau',
        ]);

        $destination = Destination::where('name', 'Danau Labuan Cermin')->first();
        $this->assertNotNull($destination->image);
        Storage::disk('public')->assertExists($destination->image);
    }

    public function test_can_update_destination_and_replaces_old_image(): void
    {
        Storage::fake('public');

        $oldFile = UploadedFile::fake()->create('old.jpg', 100, 'image/jpeg');
        $oldPath = $oldFile->store('destinations', 'public');

        $destination = Destination::create([
            'name' => 'Bukit Bangkirai',
            'slug' => 'bukit-bangkirai',
            'category' => 'Hutan Lindung & Ekowisata',
            'location_city' => 'Kutai Kartanegara',
            'ticket_price' => 35000,
            'opening_hours' => '08:00 - 16:30',
            'description' => 'Wisata jembatan tajuk pohon kanopi.',
            'image' => $oldPath,
        ]);

        Storage::disk('public')->assertExists($oldPath);

        $newFile = UploadedFile::fake()->create('new.jpg', 100, 'image/jpeg');

        $updatePayload = [
            'name' => 'Kawasan Wisata Bukit Bangkirai',
            'category' => 'Hutan Lindung & Ekowisata',
            'location_city' => 'Kutai Kartanegara',
            'ticket_price' => 40000,
            'opening_hours' => '08:00 - 17:00',
            'description' => 'Deskripsi diperbarui.',
            'image' => $newFile,
        ];

        $response = $this->put(route('destinations.update', $destination), $updatePayload);

        $response->assertRedirect(route('destinations.show', $destination));
        $response->assertSessionHas('success');

        $destination->refresh();

        // Old file must be deleted from storage
        Storage::disk('public')->assertMissing($oldPath);
        // New file must exist
        Storage::disk('public')->assertExists($destination->image);
        $this->assertEquals(40000, $destination->ticket_price);
    }

    public function test_can_delete_destination_and_deletes_image_file(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('pampang.jpg', 100, 'image/jpeg');
        $path = $file->store('destinations', 'public');

        $destination = Destination::create([
            'name' => 'Desa Budaya Pampang',
            'slug' => 'desa-budaya-pampang',
            'category' => 'Budaya & Sejarah',
            'location_city' => 'Samarinda',
            'ticket_price' => 40000,
            'opening_hours' => 'Minggu (14:00 - 17:00)',
            'description' => 'Pusat budaya Dayak Kenyah.',
            'image' => $path,
        ]);

        Storage::disk('public')->assertExists($path);

        $response = $this->delete(route('destinations.destroy', $destination));

        $response->assertRedirect(route('destinations.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('destinations', ['id' => $destination->id]);
        Storage::disk('public')->assertMissing($path);
    }
}

