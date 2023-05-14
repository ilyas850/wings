-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Bulan Mei 2023 pada 04.38
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wings`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `report_penjualan` ()   BEGIN
	SELECT CONCAT(a.doc_code, '-', a.doc_number) AS TRANSACTION, a.user, a.total, a.date, b.product_code, b.quantity, c.product_name
	FROM trans_header a
	JOIN trans_detail b
	ON b.doc_code = a.doc_code AND b.doc_number = a.doc_number
	JOIN product c
	ON c.product_code = b.product_code
	
	GROUP BY a.doc_code, a.doc_number, b.product_code;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `product_code` varchar(18) DEFAULT NULL,
  `product_name` varchar(30) DEFAULT NULL,
  `price` int(6) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `dimension` varchar(50) DEFAULT NULL,
  `unit` varchar(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id_product`, `product_code`, `product_name`, `price`, `currency`, `discount`, `dimension`, `unit`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'SO123', 'Choco Drink', 3000, 'IDR', 10, '13 cm x 15 cm', 'PCS', '2023-05-12 23:31:52', '2023-05-13 19:06:27', NULL, NULL),
(3, 'SO124', 'Floridina', 5000, 'IDR', 10, '13 cm x 15 cm', 'PCS', '2023-05-13 03:45:47', '2023-05-13 19:05:50', NULL, NULL),
(4, 'SO125', 'Mie Sedap', 3500, 'IDR', 10, '13 cm x 12 cm', 'PCS', '2023-05-13 03:46:13', '2023-05-13 19:04:54', NULL, NULL),
(5, 'SO126', 'GIV Biru', 10000, 'IDR', 10, '13 cm x 12 cm', 'PCS', '2023-05-13 03:47:13', '2023-05-13 19:04:31', NULL, NULL),
(6, 'SO127', 'SO Klin Pewangi', 15000, 'IDR', 10, '13 cm x 12 cm', 'PCS', '2023-05-13 03:50:11', '2023-05-13 19:03:20', NULL, NULL),
(7, 'SO128', 'SO Klin Liquid', 18000, 'IDR', 10, '13 cm x 12 cm', 'PCS', '2023-05-13 03:52:16', '2023-05-13 19:02:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_detail`
--

CREATE TABLE `trans_detail` (
  `id_trans_detail` bigint(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `doc_code` varchar(3) DEFAULT NULL,
  `doc_number` varchar(10) DEFAULT NULL,
  `product_code` varchar(18) DEFAULT NULL,
  `price` int(6) DEFAULT NULL,
  `quantity` int(6) DEFAULT NULL,
  `unit` varchar(5) DEFAULT NULL,
  `sub_total` int(10) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `trans_detail`
--

INSERT INTO `trans_detail` (`id_trans_detail`, `user`, `doc_code`, `doc_number`, `product_code`, `price`, `quantity`, `unit`, `sub_total`, `currency`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(11, 'pelanggan1', 'TRX', '001', 'SO128', 18000, 1, 'PCS', 18000, 'IDR', '2023-05-13 19:08:47', '2023-05-13 19:09:29', NULL, NULL),
(12, 'pelanggan1', 'TRX', '001', 'SO127', 15000, 2, 'PCS', 30000, 'IDR', '2023-05-13 19:08:53', '2023-05-13 19:09:29', NULL, NULL),
(13, 'pelanggan1', 'TRX', '001', 'SO126', 10000, 1, 'PCS', 10000, 'IDR', '2023-05-13 19:09:00', '2023-05-13 19:09:29', NULL, NULL),
(14, 'pelanggan1', 'TRX', '001', 'SO125', 3500, 2, 'PCS', 7000, 'IDR', '2023-05-13 19:09:06', '2023-05-13 19:09:29', NULL, NULL),
(15, 'pelanggan2', 'TRX', '002', 'SO128', 18000, 8, 'PCS', 48600, 'IDR', '2023-05-13 19:10:42', '2023-05-13 19:32:47', NULL, NULL),
(16, 'pelanggan2', 'TRX', '002', 'SO123', 3000, 2, 'PCS', 6000, 'IDR', '2023-05-13 19:10:51', '2023-05-13 19:11:02', NULL, NULL),
(20, 'pelanggan2', 'TRX', '003', 'SO128', 16200, 3, 'PCS', 48600, 'IDR', '2023-05-13 19:32:27', '2023-05-13 19:33:21', NULL, NULL),
(21, 'pelanggan2', 'TRX', '003', 'SO127', 13500, 1, 'PCS', 13500, 'IDR', '2023-05-13 19:32:44', '2023-05-13 19:33:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_header`
--

CREATE TABLE `trans_header` (
  `id_trans_header` bigint(11) NOT NULL,
  `doc_code` varchar(3) DEFAULT NULL,
  `doc_number` varchar(10) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `total` int(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `trans_header`
--

INSERT INTO `trans_header` (`id_trans_header`, `doc_code`, `doc_number`, `user`, `total`, `date`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(5, 'TRX', '001', 'pelanggan1', 65000, '2023-05-14', '2023-05-13 19:09:29', '2023-05-13 19:09:29', NULL, NULL),
(6, 'TRX', '002', 'pelanggan2', 42000, '2023-05-14', '2023-05-13 19:11:02', '2023-05-13 19:11:02', NULL, NULL),
(7, 'TRX', '003', 'pelanggan2', 62100, '2023-05-14', '2023-05-13 19:33:21', '2023-05-13 19:33:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` tinyint(2) DEFAULT 2,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pelanggan 1', 'pelanggan1', NULL, NULL, 2, '$2y$10$kBoSowkCdFWKF3vO53NlruJKaRwpTPtKxr2Dp15AsGrinKHKn3KSe', NULL, '2023-05-12 19:44:47', '2023-05-12 19:44:47'),
(2, 'Admin', 'admin', NULL, NULL, 1, '$2y$10$CTH95kxGvh1Ibg/W0pJjrOooaeHk6d4.kHfABA6ZBuJtPPtWcvISe', NULL, '2023-05-12 20:49:10', '2023-05-12 20:49:10'),
(3, 'Pelanggan 2', 'pelanggan2', NULL, NULL, 2, '$2y$10$tmKiVdtSV.wnYdbgvVgiLukjMOZDgT1krAA93pPleVINHJ1Lv7yii', NULL, '2023-05-13 19:10:36', '2023-05-13 19:10:36');

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
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indeks untuk tabel `trans_detail`
--
ALTER TABLE `trans_detail`
  ADD PRIMARY KEY (`id_trans_detail`);

--
-- Indeks untuk tabel `trans_header`
--
ALTER TABLE `trans_header`
  ADD PRIMARY KEY (`id_trans_header`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
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
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `trans_detail`
--
ALTER TABLE `trans_detail`
  MODIFY `id_trans_detail` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `trans_header`
--
ALTER TABLE `trans_header`
  MODIFY `id_trans_header` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
