# 📚 Panduan Setup Project Library Management System

Panduan ini untuk membantu teman Anda untuk setup project di komputer mereka.

## 📋 Prasyarat

Pastikan sudah terinstall di komputer:
- **Git** → [Download](https://git-scm.com/)
- **PHP 8.2+** → Atau gunakan **Laragon** (recommended) → [Download](https://laragon.org/)
- **Composer** → [Download](https://getcomposer.org/) (jika tidak pakai Laragon)
- **MySQL/MariaDB** → Atau gunakan database dari Laragon/XAMPP

## 🚀 Langkah-Langkah Setup

### 1️⃣ Clone Repository dari GitHub

```bash
git clone https://github.com/USERNAME/proyek_lsp.git
cd proyek_lsp
```

Ganti `USERNAME` dengan username GitHub Anda.

---

### 2️⃣ Install Dependencies

Buka command prompt/terminal di folder project dan jalankan:

```bash
composer install
```

Tunggu hingga semua dependensi selesai diinstall (bisa memakan waktu beberapa menit).

---

### 3️⃣ Setup File Environment (.env)

```bash
# Copy file .env dari template
cp .env.example .env

# Atau jika menggunakan Windows (cmd):
copy .env.example .env
```

Atau jika menggunakan PowerShell:
```powershell
Copy-Item .env.example .env
```

---

### 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

---

### 5️⃣ Konfigurasi Database di File .env

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=proyek_lsp
DB_USERNAME=root
DB_PASSWORD=          # Kosongkan jika root tanpa password (default Laragon/XAMPP)
```

**Jika menggunakan Laragon:**
- DB_HOST: `127.0.0.1`
- DB_USERNAME: `root`
- DB_PASSWORD: kosongkan (atau sesuai setting Laragon Anda)

**Jika menggunakan XAMPP:**
- DB_HOST: `localhost`
- DB_USERNAME: `root`
- DB_PASSWORD: kosongkan

---

### 6️⃣ Buat Database

Buka HeidiSQL atau phpMyAdmin dan buat database baru:

```sql
CREATE DATABASE proyek_lsp;
```

Atau bisa menggunakan command line:

```bash
mysql -u root -e "CREATE DATABASE proyek_lsp;"
```

---

### 7️⃣ Jalankan Migrations

```bash
php artisan migrate
```

Ini akan membuat semua tabel di database.

---

### 8️⃣ Seed Database (Opsional - untuk test data)

```bash
php artisan db:seed
```

Ini akan memasukkan data test ke database. Setelah ini, Anda bisa login dengan:

**Akun Admin:**
- Email: `admin@perpustakaan.local`
- Password: `password123`

**Akun Siswa:**
- Email: `siswa@perpustakaan.local`
- Password: `password123`

---

### 9️⃣ Jalankan Development Server

```bash
php artisan serve
```

Laravel akan berjalan di: **http://127.0.0.1:8000**

---

## 🌐 Akses Aplikasi

Buka browser dan akses aplikasi:

```
http://localhost:8000
```

atau

```
http://127.0.0.1:8000
```

---

## 📊 Apa yang Bisa Dilakukan

### Admin Panel (`/admin`)
- ✅ Kelola Buku (Tambah, Edit, Hapus)
- ✅ Kelola Transaksi Peminjaman
- ✅ Kelola Data Member/Siswa
- ✅ Lihat Laporan

### Student Dashboard (`/student`)
- ✅ Lihat Buku yang Tersedia
- ✅ Pinjam Buku
- ✅ Lihat Buku yang Dipinjam
- ✅ Kembalikan Buku
- ✅ Lihat Dashboard Statistik

---

## 🆘 Troubleshooting

### Error: "PDOException: SQLSTATE[HY000] [1045] Access denied"
**Solusi:** Periksa konfigurasi database di file `.env`
- Username dan password pada database
- Host dan port database

### Error: "CSRF token mismatch"
**Solusi:** Jalankan:
```bash
php artisan config:clear
php artisan cache:clear
```

### Error: "No application encryption key has been defined"
**Solusi:** Jalankan:
```bash
php artisan key:generate
```

### Error: "The storage path does not exist"
**Solusi:** Jalankan:
```bash
php artisan storage:link
```

### Port 8000 sudah digunakan
**Solusi:** Gunakan port lain:
```bash
php artisan serve --port=8001
```

---

## 📁 Struktur Folder Penting

```
proyek_lsp/
├── app/               # Kode aplikasi (Controllers, Models, etc)
├── database/          # Migrations, Seeders
├── resources/         # Views (Blade templates)
├── routes/            # Routes (web.php)
├── public/            # Assets (CSS, JS, Images)
├── .env               # Konfigurasi environment (jangan commit!)
└── composer.json      # Dependencies
```

---

## ⚙️ Konfigurasi Tambahan (Opsional)

### Jika ingin mengubah nama database atau port:

1. Edit `.env` sesuai kebutuhan
2. Jalankan ulang migrations:
   ```bash
   php artisan migrate:fresh --seed
   ```

### Jika ingin menggunakan database berbeda:
Ubah connection di `.env` dari `mysql` ke `sqlite`, `pgsql`, dsb.

---

## 🔐 Catatan Keamanan

⚠️ **PENTING:** Jangan pernah commit file `.env` ke repository!

File `.env` sudah ada di `.gitignore`, tapi pastikan untuk:
1. Ubah `APP_KEY` dengan `php artisan key:generate`
2. Ubah password database jika di production
3. Set `APP_DEBUG=false` untuk production

---

## 📞 Bantuan

Jika ada masalah:
1. Periksa file `.env` sudah benar
2. Pastikan MySQL/Database berjalan
3. Cek error di `storage/logs/laravel.log`
4. Jalankan `php artisan config:clear && php artisan cache:clear`

---

**Selamat! Aplikasi siap digunakan! 🎉**
