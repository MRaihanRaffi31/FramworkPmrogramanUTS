<?php

namespace Tests\Feature;

use App\Models\VisitorReview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VisitorReviewCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_display_reviews_index(): void
    {
        VisitorReview::create([
            'visitor_name' => 'Dimas Prasetyo',
            'destination_visited' => 'Kepulauan Derawan',
            'rating' => 5,
            'review_text' => 'Pengalaman diving terindah seumur hidup!',
            'visit_date' => '2026-08-12',
        ]);

        $response = $this->get(route('reviews.index'));

        $response->assertStatus(200);
        $response->assertSee('Dimas Prasetyo');
        $response->assertSee('Kepulauan Derawan');
    }

    public function test_can_create_review(): void
    {
        $payload = [
            'visitor_name' => 'Rahmat Hidayat',
            'destination_visited' => 'Bukit Bangkirai',
            'rating' => 5,
            'visit_date' => date('Y-m-d'),
            'review_text' => 'Canopy bridge sangat mengesankan dan asri.',
        ];

        $response = $this->post(route('reviews.store'), $payload);

        $response->assertRedirect(route('reviews.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('visitor_reviews', [
            'visitor_name' => 'Rahmat Hidayat',
            'destination_visited' => 'Bukit Bangkirai',
        ]);
    }

    public function test_can_update_review(): void
    {
        $review = VisitorReview::create([
            'visitor_name' => 'Siti Nurhaliza',
            'destination_visited' => 'Danau Labuan Cermin',
            'rating' => 4,
            'review_text' => 'Bagus sekali airnya jernih.',
            'visit_date' => date('Y-m-d'),
        ]);

        $updatePayload = [
            'visitor_name' => 'Siti Nurhaliza',
            'destination_visited' => 'Danau Labuan Cermin',
            'rating' => 5,
            'visit_date' => date('Y-m-d'),
            'review_text' => 'Airnya sangat jernih dan ada dua rasa tawar dan asin.',
        ];

        $response = $this->put(route('reviews.update', $review), $updatePayload);

        $response->assertRedirect(route('reviews.index'));
        $response->assertSessionHas('success');

        $review->refresh();
        $this->assertEquals(5, $review->rating);
    }

    public function test_can_delete_review(): void
    {
        $review = VisitorReview::create([
            'visitor_name' => 'Clarissa Tan',
            'destination_visited' => 'Desa Budaya Pampang',
            'rating' => 5,
            'review_text' => 'Tarian adat Dayak Kenyah sangat indah.',
            'visit_date' => date('Y-m-d'),
        ]);

        $response = $this->delete(route('reviews.destroy', $review));

        $response->assertRedirect(route('reviews.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('visitor_reviews', ['id' => $review->id]);
    }
}

