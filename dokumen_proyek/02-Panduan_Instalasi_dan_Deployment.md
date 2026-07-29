# 2. Panduan Instalasi dan Deployment Backend

Dokumen ini menjelaskan proses instalasi dan migrasi (*deploy*) Backend (Laravel) beserta *services* ekosistemnya (Database & Storage) ke server yang baru.

---

## A. Aturan Dasar Instalasi

1. **Folder `vendor/`**: DILARANG disalin langsung antar perangkat. Anda harus me-*rebuild* pustaka menggunakan Composer.
2. **File `.env`**: Selalu buat salinan baru dari `.env.example` karena `.env` berisi *password* yang spesifik per *server*.
3. **Data Base MySQL & MinIO (S3)**: Jangan memindah folder Docker-nya secara manual. Gunakan `mysqldump` untuk basis data dan fitur "Download as Zip" atau `mc mirror` untuk media S3.

---

## B. Proses Deployment ke Server

### Langkah 1: Kloning Repositori
Masuk ke terminal server Anda, lalu *clone* kodenya:
```bash
git clone https://github.com/moriuz123/lebakkab-backend.git
cd lebakkab-backend
```

### Langkah 2: Setup `.env`
Duplikat template env:
```bash
cp .env.example .env
```
Sesuaikan parameter absolut berikut:
```env
APP_ENV=production          # Wajib production di server asli
APP_DEBUG=false             # Wajib false demi keamanan
APP_URL=http://<IP_SERVER_ANDA>

# Database (Sinkronisasi dengan docker-compose.yml)
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db_portal
DB_USERNAME=root
DB_PASSWORD=root_password_disini

# Redis Config
CACHE_DRIVER=redis
REDIS_CLIENT=predis
REDIS_HOST=redis
REDIS_PASSWORD=null

# Konfigurasi Storage MinIO (Wajib)
FILESYSTEM_DRIVER=s3
AWS_ACCESS_KEY_ID=minioadmin
AWS_SECRET_ACCESS_KEY=minioadmin
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=lebakkab-media
AWS_URL=http://<IP_SERVER_ANDA>:9000/lebakkab-media   # Ganti IP sesuai server
AWS_ENDPOINT=http://minio:9000                        # Jangan dirubah, routing internal Docker
AWS_USE_PATH_STYLE_ENDPOINT=true
```

*(Jika preview media di Filament lambat/error, pastikan variabel config Livewire `temporary_file_upload.disk` diarahkan ke `'local'`)*.

### Langkah 3: Eksekusi Docker & Migrasi Tabel
Jalankan infrastruktur keseluruhan:
```bash
docker-compose up -d
```
Jika Anda memindahkan server, *Import* *database* lama Anda terlebih dahulu:
```bash
docker exec -i backend_mysql mysql -u root -p<password_root> db_portal < backup_lama.sql
```
Setelah itu, lakukan kompilasi *vendor* dan sinkronisasi struktur:
```bash
docker exec -it backend_app bash
composer install --optimize-autoloader --no-dev
php artisan key:generate
php artisan migrate --force --seed
exit
```

### Langkah 4: Sinkronisasi Aset Media (MinIO)
Aset di MinIO harus diisi ulang karena merupakan *persistent volume*:
1. **Cara UI:** Buka `http://<IP_SERVER>:9001` (login default admin: minioadmin / minioadmin). Buat bucket bernama `lebakkab-media`. Ubah *Access Policy* ke **Public**. Upload semua gambar/pdf (zip) lama Anda ke dalam bucket tersebut.
2. **Cara CLI:** Gunakan klien `mc mirror` S3 dari server lama Anda untuk menembakkan (*push*) data langsung ke `http://<IP_SERVER>:9000`.
