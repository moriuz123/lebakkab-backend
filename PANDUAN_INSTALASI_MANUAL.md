# 📖 Panduan Instalasi Projek (Manual Import Database)

Panduan ini berisi langkah-langkah instalasi dan konfigurasi projek **lebakkab-backend** menggunakan skema **Import Database Manual** tanpa perlu menjalankan `php artisan migrate` atau `php artisan db:seed`.

---

## 🛠️ Persyaratan Sistem

- **Docker** & **Docker Compose**
- Git

---

## 🚀 Langkah-Langkah Instalasi

### 1. Clone Repositori
```bash
git clone https://github.com/moriuz123/lebakkab-backend.git
cd lebakkab-backend
```

### 2. Konfigurasi Environment (`.env`)
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```

Pastikan pengaturan database dan MinIO di `.env` sudah sesuai (Secara default sudah terkonfigurasi untuk Docker):
```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db_portal
DB_USERNAME=root
DB_PASSWORD=root

FILESYSTEM_DRIVER=s3
AWS_ACCESS_KEY_ID=minioadmin
AWS_SECRET_ACCESS_KEY=minioadmin
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=lebakkab-media
AWS_URL=http://localhost:9000/lebakkab-media
AWS_ENDPOINT=http://minio:9000
AWS_USE_PATH_STYLE_ENDPOINT=true
```

---

### 3. Jalankan Docker Container
Jalankan semua service (Laravel App, Nginx, MySQL, Redis, MinIO) menggunakan Docker Compose:
```bash
docker-compose up -d
```

---

### 4. Install Dependency & Generate Application Key
Masuk ke container aplikasi backend dan jalankan composer:
```bash
docker exec -it backend_app bash -c "composer install && php artisan key:generate"
```

---

### 5. Import Database Manual (`.sql`)
Impor file dump database utama (`db_portal_latest.sql`) ke dalam container MySQL `backend_mysql`:

#### 🔹 Jika Menggunakan Docker Terminal / CLI:
```bash
docker exec -i backend_mysql mysql -u root -proot db_portal < db_portal_latest.sql
```

#### 🔹 Jika Menggunakan GUI (phpMyAdmin / DBeaver / Navicat / TablePlus):
1. Connect ke MySQL host: `localhost`, port: `3307`, user: `root`, password: `root`.
2. Pilih database `db_portal`.
3. Pilih menu **Import** / **Run SQL Script** lalu jalankan file `db_portal_latest.sql`.

---

### 6. Selesai 🎉
Aplikasi backend dan admin panel Filament siap digunakan:
- **Backend API & Admin Panel:** [http://localhost:8000/admin](http://localhost:8000/admin)
- **MinIO Console (Object Storage):** [http://localhost:9001](http://localhost:9001) (User: `minioadmin` / Pass: `minioadmin`)

---

## ⚠️ Catatan Penting
* **Migrasi & Seeder:** File migration dan seeder telah dihapus dari repositori. **Jangan** pernah menjalankan `php artisan migrate:fresh` atau `php artisan db:seed` karena akan mengosongkan tabel.
* **Membuat Backup Baru:** Kapan pun Anda ingin membuat backup database terbaru, jalankan perintah:
  ```bash
  docker exec backend_mysql mysqldump -u root -proot db_portal > db_portal_latest.sql
  ```
