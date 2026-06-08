# ASAT Parking (Sistem Manajemen Parkir)

[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-%5E8.2-blue.svg)](https://php.net)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

ASAT Parking adalah sistem manajemen parkir modern yang dirancang untuk mengelola lokasi parkir, tipe kendaraan, transaksi masuk/keluar kendaraan, serta pelaporan keuangan dan statistik parkir secara efisien.

Repository ini terdiri dari dua komponen utama:
1. **`parkir/`**: Aplikasi backend & frontend utama yang dibangun menggunakan framework **Laravel 12**.
2. **`soft-ui-dashboard-main/`**: Template admin interface **Soft UI Dashboard** yang digunakan sebagai referensi desain dashboard.

---

## 📸 Preview
![Preview](parkir.png)

---

## 🚀 Fitur Utama

- 📍 **Manajemen Lokasi Parkir (CRUD)**: Kelola data area parkir, kapasitas maksimal, dan sisa slot parkir yang tersedia secara real-time.
- 🚗 **Manajemen Tipe Kendaraan (CRUD)**: Kelola tipe kendaraan (motor, mobil, truk, dll.) beserta tarif parkir per jam.
- 💳 **Transaksi Parkir**:
  - **Kendaraan Masuk (Check-in)**: Pembuatan karcis parkir dengan generator ID unik.
  - **Kendaraan Keluar (Check-out)**: Penghitungan otomatis biaya parkir berdasarkan durasi waktu parkir dan tarif tipe kendaraan.
  - **Pencarian Tiket (Lookup)**: Pencarian cepat status kendaraan di dalam area parkir.
- 📊 **Pelaporan & Ekspor**:
  - Laporan pendapatan per lokasi parkir.
  - Laporan riwayat transaksi detail.
  - Unduh laporan dalam format **PDF** menggunakan integrasi `barryvdh/laravel-dompdf`.

---

## 🛠️ Tech Stack

- **Backend / Core**: [Laravel 12](https://laravel.com)
- **Language**: PHP ^8.2
- **Database**: SQLite (default) / MySQL
- **CSS Framework**: Bootstrap (Soft UI Dashboard Theme)
- **PDF Exporter**: [Laravel DomPDF](https://github.com/barryvdh/laravel-dompdf)

---

## ⚙️ Cara Instalasi & Penggunaan

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi di komputer lokal Anda:

### 1. Prasyarat (Prerequisites)
Pastikan Anda sudah menginstal:
* PHP >= 8.2
* Composer
* Node.js & NPM
* Web Server (seperti XAMPP / Laragon)

### 2. Setup Project
Masuk ke direktori `parkir` dan jalankan script setup otomatis:

```bash
cd parkir
composer run setup
```

*Catatan: Script di atas akan otomatis menjalankan `composer install`, menyalin file `.env`, membuat application key, menjalankan database migration, menjalankan `npm install`, dan mem-build asset production.*

### 3. Menjalankan Server Pengembangan (Dev Server)
Untuk menjalankan aplikasi secara lokal dengan *hot reload* asset (Vite) dan server Laravel:

```bash
composer run dev
```

Aplikasi Anda akan berjalan dan dapat diakses di browser melalui alamat **`http://127.0.0.1:8000`**.

---

## 📂 Struktur Folder
* `/parkir` - Source code utama aplikasi Laravel.
* `/soft-ui-dashboard-main` - Template interface dasar dashboard.
* `/parkir.png` - Tangkapan layar dari aplikasi.
