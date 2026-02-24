# ⚡ Quick Setup Guide (Ringkas)

Instruksi cepat untuk setup project di komputer baru.

## 🚀 5 Langkah Utama

### 1. Clone & Masuk Folder
```bash
git clone https://github.com/USERNAME/proyek_lsp.git
cd proyek_lsp
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Environment (.env)
```bash
copy .env.example .env
php artisan key:generate
```

**Edit `.env` untuk database:**
```env
DB_DATABASE=proyek_lsp
DB_USERNAME=root
DB_PASSWORD=          # (kosongkan jika default)
```

### 4. Setup Database
```bash
# Buat database (di HeidiSQL/phpMyAdmin atau via command):
mysql -u root -e "CREATE DATABASE proyek_lsp;"

# Jalankan migrations:
php artisan migrate

# (Opsional) Seed test data:
php artisan db:seed
```

### 5. Jalankan Server
```bash
php artisan serve
```

Buka: **http://localhost:8000**

---

## 🔑 Test Account

Jika sudah `php artisan db:seed`:

**Admin:**
- Email: `admin@perpustakaan.local`
- Pass: `password123`

**Student:**
- Email: `siswa@perpustakaan.local`
- Pass: `password123`

---

## ❓ Jika Error

| Error | Solusi |
|-------|--------|
| Database error | Cek `.env` DB credentials |
| Port 8000 in use | `php artisan serve --port=8001` |
| CSRF token error | `php artisan config:clear` |
| Key not generated | `php artisan key:generate` |

---

📖 **Lihat [SETUP.md](SETUP.md) untuk panduan lengkap**
