<div align="center">

# 🌸 Arven Parfum

**Platform E-Commerce Parfum Modern Berbasis Laravel**

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-7.x-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

> Toko parfum online yang elegan dengan pengalaman belanja yang mulus, dilengkapi sistem autentikasi pengguna, keranjang belanja interaktif, dan integrasi pembayaran Midtrans.

</div>

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Tech Stack](#-tech-stack)
- [Struktur Proyek](#-struktur-proyek)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi & Setup](#-instalasi--setup)
- [Konfigurasi Environment](#-konfigurasi-environment)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Panduan Penggunaan](#-panduan-penggunaan)
- [Kontribusi](#-kontribusi)
- [Lisensi](#-lisensi)

---

## 🎯 Tentang Proyek

**Arven Parfum** adalah aplikasi e-commerce yang dibangun khusus untuk penjualan parfum premium. Platform ini menggabungkan desain antarmuka yang elegan dengan fungsionalitas back-end yang solid, memberikan pengalaman belanja yang menyenangkan bagi pelanggan sekaligus kemudahan pengelolaan bagi administrator.

Proyek ini dibangun sebagai portfolio pengembangan web full-stack menggunakan ekosistem Laravel modern.

---

## ✨ Fitur Utama

### 🛍️ Fitur Pelanggan
- **Halaman Beranda** — Tampilan produk unggulan dan koleksi terbaru
- **Katalog Koleksi** — Jelajahi parfum berdasarkan brand/kategori
- **Keranjang Belanja** — Tambah, ubah jumlah, dan hapus produk secara dinamis (berbasis `localStorage`)
- **Checkout & Pembayaran** — Proses checkout dengan integrasi Midtrans (mode simulasi tersedia)
- **Riwayat Pesanan** — Lihat histori transaksi setelah login
- **Halaman Kontak** — Form pengiriman pesan langsung ke sistem

### 🔐 Autentikasi & Keamanan
- **Registrasi & Login** — Sistem auth lengkap dengan validasi form
- **Rate Limiting** — Proteksi brute-force (maks 5 percobaan/menit per IP)
- **Activity Log** — Setiap aksi login, register, dan logout tercatat otomatis
- **Role-Based Access** — Peran `user` dan `admin` dengan middleware terpisah
- **Session Security** — Regenerasi token sesi setiap login/logout

### 🛠️ Panel Admin
- **Dashboard Admin** — Ringkasan data transaksi dan aktivitas pengguna
- **Akses Terbatas** — Hanya dapat diakses oleh akun dengan role `admin`

---

## 🧰 Tech Stack

| Kategori | Teknologi |
|---|---|
| **Framework Backend** | Laravel 12.x |
| **Bahasa** | PHP 8.2+ |
| **Frontend CSS** | Tailwind CSS 4.x |
| **Build Tool** | Vite 7.x |
| **Database** | SQLite (development) / MySQL (production) |
| **Payment Gateway** | Midtrans PHP SDK |
| **Auth** | Laravel Built-in Authentication |
| **Testing** | PHPUnit 11.x |
| **Dev Tools** | Laravel Sail, Laravel Pail, Laravel Pint |

---

## 📁 Struktur Proyek

```
arven-parfum/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php       # Login, Register, Logout
│   │   │   ├── CheckoutController.php   # Proses & riwayat checkout
│   │   │   ├── ContactController.php    # Kirim pesan kontak
│   │   │   └── AdminController.php      # Dashboard admin
│   │   └── Middleware/
│   ├── Models/
│   │   ├── User.php                     # Model pengguna dengan role & activity
│   │   ├── Checkout.php                 # Model transaksi checkout
│   │   ├── CheckoutItem.php             # Item detail per transaksi
│   │   ├── ContactMessage.php           # Pesan dari form kontak
│   │   └── ActivityLog.php              # Log aktivitas pengguna
│   └── Services/
│       └── AuthService.php              # Service layer untuk auth & logging
├── database/
│   └── migrations/                      # Semua schema tabel database
├── public/
│   ├── css/                             # Stylesheet halaman spesifik
│   ├── img/                             # Asset gambar produk & UI
│   └── brand/                           # Asset gambar per brand parfum
├── resources/
│   └── views/                           # Blade templates (halaman & komponen)
├── routes/
│   └── web.php                          # Definisi semua route aplikasi
└── vite.config.js                       # Konfigurasi build frontend
```

---

## ⚙️ Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut sebelum instalasi:

- **PHP** >= 8.2 dengan ekstensi: `pdo`, `pdo_sqlite` (atau `pdo_mysql`), `mbstring`, `openssl`, `tokenizer`, `xml`
- **Composer** >= 2.x
- **Node.js** >= 18.x & **NPM** >= 9.x
- **Git**

---

## 🚀 Instalasi & Setup

### 1. Clone Repository

```bash
git clone https://github.com/EkaRizqiRomadhon/arvenparfume.git
cd arvenparfume
```

### 2. Setup Otomatis (Direkomendasikan)

Gunakan script setup yang sudah tersedia:

```bash
composer run setup
```

Perintah ini akan secara otomatis:
- Menginstal semua dependensi PHP (`composer install`)
- Menyalin file `.env.example` → `.env`
- Membuat application key (`artisan key:generate`)
- Menjalankan migrasi database (`artisan migrate`)
- Menginstal dependensi Node.js (`npm install`)
- Mem-build asset frontend (`npm run build`)

### 3. Setup Manual (Alternatif)

Jika ingin melakukan setup step-by-step:

```bash
# Instal dependensi PHP
composer install

# Salin file environment
cp .env.example .env

# Generate application key
php artisan key:generate

# Jalankan migrasi database
php artisan migrate

# Instal dependensi Node.js
npm install

# Build asset frontend
npm run build
```

---

## 🔧 Konfigurasi Environment

Buka file `.env` dan sesuaikan konfigurasi berikut:

```env
# Nama & URL Aplikasi
APP_NAME="Arven Parfum"
APP_URL=http://localhost:8000

# Database (SQLite untuk development)
DB_CONNECTION=sqlite
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=arven_parfum
# DB_USERNAME=root
# DB_PASSWORD=

# Midtrans Payment Gateway
MIDTRANS_SERVER_KEY=your_server_key_here
MIDTRANS_CLIENT_KEY=your_client_key_here
MIDTRANS_IS_PRODUCTION=false
```

> **Catatan:** Untuk mode development/simulasi, integrasi Midtrans tidak memerlukan API key yang valid. Transaksi akan tersimpan dengan status `simulation`.

---

## ▶️ Menjalankan Aplikasi

### Mode Development (Semua Service Sekaligus)

```bash
composer run dev
```

Perintah ini menjalankan secara paralel:
- `php artisan serve` — Web server di `http://localhost:8000`
- `npm run dev` — Vite HMR untuk hot-reload frontend
- `php artisan queue:listen` — Worker untuk job queue
- `php artisan pail` — Real-time log viewer

### Mode Produksi

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan serve
```

---

## 📖 Panduan Penggunaan

### Akses Halaman Utama

| URL | Deskripsi |
|---|---|
| `/` | Beranda utama |
| `/koleksi` | Katalog semua parfum |
| `/koleksi/{brand}` | Produk per brand (contoh: `/koleksi/hermes`) |
| `/cart` | Keranjang belanja |
| `/contact` | Halaman kontak |
| `/about` | Tentang Arven Parfum |

### Autentikasi

| URL | Deskripsi |
|---|---|
| `/register` | Daftar akun baru |
| `/login` | Masuk ke akun |
| `/checkout/history` | Riwayat pesanan (perlu login) |

### Panel Admin

| URL | Deskripsi |
|---|---|
| `/admin/dashboard` | Dashboard admin (perlu login + role admin) |

### Membuat Akun Admin

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'full_name' => 'Administrator',
    'email'     => 'admin@arvenparfum.com',
    'password'  => 'password123',
    'role'      => 'admin',
    'is_active' => true,
]);
```

---

## 🧪 Menjalankan Test

```bash
# Jalankan semua test
composer run test

# Atau langsung via artisan
php artisan test
```

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Berikut langkah-langkahnya:

1. **Fork** repository ini
2. Buat **branch** fitur baru: `git checkout -b feature/nama-fitur`
3. **Commit** perubahan: `git commit -m 'feat: tambahkan fitur X'`
4. **Push** ke branch: `git push origin feature/nama-fitur`
5. Buat **Pull Request**

### Konvensi Commit

Gunakan format [Conventional Commits](https://www.conventionalcommits.org/):

```
feat: menambahkan fitur baru
fix: memperbaiki bug
docs: memperbarui dokumentasi
style: perubahan format/style kode
refactor: refactoring kode
test: menambahkan atau memperbarui test
```

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

---

<div align="center">

Dibuat dengan ❤️ menggunakan **Laravel** & **Tailwind CSS**

**[⬆ Kembali ke Atas](#-arven-parfum)**

</div>
