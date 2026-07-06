# LebakKab Portal - Backend Aggregator API

LebakKab Backend adalah sistem API pusat dan _dashboard_ manajemen (agregator) untuk portal website Kabupaten Lebak. Sistem ini bertindak sebagai pusat kendali (_hub_) _multi-tenant_ yang mengelola data dari berbagai Organisasi Perangkat Daerah (OPD) atau Dinas secara terpusat.

## Fitur Utama

- **Arsitektur Multi-tenant:** Data difilter dan dikelola secara otomatis per OPD (menggunakan _trait_ `FiltersByOpd`), memungkinkan setiap Dinas memiliki kontennya masing-masing tanpa tercampur.
- **Admin Panel:** Dibangun menggunakan [FilamentPHP](https://filamentphp.com/) untuk pengelolaan berita, _banner_, pengaturan, dan dokumen yang cepat dan mudah.
- **S3 Object Storage (MinIO):** Penyimpanan media (gambar/PDF) tidak lagi membebani server utama, melainkan dipindahkan ke MinIO yang bertindak sebagai CDN dan _Object Storage_ ala Enterprise S3.
- **Performa Tinggi & API Ready:** Dirancang untuk melayani ratusan _request_ bersamaan dari berbagai website _frontend_ dengan batas _rate-limit_ yang ditingkatkan, konfigurasi CORS global, dan integrasi **Redis** sebagai _Caching Layer_.
- **Infrastruktur Terkontainer (Docker):** Seluruh ekosistem (Nginx, PHP-FPM, MySQL, Redis, dan MinIO) terbungkus rapi dalam `docker-compose.yml` untuk kemudahan _deployment_.

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
2. Atur _Environment Variables_:

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
    - `AWS_ENDPOINT` menggunakan `minio:9000` (bukan `backend_minio`) karena AWS SDK menolak _hostname_ yang mengandung karakter _underscore_ (`_`).
    - File _temporary_ unggahan Livewire pada form Filament disetel ke disk `local` (`config/livewire.php`) untuk menghindari _error infinite loading_ saat _preview_ gambar.

3. Jalankan _container_ Docker:

    ```bash
    docker-compose up -d
    ```

4. Masuk ke _container_ aplikasi dan jalankan instalasi _dependency_:

    ```bash
    docker exec -it backend_app bash
    composer install
    php artisan key:generate
    exit
    ```

5. Import Database Bawaan (Legacy):
   Sistem ini menggunakan gabungan tabel bawaan yang sudah ada dan tabel baru dari Laravel/Filament. Anda wajib mengimpor file `portal2.sql` terlebih dahulu sebelum menjalankan _migrate_:

    ```bash
    docker exec -i backend_mysql mysql -u root -proot db_portal < portal2.sql
    ```

6. Jalankan Migrasi & Seeder untuk Tabel Baru:
   Setelah database bawaan terimpor, masuk kembali ke _container_ aplikasi untuk mengeksekusi migrasi tabel baru:
    ```bash
    docker exec -it backend_app bash
    php artisan migrate --seed
    ```

7. **Migrasi Data MinIO (Saat Berpindah Server / Local ke Production):**
   File-file gambar atau media yang ada di MinIO disimpan dalam *named volume* Docker dan **tidak masuk ke dalam repositori Git**. Saat Anda mengatur *environment* baru (seperti di server *production*), Anda harus mengimpor ulang data gambarnya. Terdapat dua pilihan cara:

   **Cara A: Import Manual via Dashboard (Paling Mudah)**
   - Di server lama, masuk ke MinIO Admin (`http://localhost:9001`), pilih menu *Object Browser*, buka *bucket* `lebakkab-media`, tandai semua folder/file, lalu klik **Download as Zip**. Ekstrak zip tersebut di komputer Anda.
   - Di server baru, buka MinIO Admin (`http://<IP_SERVER>:9001`), buat *bucket* `lebakkab-media` dan atur *Access Policy* menjadi **Public**.
   - Klik **Upload > Upload Folder** lalu unggah folder hasil ekstraksi tadi.

   **Cara B: Import Otomatis menggunakan MinIO Client (`mc`)**
   Jika dari komputer lama Anda bisa mengakses IP server baru secara langsung, gunakan *tool* terminal `mc`:
   ```bash
   # Tambahkan alias ke MinIO lama dan baru
   mc alias set minio_lama http://localhost:9000 minioadmin minioadmin
   mc alias set minio_baru http://<IP_SERVER_BARU>:9000 minioadmin minioadmin

   # Sinkronkan (copy otomatis) seluruh data dari bucket lama ke bucket baru
   mc mirror minio_lama/lebakkab-media minio_baru/lebakkab-media
   ```

## Aturan Kontribusi (Workflow & Contributing)

Silakan merujuk pada file [CONTRIBUTING.md](CONTRIBUTING.md) untuk aturan detail pengembangan. Ringkasannya:

- Dilarang melakukan _push_ langsung ke branch `main`.
- Pembuatan fitur atau perbaikan bug harus dilakukan di _branch_ turunan dari `develop` (misal: `feature/...` atau `bugfix/...`).
- Ajukan _Pull Request_ (PR) yang ditargetkan ke branch `develop`.

---

_Dikembangkan untuk Pemerintah Kabupaten Lebak._
