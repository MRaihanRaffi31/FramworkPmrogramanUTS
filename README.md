# 🌴 Pesona Kaltim - Sistem Informasi Destinasi Wisata Kalimantan Timur

Aplikasi web portal pariwisata profesional berbasis **Laravel 12** dan **Tailwind CSS v4** yang menyajikan katalog destinasi wisata, kuliner khas, kalender event budaya, serta ulasan pengunjung di 10 Kabupaten/Kota Provinsi Kalimantan Timur.

> **Tugas Ujian Tengah Semester (UTS) Framework Pemrograman**  
> Semester 5 — Program Studi Teknik Informatika / Sistem Informasi

---

## 📸 Fitur Utama

1. **Katalog 40 Destinasi Wisata (4 per Kab/Kota)**:
    - Mencakup seluruh 10 wilayah Kalimantan Timur: _Samarinda, Balikpapan, Bontang, Berau, Kutai Kartanegara, Kutai Timur, Kutai Barat, Paser, Penajam Paser Utara, dan Mahakam Ulu_.
    - Filter ganda responsif: Filter Kategori Wisata dan Filter Kota/Kabupaten.
    - Fitur pencarian instan berdasarkan nama, kategori, atau lokasi.
2. **Operasi Data Penuh (BREAD - Browse, Read, Edit, Add, Delete)**:
    - CRUD lengkap untuk 4 entitas: Destinasi Wisata, Kuliner Khas, Event Budaya, dan Ulasan Pengunjung.
    - Dilengkapi validasi form request yang ketat dan notifikasi flash alert interaktif.
    - Konfirmasi dialog JavaScript sebelum menghapus data.
3. **Manajemen Upload Foto Lokal (`Storage`)**:
    - Mendukung upload file foto asli (JPG, PNG, JPEG, WEBP) disimpan ke `storage/app/public/destinations`.
    - Menggunakan facade `Storage` untuk penggantian file otomatis saat update dan pembersihan file fisik saat data dihapus.
    - Fitur _Live Preview_ saat memilih file gambar baru di form.
4. **Desain UI/UX Modern & Responsif**:
    - Tampilan bersih setara portal pariwisata profesional (_Wonderful Indonesia_ aesthetic).
    - Sticky navbar dengan drawer menu mobile hamburger untuk kenyamanan navigasi di smartphone/tablet.
    - Warna alam netral (slate/zinc) dipadu aksen deep emerald.

---

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend / Styling**: Tailwind CSS v4 via Vite
- **Database**: SQLite
- **Font**: Plus Jakarta Sans via Google Fonts

---

## 🚀 Panduan Menjalankan Proyek

### 1. Prasyarat Sistem

Pastikan laptop/komputer Anda sudah terpasang:

- PHP >= 8.2
- Composer
- Node.js & NPM
- Git

### 2. Kloning Repository

```bash
git clone <URL_REPOSITORY_ANDA>
cd destinasi_wisata
```

### 3. Instalasi Dependensi

```bash
composer install
npm install
```

### 4. Konfigurasi Environment (`.env`)

Salin file `.env.example` menjadi `.env` dan generate application key:

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Hubungkan Storage Link

Buat symlink dari folder storage publik ke folder public web:

```bash
php artisan storage:link
```

### 6. Kompilasi Aset Frontend

```bash
npm run build
```

### 7. Jalankan Server Lokal

```bash
php artisan serve
```

Akses web melalui browser di: **`http://127.0.0.1:8000`** (atau port yang tertera di terminal).

---

## 🧪 Menjalankan Automated Tests

Aplikasi dilengkapi dengan 18 unit & feature tests (78 assertions) untuk memastikan seluruh fitur BREAD dan upload file berjalan sempurna:

```bash
php artisan test
```

---

## 📂 Struktur Database

1. `destinations`: `id`, `name`, `slug`, `category`, `location_city`, `ticket_price`, `description`, `image`, `opening_hours`, `timestamps`.
2. `culinaries`: `id`, `name`, `origin_city`, `price_range`, `description`, `recommended_spot`, `image`, `timestamps`.
3. `events`: `id`, `event_name`, `location`, `start_date`, `end_date`, `organizer`, `description`, `timestamps`.
4. `visitor_reviews`: `id`, `visitor_name`, `destination_visited`, `rating`, `review_text`, `visit_date`, `timestamps`.

---

© 2026 Proyek UTS Framework Pemrograman — Pesona Wisata Kalimantan Timur.
