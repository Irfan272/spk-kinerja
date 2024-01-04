-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jul 2023 pada 05.25
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_kinerja`
--

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
-- Struktur dari tabel `kriterias`
--

CREATE TABLE `kriterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_kriteria` varchar(255) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `bobot` int(11) NOT NULL,
  `normalisasi` decimal(5,2) DEFAULT NULL,
  `jenis_kriteria` enum('benefit','cost') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kriterias`
--

INSERT INTO `kriterias` (`id`, `kd_kriteria`, `nama_kriteria`, `bobot`, `normalisasi`, `jenis_kriteria`, `created_at`, `updated_at`) VALUES
(1, 'C1', 'Kedisiplinan', 15, '0.15', 'benefit', '2023-07-23 19:11:51', '2023-07-23 19:11:51'),
(2, 'C2', 'Kerjasama', 10, '0.10', 'benefit', '2023-07-23 19:12:05', '2023-07-23 19:12:05'),
(3, 'C3', 'Sikap', 25, '0.25', 'benefit', '2023-07-23 19:12:18', '2023-07-23 19:12:18'),
(4, 'C4', 'Kehadiran', 10, '0.10', 'benefit', '2023-07-23 19:12:44', '2023-07-23 19:12:44'),
(5, 'C5', 'Keahlian', 35, '0.35', 'benefit', '2023-07-23 19:12:55', '2023-07-23 19:12:55'),
(6, 'C6', 'Loyalitas', 5, '0.05', 'benefit', '2023-07-23 19:13:09', '2023-07-23 19:13:09');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_06_07_173555_create_kriterias_table', 1),
(6, '2023_06_07_173611_create_sub_kriterias_table', 1),
(7, '2023_06_07_174842_create_pegawais_table', 1),
(8, '2023_06_07_175140_create_penilaians_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_pegawai` varchar(255) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pegawais`
--

INSERT INTO `pegawais` (`id`, `kd_pegawai`, `nama_pegawai`, `created_at`, `updated_at`) VALUES
(1, 'P1', 'Fariz', '2023-07-23 20:19:57', '2023-07-23 20:19:57'),
(2, 'P2', 'Irfan', '2023-07-23 20:20:01', '2023-07-23 20:20:01'),
(3, 'P3', 'Fiya', '2023-07-23 20:20:09', '2023-07-23 20:20:09'),
(4, 'P4', 'daus', '2023-07-23 20:23:13', '2023-07-23 20:23:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaians`
--

CREATE TABLE `penilaians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `id_kriteria1` bigint(20) UNSIGNED NOT NULL,
  `id_kriteria2` bigint(20) UNSIGNED NOT NULL,
  `id_kriteria3` bigint(20) UNSIGNED NOT NULL,
  `id_kriteria4` bigint(20) UNSIGNED NOT NULL,
  `id_kriteria5` bigint(20) UNSIGNED NOT NULL,
  `id_kriteria6` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penilaians`
--

INSERT INTO `penilaians` (`id`, `id_pegawai`, `id_kriteria1`, `id_kriteria2`, `id_kriteria3`, `id_kriteria4`, `id_kriteria5`, `id_kriteria6`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 5, 5, 5, 5, 5, '2023-07-23 20:20:21', '2023-07-23 20:20:21'),
(2, 3, 2, 3, 4, 3, 1, 5, '2023-07-23 20:20:40', '2023-07-23 20:20:40'),
(3, 2, 5, 5, 5, 2, 4, 5, '2023-07-23 20:20:59', '2023-07-23 20:20:59'),
(4, 4, 3, 5, 5, 5, 5, 5, '2023-07-23 20:23:29', '2023-07-23 20:23:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriterias`
--

CREATE TABLE `sub_kriterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kriteria` bigint(20) UNSIGNED NOT NULL,
  `nama_subkriteria` varchar(255) NOT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sub_kriterias`
--

INSERT INTO `sub_kriterias` (`id`, `id_kriteria`, `nama_subkriteria`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sangat Baik', 5, '2023-07-23 20:14:50', '2023-07-23 20:14:50'),
(2, 1, 'Baik', 4, '2023-07-23 20:14:58', '2023-07-23 20:14:58'),
(3, 1, 'Cukup', 3, '2023-07-23 20:15:02', '2023-07-23 20:15:02'),
(4, 1, 'Kurang', 2, '2023-07-23 20:15:07', '2023-07-23 20:15:07'),
(5, 1, 'Sangat Kurang', 1, '2023-07-23 20:15:12', '2023-07-23 20:15:12'),
(6, 2, 'Sangat Baik', 5, '2023-07-23 20:15:20', '2023-07-23 20:15:20'),
(7, 2, 'Baik', 4, '2023-07-23 20:15:27', '2023-07-23 20:15:27'),
(8, 2, 'Cukup', 3, '2023-07-23 20:15:32', '2023-07-23 20:15:32'),
(9, 2, 'Kurang', 2, '2023-07-23 20:15:41', '2023-07-23 20:15:41'),
(10, 2, 'Sangat Kurang', 1, '2023-07-23 20:15:51', '2023-07-23 20:15:51'),
(11, 3, 'Sangat Baik', 5, '2023-07-23 20:15:59', '2023-07-23 20:15:59'),
(12, 3, 'Baik', 4, '2023-07-23 20:16:07', '2023-07-23 20:16:07'),
(13, 3, 'Cukup', 3, '2023-07-23 20:16:17', '2023-07-23 20:16:17'),
(14, 3, 'Kurang', 2, '2023-07-23 20:16:23', '2023-07-23 20:16:23'),
(15, 3, 'Sangat Kurang', 1, '2023-07-23 20:16:35', '2023-07-23 20:16:35'),
(16, 4, 'Sangat Baik', 5, '2023-07-23 20:17:42', '2023-07-23 20:17:42'),
(17, 4, 'Baik', 4, '2023-07-23 20:17:50', '2023-07-23 20:17:50'),
(18, 4, 'Cukup', 3, '2023-07-23 20:17:58', '2023-07-23 20:17:58'),
(19, 4, 'Kurang', 2, '2023-07-23 20:18:03', '2023-07-23 20:18:03'),
(20, 4, 'Sangat Kurang', 1, '2023-07-23 20:18:24', '2023-07-23 20:18:24'),
(21, 5, 'Sangat Baik', 5, '2023-07-23 20:18:32', '2023-07-23 20:18:32'),
(22, 5, 'Baik', 4, '2023-07-23 20:18:37', '2023-07-23 20:18:37'),
(23, 5, 'Cukup', 3, '2023-07-23 20:18:43', '2023-07-23 20:18:43'),
(24, 5, 'Kurang', 2, '2023-07-23 20:18:49', '2023-07-23 20:18:58'),
(25, 5, 'Sangat Kurang', 1, '2023-07-23 20:19:10', '2023-07-23 20:19:10'),
(26, 6, 'Sangat Baik', 5, '2023-07-23 20:19:19', '2023-07-23 20:19:19'),
(27, 6, 'Baik', 4, '2023-07-23 20:19:25', '2023-07-23 20:19:25'),
(28, 6, 'Cukup', 3, '2023-07-23 20:19:31', '2023-07-23 20:19:31'),
(29, 6, 'Kurang', 2, '2023-07-23 20:19:40', '2023-07-23 20:19:40'),
(30, 6, 'Sangat Kurang', 1, '2023-07-23 20:19:46', '2023-07-23 20:19:46');

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
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kriterias_kd_kriteria_unique` (`kd_kriteria`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pegawais_kd_pegawai_unique` (`kd_pegawai`);

--
-- Indeks untuk tabel `penilaians`
--
ALTER TABLE `penilaians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaians_id_pegawai_foreign` (`id_pegawai`),
  ADD KEY `penilaians_id_kriteria1_foreign` (`id_kriteria1`),
  ADD KEY `penilaians_id_kriteria2_foreign` (`id_kriteria2`),
  ADD KEY `penilaians_id_kriteria3_foreign` (`id_kriteria3`),
  ADD KEY `penilaians_id_kriteria4_foreign` (`id_kriteria4`),
  ADD KEY `penilaians_id_kriteria5_foreign` (`id_kriteria5`),
  ADD KEY `penilaians_id_kriteria6_foreign` (`id_kriteria6`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_kriterias_id_kriteria_foreign` (`id_kriteria`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penilaians`
--
ALTER TABLE `penilaians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penilaians`
--
ALTER TABLE `penilaians`
  ADD CONSTRAINT `penilaians_id_kriteria1_foreign` FOREIGN KEY (`id_kriteria1`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaians_id_kriteria2_foreign` FOREIGN KEY (`id_kriteria2`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaians_id_kriteria3_foreign` FOREIGN KEY (`id_kriteria3`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaians_id_kriteria4_foreign` FOREIGN KEY (`id_kriteria4`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaians_id_kriteria5_foreign` FOREIGN KEY (`id_kriteria5`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaians_id_kriteria6_foreign` FOREIGN KEY (`id_kriteria6`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaians_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawais` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  ADD CONSTRAINT `sub_kriterias_id_kriteria_foreign` FOREIGN KEY (`id_kriteria`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
