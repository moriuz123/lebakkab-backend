# 1. Penjelasan Arsitektur & Ekosistem Aplikasi Backend (LebakKab Portal)

Dokumen ini adalah panduan yang menjelaskan arsitektur sistem pengelola data (Backend). Portal LebakKab dirancang dengan arsitektur **Terdistribusi (Decoupled Architecture)** dan **Multi-tenant**.

## A. Peran Backend (`lebakkab-backend`)

- **Peran:** Otak dan sistem kendali dari seluruh portal. Bertugas sebagai Agregator API dan Panel Admin.
- **Teknologi Utama:** PHP 8.2, Laravel 10/11, FilamentPHP, MySQL, Redis.
- **Fungsi Khusus:** 
  - Mengelola input data (berita, dokumen, konfigurasi OPD, banner) via *dashboard* admin Filament yang aman.
  - Beroperasi *Headless*: Backend tidak merender halaman web HTML untuk publik secara langsung, melainkan berfungsi sebagai *Engine* yang merespon permintaan dari Frontend dengan mengirimkan data mentah berformat JSON (REST API).

## B. Arsitektur Multi-tenant (Agregator OPD)

- **Konsep Agregator:** Sistem ini dikembangkan agar bisa mengelola puluhan situs web Organisasi Perangkat Daerah (OPD) secara terpusat dari satu sumber kode (*single source of truth*).
- **Implementasi (Traits):** Menggunakan fitur `FiltersByOpd` dalam struktur kontroler Laravel. Mekanisme ini otomatis menyeleksi *query database* berdasarkan `opd_id`. Dampaknya, admin Dinas A hanya bisa mengelola berita Dinas A, dan API hanya akan merespon data yang relevan dengan domain yang sedang mengaksesnya.

## C. Infrastruktur & Ekosistem Docker

Sistem didesain untuk dijalankan secara seragam antara server *development* dan *production* menggunakan ekosistem Docker. Terdapat 5 wadah utama:

1. **`backend_app` (Laravel / PHP-FPM):** Memproses semua logika komputasi utama dan API.
2. **`backend_webserver` (Nginx):** *Reverse proxy* internal yang menerima lalu lintas web.
3. **`backend_mysql` (MySQL 8):** RDBMS yang menyimpan teks konten dan konfigurasi.
4. **`backend_redis` (Redis):** Mengurus proses antrian (*Queue*) dan menyimpan salinan sementara (*Cache*) hasil respons API yang berat agar beban MySQL berkurang.
5. **`backend_minio` (S3 Object Storage):** Menggantikan manajemen berkas konvensional Laravel. Semua media gambar, video, dan dokumen disimpan ke MinIO (kompatibel penuh dengan Amazon S3 AWS SDK). MinIO berdiri mandiri dan berperan melayani *streaming* media ke Frontend tanpa membebani server utama Laravel.
