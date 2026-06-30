<div align="center">

# 🌸 Arven Parfum — Modified

**Platform E-Commerce Parfum Modern Berbasis Laravel**

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![Vite](https://img.shields.io/badge/Vite-7.x-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

</div>

---

> [!WARNING]
> **⚠️ DISCLAIMER — HANYA UNTUK LATIHAN**
>
> Proyek ini dibuat **hanya untuk keperluan latihan dan pembelajaran** pemrograman web.
> - ❌ Tidak ditujukan untuk transaksi uang sungguhan.
> - ❌ Jangan memasukkan data kartu kredit atau akun bank asli.
> - Sistem pembayaran pada proyek ini menggunakan **simulasi payment gateway** (bukan integrasi asli Midtrans).

> [!NOTE]
> **🎨 DISCLAIMER — DESAIN UI**
>
> Desain antarmuka (UI/UX) pada proyek ini terinspirasi dari dan menggunakan pendekatan visual gaya **[Nike.com](https://www.nike.com)** (Nike MD Design Language) — termasuk penggunaan tipografi bold, layout minimalis berwarna hitam-putih, dan micro-animation. Proyek ini bukan produk resmi Nike dan tidak berafiliasi dengan Nike Inc. dalam bentuk apapun.

---

## 📸 Dokumentasi Tampilan Website

### 🏠 Beranda

![Beranda](Dokumentasi%20Arven%20Parfum/Beranda.png)

---

### 🗂️ Katalog Koleksi

![Katalog](Dokumentasi%20Arven%20Parfum/Katalog.png)

---

### ℹ️ Tentang Kami

![About](Dokumentasi%20Arven%20Parfum/About.png)

---

### 📬 Kontak

![Contact](Dokumentasi%20Arven%20Parfum/Contact.png)

---

### 🧾 Riwayat Pesanan (Checkout)

![Checkouts](Dokumentasi%20Arven%20Parfum/Checkouts.png)

---

### 🛠️ Panel Admin

![Panel Admin](Dokumentasi%20Arven%20Parfum/Panel%20Admin.png)

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Tech Stack](#-tech-stack)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi & Setup](#-instalasi--setup)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Panduan Penggunaan](#-panduan-penggunaan)

---

## 🎯 Tentang Proyek

**Arven Parfum — Modified** adalah pengembangan lanjutan dari proyek *Arven Parfum* yang dibangun sebagai bahan latihan full-stack development menggunakan ekosistem Laravel modern.

Versi ini menambahkan berbagai fitur baru seperti simulasi payment gateway yang lebih realistis, manajemen stok, profil pengguna, sistem lupa password, panel admin CRUD lengkap, dan sistem autentikasi terpisah antara admin dan pelanggan.

---

## ✨ Fitur Utama

### 🛍️ Fitur Pelanggan
- **Beranda & Katalog** — Tampilan produk berdasarkan brand
- **Keranjang Belanja** — Tambah, ubah jumlah, hapus produk (berbasis `localStorage`)
- **Validasi Stok** — Tidak bisa memesan melebihi stok yang tersedia
- **Checkout & Simulasi Pembayaran** — Alur `pending → processing → paid` dengan animasi loading
- **Riwayat Pesanan** — Histori transaksi setelah login
- **Profil User** — Edit nama, email, dan password
- **Lupa Password** — Reset password via simulasi link

### 🔐 Autentikasi & Keamanan
- **Dua Pintu Login Terpisah** — Halaman login berbeda untuk Admin dan User
- **Rate Limiting** — Proteksi brute-force (maks 5 percobaan/menit)
- **Role-Based Access** — Middleware terpisah untuk `user` dan `admin`

### 🛠️ Panel Admin (`/arven-panel`)
- **Dashboard** — Ringkasan data pesanan dan pelanggan
- **Kelola Produk & Stok** — CRUD produk beserta manajemen stok
- **Kelola Brand** — CRUD brand parfum
- **Kelola Pesanan** — Lihat dan update status pesanan
- **Kelola Pelanggan** — Lihat data dan toggle status aktif pengguna
- **Pesan Kontak** — Baca dan kelola pesan dari form kontak

### 💳 Simulasi Payment Gateway
- Arsitektur `PaymentService` + `PaymentGatewayInterface` + `SimulatorGateway`
- Siap di-switch ke gateway asli (Midtrans) tanpa mengubah struktur Controller
- Status pembayaran: `pending` → `processing` → `paid` / `failed`

---

## 🧰 Tech Stack

| Kategori | Teknologi |
|---|---|
| **Framework Backend** | Laravel 12.x |
| **Bahasa** | PHP 8.2+ |
| **Frontend** | Vanilla CSS + JavaScript |
| **Build Tool** | Vite 7.x |
| **Database** | SQLite (development) |
| **Auth** | Laravel Built-in Authentication |

---

## ⚙️ Persyaratan Sistem

- **PHP** >= 8.2
- **Composer** >= 2.x
- **Node.js** >= 18.x & **NPM** >= 9.x
- **Git**

---

## 🚀 Instalasi & Setup

### 1. Clone Repository

```bash
git clone https://github.com/EkaRizqiRomadhon/Arven-Parfum-Modified.git
cd Arven-Parfum-Modified
```

### 2. Install Dependensi

```bash
composer install
npm install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Jalankan Migrasi

```bash
php artisan migrate
```

### 5. Build Frontend

```bash
npm run build
```

---

## ▶️ Menjalankan Aplikasi

```bash
php artisan serve
```

Akses di: **http://localhost:8000**

> Untuk pengembangan aktif dengan hot-reload, jalankan `npm run dev` di terminal terpisah.

---

## 📖 Panduan Penggunaan

### URL Halaman Utama

| URL | Deskripsi |
|---|---|
| `/` | Beranda |
| `/koleksi` | Katalog semua parfum |
| `/koleksi/{brand}` | Produk per brand |
| `/cart` | Keranjang belanja |
| `/contact` | Halaman kontak |
| `/profile` | Profil user (perlu login) |
| `/checkout/history` | Riwayat pesanan (perlu login) |
| `/forgot-password` | Reset password |

### URL Admin Panel

| URL | Deskripsi |
|---|---|
| `/arven-panel/login` | Login admin (terpisah dari user) |
| `/arven-panel/dashboard` | Dashboard admin |
| `/arven-panel/products` | Kelola produk & stok |
| `/arven-panel/brands` | Kelola brand |
| `/arven-panel/orders` | Kelola pesanan |
| `/arven-panel/customers` | Kelola pelanggan |

### Membuat Akun Admin

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'full_name' => 'Administrator',
    'email'     => 'admin@arvenparfum.com',
    'password'  => bcrypt('password123'),
    'role'      => 'admin',
    'is_active' => true,
]);
```

---

<div align="center">

Dibuat untuk keperluan **Latihan & Pembelajaran** ❤️

**[⬆ Kembali ke Atas](#-arven-parfum--modified)**

</div>
