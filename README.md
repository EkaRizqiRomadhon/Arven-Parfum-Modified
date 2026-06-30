<div align="center">

# 🌸 Arven Parfum

**Platform E-Commerce Parfum Modern Berbasis Laravel**

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-7.x-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

> Toko parfum online yang elegan dengan pengalaman belanja yang mulus, dilengkapi sistem autentikasi pengguna, keranjang belanja interaktif, dan integrasi simulasi pembayaran.

</div>

---

> [!WARNING]
> **DISCLAIMER / PENGINGAT:**
> Proyek Arven Parfum ini dibuat **HANYA UNTUK KEPERLUAN LATIHAN DAN PEMBELAJARAN**. Aplikasi ini menggunakan simulasi payment gateway dan tidak ditujukan untuk memproses transaksi uang sungguhan. Jangan menggunakan data kartu kredit atau akun bank asli saat menguji fitur pembayaran di website ini.

---

## 📸 Dokumentasi Tampilan Website

<!-- SILAKAN TARUH SCREENSHOT TAMPILAN WEBSITE ANDA DI BAWAH INI -->

*(Tambahkan gambar/screenshot tampilan halaman Beranda, Koleksi, Keranjang, dan Simulasi Payment Gateway Anda di sini)*

```markdown
<!-- Contoh Format Menambahkan Gambar -->
![Halaman Beranda](/path/to/screenshot-beranda.png)
![Halaman Simulasi Pembayaran](/path/to/screenshot-payment.png)
```

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

---

## 🎯 Tentang Proyek

**Arven Parfum** adalah aplikasi e-commerce yang dibangun khusus untuk penjualan parfum premium. Platform ini menggabungkan desain antarmuka yang elegan dengan fungsionalitas back-end yang solid, memberikan pengalaman belanja yang menyenangkan bagi pelanggan sekaligus kemudahan pengelolaan bagi administrator.

Proyek ini dibangun sebagai portfolio pengembangan web full-stack menggunakan ekosistem Laravel modern.

---

## ✨ Fitur Utama

### 🛍️ Fitur Pelanggan
- **Halaman Beranda** — Tampilan produk unggulan dan koleksi terbaru
- **Katalog Koleksi** — Jelajahi parfum berdasarkan brand/kategori
- **Keranjang Belanja** — Tambah, ubah jumlah, dan hapus produk (berbasis `localStorage`)
- **Stok Terintegrasi** — Validasi otomatis yang tidak mengizinkan pesanan melebihi stok yang ada
- **Checkout & Pembayaran** — Proses checkout simulasi ala *Nike MD style* (pending -> processing -> paid)
- **Riwayat Pesanan** — Lihat histori transaksi setelah login
- **Profil User** — Pelanggan dapat mengubah data diri dan password
- **Halaman Kontak** — Form pengiriman pesan langsung ke sistem

### 🔐 Autentikasi & Keamanan
- **Registrasi & Login** — Sistem auth lengkap dengan validasi form
- **Lupa Password** — Sistem simulasi reset password tanpa perlu setting email SMTP sungguhan
- **Rate Limiting** — Proteksi brute-force (maks 5 percobaan/menit per IP)
- **Role-Based Access** — Peran `user` dan `admin` dengan middleware terpisah

### 🛠️ Panel Admin
- **Dashboard Admin** — Ringkasan data transaksi dan aktivitas pengguna
- **Kelola Produk & Brand** — Menambah produk, edit stok, deskripsi, dan gambar
- **Akses Terbatas** — Hanya dapat diakses oleh akun dengan role `admin`

---

## 🧰 Tech Stack

| Kategori | Teknologi |
|---|---|
| **Framework Backend** | Laravel |
| **Bahasa** | PHP 8.2+ |
| **Frontend CSS** | Vanilla CSS / CSS Modules |
| **Build Tool** | Vite |
| **Database** | SQLite (development) |
| **Auth** | Laravel Built-in Authentication |

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

---

## 🔧 Konfigurasi Environment

Buka file `.env` dan sesuaikan konfigurasi berikut:

```env
# Nama & URL Aplikasi
APP_NAME="Arven Parfum"
APP_URL=http://localhost:8000

# Database (SQLite untuk development)
DB_CONNECTION=sqlite
```

---

## ▶️ Menjalankan Aplikasi

### Mode Development (Semua Service Sekaligus)

```bash
composer run dev
```

Perintah ini menjalankan secara paralel:
- `php artisan serve` — Web server di `http://localhost:8000`
- `npm run dev` — Vite HMR untuk hot-reload frontend

---

<div align="center">

Dibuat untuk keperluan Latihan Pembelajaran. ❤️ **Laravel** & **Arven Parfume**

**[⬆ Kembali ke Atas](#-arven-parfum)**

</div>
