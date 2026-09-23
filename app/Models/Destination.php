<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Destination extends Model
{
    use HasFactory;

    /**
     * Daftar kategori destinasi wisata standar Kalimantan Timur
     */
    public const CATEGORIES = [
        'Wisata Bahari',
        'Wisata Alam',
        'Budaya & Sejarah',
        'Hutan Lindung & Ekowisata',
        'Wisata Pantai',
        'Rekreasi Keluarga',
        'Wisata Religi',
        'Wisata Kuliner',
    ];

    /**
     * Daftar kota/kabupaten di Kalimantan Timur
     */
    public const CITIES = [
        'Samarinda',
        'Balikpapan',
        'Kutai Kartanegara',
        'Berau',
        'Bontang',
        'Kutai Barat',
        'Kutai Timur',
        'Penajam Paser Utara',
        'Paser',
        'Mahakam Ulu',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'category',
        'location_city',
        'ticket_price',
        'description',
        'image',
        'opening_hours',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'ticket_price' => 'integer',
        ];
    }

    /**
     * Mengambil teks harga tiket yang rapi (Gratis, Belum tercantum, atau nominal Rp).
     */
    public function getTicketPriceDisplayAttribute(): string
    {
        $unspecified = [
            'Taman Nasional Kutai',
            'Gua Mengkuris',
            'Air Terjun Jantur Inar',
            'Kampung Long Bagun',
            'Kampung Lutan',
            'Lamin Adat Dayak',
        ];

        if (in_array($this->name, $unspecified)) {
            return 'Belum tercantum';
        }

        if ($this->ticket_price == 0) {
            return 'Gratis';
        }

        return 'Rp ' . number_format($this->ticket_price, 0, ',', '.');
    }

    /**
     * Mengambil URL gambar: mengembalikan file storage lokal publik jika ada,
     * atau null jika belum diunggah agar pengguna dapat mengunggah foto sendiri.
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return Storage::url($this->image);
        }

        return null;
    }
}
