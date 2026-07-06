# LebakKab Portal - Backend Aggregator API

LebakKab Backend adalah sistem API pusat dan *dashboard* manajemen (agregator) untuk portal website Kabupaten Lebak. Sistem ini bertindak sebagai pusat kendali (*hub*) *multi-tenant* yang mengelola data dari berbagai Organisasi Perangkat Daerah (OPD) atau Dinas secara terpusat.

## Fitur Utama
- **Arsitektur Multi-tenant:** Data difilter dan dikelola secara otomatis per OPD (menggunakan *trait* `FiltersByOpd`), memungkinkan setiap Dinas memiliki kontennya masing-masing tanpa tercampur.
- **Admin Panel:** Dibangun menggunakan [FilamentPHP](https://filamentphp.com/) untuk pengelolaan berita, *banner*, pengaturan, dan dokumen yang cepat dan mudah.
- **S3 Object Storage (MinIO):** Penyimpanan media (gambar/PDF) tidak lagi membebani server utama, melainkan dipindahkan ke MinIO yang bertindak sebagai CDN dan *Object Storage* ala Enterprise S3.
- **Performa Tinggi & API Ready:** Dirancang untuk melayani ratusan *request* bersamaan dari berbagai website *frontend* dengan batas *rate-limit* yang ditingkatkan, konfigurasi CORS global, dan integrasi **Redis** sebagai *Caching Layer*.
- **Infrastruktur Terkontainer (Docker):** Seluruh ekosistem (Nginx, PHP-FPM, MySQL, Redis, dan MinIO) terbungkus rapi dalam `docker-compose.yml` untuk kemudahan *deployment*.

## Teknologi yang Digunakan (Tech Stack)
- **Framework:** PHP 8.2 / Laravel 10
- **Database:** MySQL 8.0
- **Cache:** Redis
- **Storage:** MinIO (S3-compatible object storage)
- **Server:** Nginx
- **Infrastruktur:** Docker & Docker Compose

## Panduan Instalasi (Local Development)

### Persyaratan Sistem
- Docker dan Docker Compose

### Langkah Instalasi
1. Clone repositori:
   ```bash
   git clone https://github.com/moriuz123/lebakkab-backend.git
   cd lebakkab-backend
   ```
2. Atur *Environment Variables*:
   ```bash
   cp .env.example .env
   ```
   Pastikan konfigurasi MinIO sudah terpasang dengan benar di file `.env`:
   ```env
   FILESYSTEM_DRIVER=s3
   AWS_ACCESS_KEY_ID=minioadmin
   AWS_SECRET_ACCESS_KEY=minioadmin
   AWS_DEFAULT_REGION=us-east-1
   AWS_BUCKET=lebakkab-media
   AWS_URL=http://localhost:9000/lebakkab-media
   AWS_ENDPOINT=http://minio:9000
   AWS_USE_PATH_STYLE_ENDPOINT=true

   # Konfigurasi Cache Redis
   CACHE_DRIVER=redis
   REDIS_CLIENT=predis
   REDIS_HOST=redis
   REDIS_PASSWORD=null
   REDIS_PORT=6379
   ```

   **Catatan MinIO & Filament**:
   - `AWS_ENDPOINT` menggunakan `minio:9000` (bukan `backend_minio`) karena AWS SDK menolak *hostname* yang mengandung karakter *underscore* (`_`).
   - File *temporary* unggahan Livewire pada form Filament disetel ke disk `local` (`config/livewire.php`) untuk menghindari *error infinite loading* saat *preview* gambar.

3. Jalankan *container* Docker:
   ```bash
   docker-compose up -d
   ```

4. Masuk ke *container* aplikasi dan jalankan instalasi *dependency*:
   ```bash
   docker exec -it backend_app bash
   composer install
   php artisan key:generate
   exit
   ```

5. Import Database Bawaan (Legacy):
   Sistem ini menggunakan gabungan tabel bawaan yang sudah ada dan tabel baru dari Laravel/Filament. Anda wajib mengimpor file `portal2.sql` terlebih dahulu sebelum menjalankan *migrate*:
   ```bash
   docker exec -i backend_mysql mysql -u root -proot db_portal < portal2.sql
   ```

6. Jalankan Migrasi & Seeder untuk Tabel Baru:
   Setelah database bawaan terimpor, masuk kembali ke *container* aplikasi untuk mengeksekusi migrasi tabel baru:
   ```bash
   docker exec -it backend_app bash
   php artisan migrate --seed
   ```

## Aturan Kontribusi (Workflow & Contributing)
Silakan merujuk pada file [CONTRIBUTING.md](CONTRIBUTING.md) untuk aturan detail pengembangan. Ringkasannya:
- Dilarang melakukan *push* langsung ke branch `main`.
- Pembuatan fitur atau perbaikan bug harus dilakukan di *branch* turunan dari `develop` (misal: `feature/...` atau `bugfix/...`).
- Ajukan *Pull Request* (PR) yang ditargetkan ke branch `develop`.

---
*Dikembangkan untuk Pemerintah Kabupaten Lebak.*
