<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Culinary;
use App\Models\Destination;
use App\Models\Event;
use App\Models\VisitorReview;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // 1. Destinasi Wisata Kalimantan Timur (40 Destinasi: 4 per Kab/Kota)
        $destinations = [
            // SAMARINDA (4 Destinasi)
            [
                'name' => 'Desa Budaya Pampang',
                'category' => 'Budaya & Sejarah',
                'location_city' => 'Samarinda',
                'ticket_price' => 40000,
                'opening_hours' => 'Senin–Sabtu 08.30–17.00; Minggu 11.00–17.00',
                'description' => 'Desa wisata budaya yang memperkenalkan kehidupan, tradisi, dan kesenian masyarakat Dayak di Samarinda.',
                'image' => null,
            ],
            [
                'name' => 'Taman Tepian Mahakam',
                'category' => 'Rekreasi Keluarga',
                'location_city' => 'Samarinda',
                'ticket_price' => 0,
                'opening_hours' => '05.00-00.00',
                'description' => 'Kawasan ruang publik di tepian Sungai Mahakam yang digunakan untuk bersantai dan menikmati suasana kota Samarinda.',
                'image' => null,
            ],
            [
                'name' => 'Jembatan Mahkota II',
                'category' => 'Rekreasi Keluarga',
                'location_city' => 'Samarinda',
                'ticket_price' => 0,
                'opening_hours' => '24 jam (akses jembatan)',
                'description' => 'Jembatan yang melintasi Sungai Mahakam dan menjadi salah satu ikon kota serta titik pemandangan kawasan Samarinda.',
                'image' => null,
            ],
            [
                'name' => 'Taman Samarendah',
                'category' => 'Rekreasi Keluarga',
                'location_city' => 'Samarinda',
                'ticket_price' => 0,
                'opening_hours' => '24 jam',
                'description' => 'Ruang terbuka hijau di pusat Samarinda yang dapat digunakan untuk bersantai dan menikmati suasana kota.',
                'image' => null,
            ],

            // BALIKPAPAN (4 Destinasi)
            [
                'name' => 'Pantai Manggar Segara Sari',
                'category' => 'Wisata Pantai',
                'location_city' => 'Balikpapan',
                'ticket_price' => 10000,
                'opening_hours' => '06.00–18.00',
                'description' => 'Destinasi pantai Balikpapan dengan kawasan pasir dan ruang rekreasi bagi pengunjung.',
                'image' => null,
            ],
            [
                'name' => 'Kebun Raya Balikpapan',
                'category' => 'Wisata Alam',
                'location_city' => 'Balikpapan',
                'ticket_price' => 15000,
                'opening_hours' => '08.00-16.00',
                'description' => 'Kawasan konservasi tumbuhan yang dapat digunakan untuk wisata alam dan edukasi keanekaragaman hayati.',
                'image' => null,
            ],
            [
                'name' => 'Penangkaran Buaya Teritip',
                'category' => 'Wisata Alam',
                'location_city' => 'Balikpapan',
                'ticket_price' => 20000,
                'opening_hours' => 'Setiap hari 08.00–17.00',
                'description' => 'Tempat wisata edukasi yang memperkenalkan satwa buaya dan kegiatan pemeliharaannya di kawasan Teritip.',
                'image' => null,
            ],
            [
                'name' => 'Mangrove Center Graha Indah',
                'category' => 'Hutan Lindung & Ekowisata',
                'location_city' => 'Balikpapan',
                'ticket_price' => 15000,
                'opening_hours' => '08.00-17.00',
                'description' => 'Kawasan ekowisata mangrove yang mengenalkan ekosistem pesisir dan pentingnya hutan mangrove.',
                'image' => null,
            ],

            // BONTANG (4 Destinasi)
            [
                'name' => 'Pulau Beras Basah',
                'category' => 'Wisata Bahari',
                'location_city' => 'Bontang',
                'ticket_price' => 600000,
                'opening_hours' => '24 jam',
                'description' => 'Destinasi wisata bahari di wilayah Bontang yang menawarkan suasana pulau, laut, dan kegiatan wisata air. (Tiket kapal penyeberangan Rp600.000–Rp1.500.000).',
                'image' => null,
            ],
            [
                'name' => 'Bontang Kuala',
                'category' => 'Budaya & Sejarah',
                'location_city' => 'Bontang',
                'ticket_price' => 5000,
                'opening_hours' => '24 jam',
                'description' => 'Kawasan permukiman pesisir di atas air yang memiliki karakter kehidupan masyarakat lokal dan menjadi daya tarik wisata.',
                'image' => null,
            ],
            [
                'name' => 'Mangrove Bontang',
                'category' => 'Hutan Lindung & Ekowisata',
                'location_city' => 'Bontang',
                'ticket_price' => 20000,
                'opening_hours' => 'Senin-Kamis & Sabtu-Minggu 08.00-17.00; Jumat 14.00-17.00',
                'description' => 'Kawasan mangrove yang dapat digunakan sebagai wisata edukasi lingkungan dan pengenalan ekosistem pesisir.',
                'image' => null,
            ],
            [
                'name' => 'Taman Nasional Kutai – Akses Bontang',
                'category' => 'Hutan Lindung & Ekowisata',
                'location_city' => 'Bontang',
                'ticket_price' => 5000,
                'opening_hours' => '05.30-17.00',
                'description' => 'Kawasan konservasi yang memiliki keanekaragaman hayati dan dapat menjadi tujuan wisata alam dari wilayah Bontang.',
                'image' => null,
            ],

            // BERAU (4 Destinasi)
            [
                'name' => 'Pulau Derawan',
                'category' => 'Wisata Bahari',
                'location_city' => 'Berau',
                'ticket_price' => 125000,
                'opening_hours' => '09.00–18.00',
                'description' => 'Destinasi wisata bahari di Kepulauan Derawan yang menawarkan pantai, laut, dan berbagai aktivitas wisata bahari.',
                'image' => null,
            ],
            [
                'name' => 'Pulau Maratua',
                'category' => 'Wisata Bahari',
                'location_city' => 'Berau',
                'ticket_price' => 310000,
                'opening_hours' => '09.00–21.00',
                'description' => 'Pulau wisata bahari di Kabupaten Berau yang terkenal dengan panorama laut, pantai, dan aktivitas wisata air.',
                'image' => null,
            ],
            [
                'name' => 'Pulau Kakaban',
                'category' => 'Wisata Bahari',
                'location_city' => 'Berau',
                'ticket_price' => 25000,
                'opening_hours' => '08.00–16.00',
                'description' => 'Pulau wisata bahari yang memiliki Danau Kakaban dan habitat ubur-ubur serta lingkungan laut yang menarik.',
                'image' => null,
            ],
            [
                'name' => 'Danau Labuan Cermin',
                'category' => 'Wisata Alam',
                'location_city' => 'Berau',
                'ticket_price' => 100000,
                'opening_hours' => '08.00–17.00',
                'description' => 'Danau di Biduk-Biduk yang dikenal karena kejernihan air dan karakteristik perairannya.',
                'image' => null,
            ],

            // KUTAI KARTANEGARA (4 Destinasi)
            [
                'name' => 'Museum Mulawarman',
                'category' => 'Budaya & Sejarah',
                'location_city' => 'Kutai Kartanegara',
                'ticket_price' => 10000,
                'opening_hours' => 'Senin–Kamis 09.00–15.00; Jumat 09.00–11.30; Sabtu–Minggu 09.00–15.00',
                'description' => 'Museum sejarah di Tenggarong yang menyimpan koleksi berkaitan dengan Kesultanan Kutai Kartanegara dan budaya daerah.',
                'image' => null,
            ],
            [
                'name' => 'Keraton Kesultanan Kutai Kartanegara',
                'category' => 'Budaya & Sejarah',
                'location_city' => 'Kutai Kartanegara',
                'ticket_price' => 0,
                'opening_hours' => '24 jam',
                'description' => 'Kawasan bersejarah yang memperkenalkan peninggalan dan sejarah Kesultanan Kutai Kartanegara.',
                'image' => null,
            ],
            [
                'name' => 'Pulau Kumala',
                'category' => 'Rekreasi Keluarga',
                'location_city' => 'Kutai Kartanegara',
                'ticket_price' => 15000,
                'opening_hours' => '08.00–18.00',
                'description' => 'Kawasan rekreasi di Tenggarong yang berada di tengah Sungai Mahakam dan menawarkan area wisata keluarga.',
                'image' => null,
            ],
            [
                'name' => 'Bukit Bangkirai',
                'category' => 'Hutan Lindung & Ekowisata',
                'location_city' => 'Kutai Kartanegara',
                'ticket_price' => 35000,
                'opening_hours' => '09.00-16.00',
                'description' => 'Kawasan hutan tropis yang menawarkan pengalaman wisata alam dan ekowisata di Kutai Kartanegara.',
                'image' => null,
            ],

            // KUTAI TIMUR (4 Destinasi)
            [
                'name' => 'Taman Nasional Kutai',
                'category' => 'Hutan Lindung & Ekowisata',
                'location_city' => 'Kutai Timur',
                'ticket_price' => 0,
                'opening_hours' => '05.30–17.00 (informasi lokasi; perlu cek ulang)',
                'description' => 'Kawasan konservasi dengan keanekaragaman hayati yang menjadi salah satu tujuan wisata alam Kalimantan Timur.',
                'image' => null,
            ],
            [
                'name' => 'Hutan Lindung Wehea',
                'category' => 'Hutan Lindung & Ekowisata',
                'location_city' => 'Kutai Timur',
                'ticket_price' => 250000,
                'opening_hours' => 'Belum tercantum secara resmi',
                'description' => 'Kawasan hutan konservasi di Kutai Timur yang memiliki keanekaragaman flora dan fauna serta potensi ekowisata.',
                'image' => null,
            ],
            [
                'name' => 'Pantai Teluk Lombok',
                'category' => 'Wisata Pantai',
                'location_city' => 'Kutai Timur',
                'ticket_price' => 0,
                'opening_hours' => '24 jam',
                'description' => 'Destinasi pesisir di Kutai Timur yang menawarkan suasana pantai dan kegiatan wisata air serta memancing.',
                'image' => null,
            ],
            [
                'name' => 'Gua Mengkuris',
                'category' => 'Hutan Lindung & Ekowisata',
                'location_city' => 'Kutai Timur',
                'ticket_price' => 0,
                'opening_hours' => 'Belum tercantum secara resmi',
                'description' => 'Kawasan bentang alam karst yang memiliki potensi wisata alam, gua, dan nilai konservasi di Kutai Timur.',
                'image' => null,
            ],

            // KUTAI BARAT (4 Destinasi)
            [
                'name' => 'Danau Jempang',
                'category' => 'Wisata Alam',
                'location_city' => 'Kutai Barat',
                'ticket_price' => 15000,
                'opening_hours' => '24 jam',
                'description' => 'Danau besar di Kutai Barat yang menawarkan panorama perairan dan potensi wisata alam serta budaya masyarakat sekitar.',
                'image' => null,
            ],
            [
                'name' => 'Tanjung Isuy',
                'category' => 'Budaya & Sejarah',
                'location_city' => 'Kutai Barat',
                'ticket_price' => 0,
                'opening_hours' => '24 jam',
                'description' => 'Kawasan yang dikenal dengan budaya masyarakat Dayak dan kehidupan lokal di sekitar Danau Jempang.',
                'image' => null,
            ],
            [
                'name' => 'Lamin Eheng',
                'category' => 'Budaya & Sejarah',
                'location_city' => 'Kutai Barat',
                'ticket_price' => 0,
                'opening_hours' => '08.00-17.00',
                'description' => 'Rumah panjang tradisional yang menjadi daya tarik budaya dan memperlihatkan arsitektur serta kehidupan masyarakat Dayak.',
                'image' => null,
            ],
            [
                'name' => 'Cagar Alam Kersik Luway',
                'category' => 'Hutan Lindung & Ekowisata',
                'location_city' => 'Kutai Barat',
                'ticket_price' => 10000,
                'opening_hours' => 'Setiap hari 08.00–16.00',
                'description' => 'Kawasan konservasi dan wisata alam yang memiliki lingkungan hutan serta tumbuhan khas Kalimantan Timur.',
                'image' => null,
            ],

            // PASER (4 Destinasi)
            [
                'name' => 'Gunung Embun',
                'category' => 'Wisata Alam',
                'location_city' => 'Paser',
                'ticket_price' => 5000,
                'opening_hours' => '24 jam (akses lokasi; waktu pemandangan embun terbaik pagi hari)',
                'description' => 'Destinasi wisata alam di Paser yang terkenal dengan suasana perbukitan dan pemandangan embun pada pagi hari.',
                'image' => null,
            ],
            [
                'name' => 'Goa Tengkorak',
                'category' => 'Wisata Alam',
                'location_city' => 'Paser',
                'ticket_price' => 5000,
                'opening_hours' => '24 jam',
                'description' => 'Destinasi wisata alam berupa kawasan gua yang menjadi salah satu daya tarik wisata Kabupaten Paser.',
                'image' => null,
            ],
            [
                'name' => 'Pantai Pasir Mayang',
                'category' => 'Wisata Pantai',
                'location_city' => 'Paser',
                'ticket_price' => 10000,
                'opening_hours' => '24 jam',
                'description' => 'Destinasi wisata pesisir di Kabupaten Paser yang menawarkan suasana pantai dan pemandangan laut.',
                'image' => null,
            ],
            [
                'name' => 'Desa Wisata Klempang Sari',
                'category' => 'Hutan Lindung & Ekowisata',
                'location_city' => 'Paser',
                'ticket_price' => 10000,
                'opening_hours' => '08.00-17.30',
                'description' => 'Desa wisata berbasis masyarakat yang dapat menjadi tempat mengenal lingkungan dan kehidupan lokal di Kabupaten Paser.',
                'image' => null,
            ],

            // PENAJAM PASER UTARA (4 Destinasi)
            [
                'name' => 'Gua Tolu Liang',
                'category' => 'Wisata Alam',
                'location_city' => 'Penajam Paser Utara',
                'ticket_price' => 5000,
                'opening_hours' => 'Belum tercantum secara resmi',
                'description' => 'Destinasi wisata alam di Penajam Paser Utara yang memiliki potensi wisata berbasis bentang alam dan lingkungan.',
                'image' => null,
            ],
            [
                'name' => 'Pantai Nipah-Nipah',
                'category' => 'Wisata Pantai',
                'location_city' => 'Penajam Paser Utara',
                'ticket_price' => 10000,
                'opening_hours' => '24 jam',
                'description' => 'Kawasan wisata pantai di Penajam Paser Utara yang menawarkan pemandangan pesisir dan suasana rekreasi.',
                'image' => null,
            ],
            [
                'name' => 'Pantai Tanjung Jumlai',
                'category' => 'Wisata Pantai',
                'location_city' => 'Penajam Paser Utara',
                'ticket_price' => 10000,
                'opening_hours' => 'Setiap hari 10.00–17.00',
                'description' => 'Destinasi wisata pesisir di Penajam Paser Utara yang menawarkan suasana pantai dan aktivitas rekreasi air.',
                'image' => null,
            ],
            [
                'name' => 'Pantai Corong',
                'category' => 'Wisata Pantai',
                'location_city' => 'Penajam Paser Utara',
                'ticket_price' => 10000,
                'opening_hours' => '24 jam',
                'description' => 'Kawasan wisata pesisir yang dapat digunakan untuk menikmati pemandangan laut dan suasana pantai di PPU.',
                'image' => null,
            ],

            // MAHAKAM ULU (4 Destinasi)
            [
                'name' => 'Air Terjun Jantur Inar',
                'category' => 'Wisata Alam',
                'location_city' => 'Mahakam Ulu',
                'ticket_price' => 0,
                'opening_hours' => 'Belum tercantum secara resmi',
                'description' => 'Air terjun di Mahakam Ulu yang menawarkan pemandangan alam dan suasana lingkungan yang masih alami.',
                'image' => null,
            ],
            [
                'name' => 'Kampung Long Bagun',
                'category' => 'Budaya & Sejarah',
                'location_city' => 'Mahakam Ulu',
                'ticket_price' => 0,
                'opening_hours' => 'Belum tercantum secara resmi',
                'description' => 'Kawasan kampung di Mahakam Ulu yang dapat menjadi bagian dari wisata budaya dan pengenalan kehidupan masyarakat lokal.',
                'image' => null,
            ],
            [
                'name' => 'Kampung Lutan',
                'category' => 'Budaya & Sejarah',
                'location_city' => 'Mahakam Ulu',
                'ticket_price' => 0,
                'opening_hours' => 'Belum tercantum secara resmi',
                'description' => 'Kampung yang dapat menjadi tujuan wisata untuk mengenal budaya, tradisi, dan kehidupan masyarakat Mahakam Ulu.',
                'image' => null,
            ],
            [
                'name' => 'Lamin Adat Dayak',
                'category' => 'Budaya & Sejarah',
                'location_city' => 'Mahakam Ulu',
                'ticket_price' => 0,
                'opening_hours' => 'Belum tercantum secara resmi',
                'description' => 'Bangunan adat yang dapat menjadi daya tarik wisata budaya dan memperkenalkan tradisi masyarakat Dayak di Mahakam Ulu.',
                'image' => null,
            ],
        ];

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        foreach ($destinations as $dest) {
            Destination::create([
                'name' => $dest['name'],
                'slug' => Str::slug($dest['name']),
                'category' => $dest['category'],
                'location_city' => $dest['location_city'],
                'ticket_price' => $dest['ticket_price'],
                'description' => $dest['description'],
                'opening_hours' => $dest['opening_hours'],
                'image' => $dest['image'],
            ]);
        }

        // 2. Kuliner Khas Kalimantan Timur
        $culinaries = [
            [
                'name' => 'Nasi Bekepor',
                'origin_city' => 'Kutai Kartanegara',
                'price_range' => 'Rp 25.000 - Rp 45.000',
                'description' => 'Kuliner warisan Kesultanan Kutai Kartanegara berupa nasi liwet beraroma rempah kemangi, cabai, dan ikan asin, disajikan bersama sayur gangan asam kukang dan daging masak bumi hangus.',
                'recommended_spot' => 'Warung Nasi Bekepor Selera Raja, Tenggarong',
                'image' => null,
            ],
            [
                'name' => 'Amplang Kuku Macan',
                'origin_city' => 'Samarinda',
                'price_range' => 'Rp 30.000 - Rp 100.000',
                'description' => 'Kerupuk gurih renyah berbahan dasar ikan pipih (belida) atau ikan tenggiri segar dengan bentuk melengkung mirip kuku harimau/macan. Menjadi buah tangan nomor satu Kaltim.',
                'recommended_spot' => 'Pusat Oleh-Oleh Citra Niaga Samarinda',
                'image' => null,
            ],
            [
                'name' => 'Ayam Cincane',
                'origin_city' => 'Samarinda',
                'price_range' => 'Rp 35.000 - Rp 70.000',
                'description' => 'Ayam kampung bakar khas Kalimantan Timur dengan bumbu merah pekat perpaduan santan, cabai merah, lengkuas, asam jawa, dan terasi bakar yang meresap hingga serat tulang.',
                'recommended_spot' => 'Restoran Torani & Depot Cincane Tepian Samarinda',
                'image' => null,
            ],
            [
                'name' => 'Pisang Gapit',
                'origin_city' => 'Balikpapan',
                'price_range' => 'Rp 15.000 - Rp 25.000',
                'description' => 'Pisang kepok setengah matang yang dijepit (gapit) pipih kemudian dipanggang di atas bara arang, lalu disiram saus kuah kental gula merah aren dan santan durian.',
                'recommended_spot' => 'Kawasan Kuliner Lapangan Merdeka Balikpapan',
                'image' => null,
            ],
        ];

        foreach ($culinaries as $culinary) {
            Culinary::create($culinary);
        }

        // 3. Event Budaya & Pariwisata
        $events = [
            [
                'event_name' => 'Festival Adat Erau Pelas Benua',
                'location' => 'Stadion Rondong Demang & Keraton Kutai, Tenggarong',
                'start_date' => '2026-09-20',
                'end_date' => '2026-09-28',
                'organizer' => 'Kesultanan Kutai Kartanegara & Dispar Kukar',
                'description' => 'Upacara sakral adat budaya tertua di Nusantara yang telah diadakan sejak abad ke-13, menampilkan prosesi Mendirikan Ayu, Bepelas, Belimbur air berkah, hingga Mengulur Naga ke Kutai Lama.',
            ],
            [
                'event_name' => 'Balikpapan Fest 2026',
                'location' => 'BSCC Dome Balikpapan',
                'start_date' => '2026-10-15',
                'end_date' => '2026-10-18',
                'organizer' => 'Dinas Pemuda Olahraga dan Pariwisata Balikpapan',
                'description' => 'Pesta industri kreatif dan pariwisata terakbar dengan parade busana etnik modern Kalimantan, pameran UMKM Nusantara, konser musik pesisir, serta festival kopi borneo.',
            ],
            [
                'event_name' => 'Festival Mahakam 2026',
                'location' => 'Tepian Sungai Mahakam, Samarinda',
                'start_date' => '2026-11-06',
                'end_date' => '2026-11-08',
                'organizer' => 'Pemerintah Kota Samarinda',
                'description' => 'Perayaan pesona Sungai Mahakam dengan lomba balap perahu naga, parade kapal hias berlampu warna-warni, tari massal Dayak pesisir, serta bazar kuliner tradisional.',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }

        // 4. Ulasan Pengunjung
        $reviews = [
            [
                'visitor_name' => 'Dimas Prasetyo',
                'destination_visited' => 'Kepulauan Derawan',
                'rating' => 5,
                'review_text' => 'Pengalaman diving terindah seumur hidup! Bisa berenang bebas bersama penyu laut raksasa dan melihat indahnya laguna Maratua. Wajib dikunjungi minimal sekali seumur hidup.',
                'visit_date' => '2026-08-12',
            ],
            [
                'visitor_name' => 'Siti Nurhaliza',
                'destination_visited' => 'Danau Labuan Cermin',
                'rating' => 5,
                'review_text' => 'Airnya sungguh sebening kaca! Benar-benar bisa merasakan perbedaan lapisan air tawar di atas dan asin di bawah. Perjalanan darat yang panjang terbayar lunas seketika.',
                'visit_date' => '2026-07-25',
            ],
            [
                'visitor_name' => 'Rahmat Hidayat',
                'destination_visited' => 'Bukit Bangkirai',
                'rating' => 4,
                'review_text' => 'Sensasi berjalan di canopy bridge goyang di ketinggian 30 meter sangat memacu adrenalin! Udaranya sejuk dan hutannya sangat asri terjaga.',
                'visit_date' => '2026-09-02',
            ],
            [
                'visitor_name' => 'Clarissa Tan',
                'destination_visited' => 'Desa Budaya Pampang',
                'rating' => 5,
                'review_text' => 'Tarian Dayak Kenyah di Lamin sangat memukau dan kaya makna. Warganya sangat ramah menyambut wisatawan. Jangan lupa berfoto mengenakan baju adat tradisional.',
                'visit_date' => '2026-08-30',
            ],
        ];

        foreach ($reviews as $review) {
            VisitorReview::create($review);
        }
    }
}
