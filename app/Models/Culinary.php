<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Culinary extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'origin_city',
        'price_range',
        'description',
        'recommended_spot',
        'image',
    ];

    /**
     * Mengambil URL foto: mengembalikan file storage lokal publik jika ada,
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
