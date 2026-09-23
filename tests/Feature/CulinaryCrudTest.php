<?php

namespace Tests\Feature;

use App\Models\Culinary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CulinaryCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_display_culinaries_index(): void
    {
        Culinary::create([
            'name' => 'Nasi Bekepor',
            'origin_city' => 'Kutai Kartanegara',
            'price_range' => 'Rp 25.000 - Rp 45.000',
            'description' => 'Nasi liwet khas Kutai.',
            'recommended_spot' => 'Warung Selera Raja',
        ]);

        $response = $this->get(route('culinaries.index'));

        $response->assertStatus(200);
        $response->assertSee('Nasi Bekepor');
        $response->assertSee('Kutai Kartanegara');
    }

    public function test_can_create_culinary_with_image_upload(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('amplang.jpg', 100, 'image/jpeg');

        $payload = [
            'name' => 'Amplang Kuku Macan',
            'origin_city' => 'Samarinda',
            'price_range' => 'Rp 30.000 - Rp 100.000',
            'recommended_spot' => 'Citra Niaga Samarinda',
            'description' => 'Kerupuk ikan pipih renyah.',
            'image' => $file,
        ];

        $response = $this->post(route('culinaries.store'), $payload);

        $response->assertRedirect(route('culinaries.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('culinaries', [
            'name' => 'Amplang Kuku Macan',
            'origin_city' => 'Samarinda',
        ]);

        $culinary = Culinary::where('name', 'Amplang Kuku Macan')->first();
        $this->assertNotNull($culinary->image);
        Storage::disk('public')->assertExists($culinary->image);
    }

    public function test_can_update_culinary_and_replace_image(): void
    {
        Storage::fake('public');

        $oldFile = UploadedFile::fake()->create('old_ayam.jpg', 100, 'image/jpeg');
        $oldPath = $oldFile->store('culinaries', 'public');

        $culinary = Culinary::create([
            'name' => 'Ayam Cincane',
            'origin_city' => 'Samarinda',
            'price_range' => 'Rp 35.000 - Rp 70.000',
            'recommended_spot' => 'Depot Cincane Tepian',
            'description' => 'Ayam bakar bumbu merah.',
            'image' => $oldPath,
        ]);

        Storage::disk('public')->assertExists($oldPath);

        $newFile = UploadedFile::fake()->create('new_ayam.jpg', 100, 'image/jpeg');

        $updatePayload = [
            'name' => 'Ayam Cincane Spesial',
            'origin_city' => 'Samarinda',
            'price_range' => 'Rp 40.000 - Rp 80.000',
            'recommended_spot' => 'Restoran Torani & Depot Cincane',
            'description' => 'Deskripsi ayam cincane baru.',
            'image' => $newFile,
        ];

        $response = $this->put(route('culinaries.update', $culinary), $updatePayload);

        $response->assertRedirect(route('culinaries.index'));
        $response->assertSessionHas('success');

        $culinary->refresh();

        Storage::disk('public')->assertMissing($oldPath);
        Storage::disk('public')->assertExists($culinary->image);
        $this->assertEquals('Ayam Cincane Spesial', $culinary->name);
    }

    public function test_can_delete_culinary_and_delete_image(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('pisang.jpg', 100, 'image/jpeg');
        $path = $file->store('culinaries', 'public');

        $culinary = Culinary::create([
            'name' => 'Pisang Gapit',
            'origin_city' => 'Balikpapan',
            'price_range' => 'Rp 15.000 - Rp 25.000',
            'recommended_spot' => 'Lapangan Merdeka',
            'description' => 'Pisang bakar saus kental gula aren.',
            'image' => $path,
        ]);

        Storage::disk('public')->assertExists($path);

        $response = $this->delete(route('culinaries.destroy', $culinary));

        $response->assertRedirect(route('culinaries.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('culinaries', ['id' => $culinary->id]);
        Storage::disk('public')->assertMissing($path);
    }
}

