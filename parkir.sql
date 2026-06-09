-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 09 Jun 2026 pada 13.04
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `max_motorcycle` int(11) NOT NULL,
  `max_car` int(11) NOT NULL,
  `max_other` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `locations`
--

INSERT INTO `locations` (`id`, `location_name`, `max_motorcycle`, `max_car`, `max_other`, `created_at`, `updated_at`) VALUES
(1, 'Lantai 1', 100, 50, 10, '2026-06-07 17:52:12', '2026-06-07 17:52:12'),
(2, 'Lantai 2', 150, 0, 0, '2026-06-07 17:52:12', '2026-06-07 17:52:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_08_000001_create_vehicle_types_table', 2),
(5, '2026_06_08_000002_create_locations_table', 2),
(6, '2026_06_08_000003_create_transactions_table', 2),
(7, '2026_06_08_100000_create_parkir_tables', 3),
(8, '2026_06_08_133000_make_no_polisi_nullable_in_parkir_transactions_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `parkir_locations`
--

CREATE TABLE `parkir_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `max_motorcycle` int(11) NOT NULL,
  `max_car` int(11) NOT NULL,
  `max_other` int(11) NOT NULL,
  `available_motorcycle` int(11) NOT NULL,
  `available_car` int(11) NOT NULL,
  `available_other` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `parkir_locations`
--

INSERT INTO `parkir_locations` (`id`, `location_name`, `max_motorcycle`, `max_car`, `max_other`, `available_motorcycle`, `available_car`, `available_other`, `created_at`, `updated_at`) VALUES
(1, 'Gedung b', 4, 2, 2, 4, 2, 2, '2026-06-07 19:47:18', '2026-06-08 11:16:10'),
(2, 'Gedung a', 9, 5, 11, 9, 5, 11, '2026-06-07 21:19:53', '2026-06-08 11:04:01'),
(3, 'Gedung c', 5, 4, 1, 5, 4, 1, '2026-06-08 11:03:41', '2026-06-08 11:03:41'),
(4, 'Gedung d', 1, 1, 1, 1, 1, 1, '2026-06-08 11:09:06', '2026-06-08 11:09:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `parkir_transactions`
--

CREATE TABLE `parkir_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_lokasi` bigint(20) UNSIGNED NOT NULL,
  `no_tiket` varchar(255) NOT NULL,
  `no_polisi` varchar(255) DEFAULT NULL,
  `id_jenis` bigint(20) UNSIGNED NOT NULL,
  `masuk` datetime NOT NULL,
  `keluar` datetime DEFAULT NULL,
  `perjam_pertama` int(11) NOT NULL,
  `perjam_berikutnya` int(11) NOT NULL,
  `max_perhari` int(11) NOT NULL,
  `total_jam` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `parkir_transactions`
--

INSERT INTO `parkir_transactions` (`id`, `id_lokasi`, `no_tiket`, `no_polisi`, `id_jenis`, `masuk`, `keluar`, `perjam_pertama`, `perjam_berikutnya`, `max_perhari`, `total_jam`, `total_bayar`, `created_at`, `updated_at`) VALUES
(1, 1, '202606080642461', 'D 7777 FDW', 1, '2026-06-08 06:42:46', '2026-06-08 07:40:52', 2000, 1001, 10000, 58, 12000, '2026-06-07 23:42:46', '2026-06-08 00:40:52'),
(2, 2, '202606080726551', 'D 7777 FDW', 1, '2026-06-08 07:26:55', '2026-06-08 07:40:57', 3000, 2000, 10000, 14, 10000, '2026-06-08 00:26:55', '2026-06-08 00:40:57'),
(3, 1, '202606080742301', 'D 7777 FDW', 1, '2026-06-08 07:42:31', '2026-06-08 07:42:34', 3000, 2000, 10000, 1, 3000, '2026-06-08 00:42:31', '2026-06-08 00:42:34'),
(4, 1, '202606080742501', 'D 7777 FDW', 1, '2026-06-08 07:42:50', '2026-06-08 07:48:28', 3000, 2000, 10000, 6, 10000, '2026-06-08 00:42:50', '2026-06-08 00:48:28'),
(5, 1, '202606080748472', 'D 7777 FDW', 2, '2026-06-08 07:48:47', '2026-06-08 07:51:31', 5000, 3000, 25000, 3, 10201, '2026-06-08 00:48:47', '2026-06-08 00:51:31'),
(6, 2, '202606080754103', 'D 7777 FDW', 3, '2026-06-08 07:54:10', '2026-06-08 07:54:18', 10000, 5000, 50000, 1, 10000, '2026-06-08 00:54:10', '2026-06-08 00:54:18'),
(7, 1, '202606080756311', 'D 7777 FDW', 1, '2026-06-08 07:56:31', '2026-06-08 07:56:54', 3000, 2000, 10000, 1, 3000, '2026-06-08 00:56:31', '2026-06-08 00:56:54'),
(8, 2, '202606080804122', 'D 7777 FDW', 2, '2026-06-08 08:04:13', '2026-06-08 08:04:17', 5000, 3000, 25000, 1, 5000, '2026-06-08 01:04:13', '2026-06-08 01:04:17'),
(9, 1, '202606080809541', 'D 7777 FDW', 1, '2026-06-08 08:09:54', '2026-06-08 15:32:31', 3000, 2000, 10000, 8, 10000, '2026-06-08 01:09:54', '2026-06-08 08:32:31'),
(10, 1, '202606081532442', 'D 7777 FDW', 2, '2026-06-08 15:32:44', '2026-06-08 15:44:37', 5000, 3000, 25000, 1, 5000, '2026-06-08 08:32:44', '2026-06-08 08:44:37'),
(11, 1, '202606081544551', 'D 7777 FDW', 1, '2026-06-08 15:44:55', '2026-06-08 15:44:58', 3000, 2000, 10000, 1, 3000, '2026-06-08 08:44:55', '2026-06-08 08:44:58'),
(12, 1, '202606081550021', 'D 7777 FDW', 1, '2026-06-08 15:50:02', '2026-06-08 15:56:57', 3000, 2000, 10000, 1, 3000, '2026-06-08 08:50:02', '2026-06-08 08:56:57'),
(13, 1, '202606081557052', 'D 7777 FDW', 2, '2026-06-08 15:57:06', '2026-06-08 17:18:05', 5000, 3000, 25000, 2, 8000, '2026-06-08 08:57:06', '2026-06-08 10:18:05'),
(14, 1, '202606081711252', 'D 7779 FDW', 2, '2026-06-08 17:11:30', '2026-06-08 17:17:59', 5000, 3000, 25000, 1, 5000, '2026-06-08 10:11:30', '2026-06-08 10:17:59'),
(15, 1, '202606081722363', 'D 7777 FDW', 3, '2026-06-08 17:22:36', '2026-06-08 17:31:04', 10000, 5000, 50000, 1, 10000, '2026-06-08 10:22:36', '2026-06-08 10:31:04'),
(16, 1, '202606081812092', 'B 1234 ABC', 2, '2026-06-08 18:12:10', '2026-06-08 18:12:28', 5000, 3000, 25000, 1, 5000, '2026-06-08 11:12:10', '2026-06-08 11:12:28'),
(17, 1, '202606081813142', 'B 1234 ABC', 2, '2026-06-08 18:13:14', '2026-06-08 18:16:10', 5000, 3000, 25000, 1, 5000, '2026-06-08 11:13:14', '2026-06-08 11:16:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `parkir_vehicle_types`
--

CREATE TABLE `parkir_vehicle_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` enum('motorcycle','car','other') NOT NULL,
  `perjam_pertama` int(11) NOT NULL,
  `perjam_berikutnya` int(11) NOT NULL,
  `max_perhari` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `parkir_vehicle_types`
--

INSERT INTO `parkir_vehicle_types` (`id`, `jenis`, `perjam_pertama`, `perjam_berikutnya`, `max_perhari`, `created_at`, `updated_at`) VALUES
(1, 'motorcycle', 4000, 2000, 10000, '2026-06-07 20:55:03', '2026-06-08 11:18:14'),
(2, 'car', 5000, 3000, 25000, '2026-06-07 20:55:03', '2026-06-07 20:55:03'),
(3, 'other', 10000, 5000, 50000, '2026-06-07 20:55:03', '2026-06-07 20:55:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BfIty5hPvHwBCwRCYIu9v9TESMUUoNbR0wDculOP', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM0RJNFJES2JVYVRvRXBlVGc1aVJhSnJIeEdvRm9EN2QwcnFlRnVORiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFuc2FjdGlvbi9sb29rdXA/bm9fcG9saXNpPUIlMjAxMjM0JTIwQ0Qmbm9fdGlrZXQ9MjAyNjA2MDgwNjI2NTcxIjtzOjU6InJvdXRlIjtzOjE4OiJ0cmFuc2FjdGlvbi5sb29rdXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1780900337),
('IrKizPExoMsGxWDTG20DUlE33HJUktLXovzhy1Eo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiekJTdUYzUXkwUHc1dkNNM2FQYlhncG5FbHFvTlh2UXhyOGlSTW5xRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFuc2FjdGlvbi9sb29rdXA/bm9fdGlrZXQ9MjAyNjA2MDgwNzQyNTAxIjtzOjU6InJvdXRlIjtzOjE4OiJ0cmFuc2FjdGlvbi5sb29rdXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1780904612),
('pYafuhIagXGokzZofMf4GrsdYRnOFtjH9HSPJwIQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.0 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicTU4Um84NHcxdXJJalhXQ3AzYkloZ1Z4akxFd1Zobk9HWjdSc3ZoRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2NhdGlvbiI7czo1OiJyb3V0ZSI7czoxNDoibG9jYXRpb24uaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1780902719),
('Tc8tKzuJxTuNHdjfxB54IsLZn0NePwmj2t4TIwKu', NULL, '127.0.0.1', 'Symfony', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUU5Z2tUdzVXcWg1YUREZEtKQ1dCTm1lYVZRZ2lzMWNtekplcEhLYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjA6Imh0dHA6Ly9sb2NhbGhvc3QvdHJhbnNhY3Rpb24vbG9va3VwP25vX3Rpa2V0PTIwMjYwNjA4MDUwNjQ3MSI7czo1OiJyb3V0ZSI7czoxODoidHJhbnNhY3Rpb24ubG9va3VwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780898358),
('u47D97wT4LKDNBAgxrWbhJDimYJVqfgg5opClzvr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiazg0VktpOFhyWXpjbzFZWlNpcmllRmlBNllWY0QyTmdNVk1GSDRkYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFuc2FjdGlvbiI7czo1OiJyb3V0ZSI7czoxNzoidHJhbnNhY3Rpb24uaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1780902711),
('wS6296vbf6gi2BOUMbkF2ZZVTmCfUSHpnAAePveT', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHR2UXRvUmJCREt2eUxSclNLUnoybW5nb1RMQ2pFOURpNVd1eFBvViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFuc2FjdGlvbi9sb29rdXA/bm9fdGlrZXQ9MjAyNjA2MDgwNjI2NTcxIjtzOjU6InJvdXRlIjtzOjE4OiJ0cmFuc2FjdGlvbi5sb29rdXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1780900192);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_lokasi` bigint(20) UNSIGNED NOT NULL,
  `no_tiket` varchar(255) NOT NULL,
  `no_polisi` varchar(15) NOT NULL,
  `id_jenis` bigint(20) UNSIGNED NOT NULL,
  `masuk` datetime NOT NULL,
  `keluar` datetime DEFAULT NULL,
  `perjam_pertama` int(11) DEFAULT NULL,
  `perjam_berikutnya` int(11) DEFAULT NULL,
  `max_perhari` int(11) DEFAULT NULL,
  `total_jam` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` enum('motorcycle','car','other') NOT NULL,
  `perjam_pertama` int(11) NOT NULL,
  `perjam_berikutnya` int(11) NOT NULL,
  `max_perhari` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `jenis`, `perjam_pertama`, `perjam_berikutnya`, `max_perhari`, `created_at`, `updated_at`) VALUES
(1, 'motorcycle', 2000, 1000, 10000, '2026-06-07 17:52:12', '2026-06-07 17:52:12'),
(2, 'car', 5000, 3000, 30000, '2026-06-07 17:52:12', '2026-06-07 17:52:12'),
(3, 'other', 10000, 5000, 50000, '2026-06-07 17:52:12', '2026-06-07 17:52:12');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `parkir_locations`
--
ALTER TABLE `parkir_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `parkir_transactions`
--
ALTER TABLE `parkir_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parkir_transactions_no_tiket_unique` (`no_tiket`),
  ADD KEY `parkir_transactions_id_lokasi_foreign` (`id_lokasi`),
  ADD KEY `parkir_transactions_id_jenis_foreign` (`id_jenis`);

--
-- Indeks untuk tabel `parkir_vehicle_types`
--
ALTER TABLE `parkir_vehicle_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parkir_vehicle_types_jenis_unique` (`jenis`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transactions_locations` (`id_lokasi`),
  ADD KEY `fk_transactions_vehicle_types` (`id_jenis`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `parkir_locations`
--
ALTER TABLE `parkir_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `parkir_transactions`
--
ALTER TABLE `parkir_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `parkir_vehicle_types`
--
ALTER TABLE `parkir_vehicle_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `parkir_transactions`
--
ALTER TABLE `parkir_transactions`
  ADD CONSTRAINT `parkir_transactions_id_jenis_foreign` FOREIGN KEY (`id_jenis`) REFERENCES `parkir_vehicle_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parkir_transactions_id_lokasi_foreign` FOREIGN KEY (`id_lokasi`) REFERENCES `parkir_locations` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transactions_locations` FOREIGN KEY (`id_lokasi`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transactions_vehicle_types` FOREIGN KEY (`id_jenis`) REFERENCES `vehicle_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
