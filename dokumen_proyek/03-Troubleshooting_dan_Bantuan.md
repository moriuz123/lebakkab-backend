# 3. Bantuan & Pemecahan Masalah (Troubleshooting) Backend

Berikut adalah solusi atas berbagai ralat (error) yang sering terjadi dalam pengelolaan Backend Laravel maupun ekosistem Docker.

---

## Masalah 1: Error 500 (Internal Server Error) Saat Mengakses API / Web
**Penyebab Umum:**
Biasanya terjadi saat baru pertama diinstal, disebabkan hilangnya *APP_KEY* pada `.env` atau otentikasi koneksi basis data gagal.

**Solusi:**
1. Pantau *log* internal Laravel:
   `docker exec backend_app tail -f storage/logs/laravel.log`
2. Jika terdeteksi masalah *encryption key*, ciptakan *key* baru:
   `docker exec backend_app php artisan key:generate`
3. Jika *log* berisi pesan seperti "Access denied for user 'root'", tinjau nilai `DB_PASSWORD` di dalam `.env`, pastikan konsisten dengan variabel sandi milik MySQL di dalam file `docker-compose.yml`.

---

## Masalah 2: Error "CORS (Cross-Origin Resource Sharing)" di Frontend
**Penyebab Umum:**
Aplikasi Frontend mencoba memanggil API Backend, namun URL domain/IP frontend tersebut belum masuk daftar "tamu diizinkan" (Allowed Origins) di konfigurasi keamanan Laravel.

**Solusi:**
1. Masuk ke *repository* backend. Buka file konfigurasi `config/cors.php`.
2. Pada bagian baris `'allowed_origins'`, input secara spesifik URL web tempat frontend berjalan (contoh: `http://namadinas.lebakkab.go.id`).
3. *(Awas: URL tidak boleh diakhiri karakter *slash* (`/`))*
4. Hapus *cache* konfigurasi yang mengendap:
   `docker exec backend_app php artisan config:clear`

---

## Masalah 3: Data Error 429 (Too Many Requests) / Rate Limit
**Penyebab Umum:**
SPA Vue melakukan panggilan data (API) secara paralel dalam jumlah masif sehingga memicu deteksi perlindungan *Rate Limit* bawaan dari Laravel (umumnya batas 60 request/menit).

**Solusi:**
Ubah batas limit pada file `app/Providers/RouteServiceProvider.php`:
```php
RateLimiter::for('api', function (Request $request) {
    // Ubah 1000 jadi angka lebih besar jika trafik sangat padat
    return Limit::perMinute(1000)->by($request->user()?->id ?: $request->ip());
});
```

---

## Masalah 4: Gambar Infografis atau Lampiran Berkas Gagal Ditampilkan
**Penyebab Umum:**
- MinIO merespon dengan Error 403 (Terlarang) akibat perijinan *Bucket* yang ketat.
- Variabel koneksi AWS/S3 URL di `.env` Laravel diarahkan ke jaringan lokal (*localhost*) padahal diakses publik.

**Solusi:**
1. Validasi nilai `AWS_URL` pada `.env` agar menunjuk ke IP atau Domain publik Server MinIO. (Lalu eksekusi pembersihan *cache*: `docker exec backend_app php artisan config:clear`).
2. Masuk ke halaman administratif MinIO Console (`http://<IP_SERVER>:9001`). 
3. Cari menu navigasi **Buckets**, pilih `lebakkab-media`. Pada dasbor *Summary*, set status kolom **Access Policy** dari *Private* menjadi aturan **Public** (atau **Download**).
