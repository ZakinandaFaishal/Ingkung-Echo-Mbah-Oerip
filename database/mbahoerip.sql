-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Bulan Mei 2025 pada 18.38
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbahoerip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `harga_diskon` decimal(10,2) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `nama`, `kategori`, `harga`, `harga_diskon`, `diskon`, `gambar`, `rating`) VALUES
(1, 'Gulai - Soup Kepala Kakap', 'Spesial Promo', 70000, '49.00', 15, 'food-menu-1.png', 5),
(2, 'Kepala Kambing Utuh/kg', 'Spesial Promo', 39000, '29.00', 10, 'food-menu-2.png', 5),
(3, 'Ingkung Babon Goreng', 'Spesial Promo', 69000, '49.00', 25, 'food-menu-3.png', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `catatan` varchar(255) DEFAULT NULL,
  `status` enum('pending','dipesan','selesai') DEFAULT 'pending',
  `id_user` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_menu`, `jumlah`, `catatan`, `status`, `id_user`, `created_at`) VALUES
(2, 1, 4, '', 'dipesan', NULL, '2025-05-24 10:49:23'),
(3, 3, 1, '', 'pending', NULL, '2025-05-24 10:49:23'),
(9, 2, 4, '', 'dipesan', 1, '2025-05-24 10:49:23'),
(10, 3, 5, '', 'dipesan', 1, '2025-05-24 10:49:23'),
(11, 1, 9, '', 'dipesan', 1, '2025-05-24 10:49:23'),
(12, 2, 11, '', 'dipesan', 1, '2025-05-24 10:49:23'),
(13, 2, 1, '', 'dipesan', 1, '2025-05-24 10:49:23'),
(14, 2, 1, '', 'dipesan', 1, '2025-05-24 10:49:23'),
(15, 2, 1, '', 'dipesan', 1, '2025-05-24 10:49:23'),
(16, 2, 1, '', 'dipesan', 1, '2025-05-24 10:49:23'),
(17, 1, 1, '', 'selesai', 1, '2025-05-24 10:49:23'),
(26, 2, 10, '', 'selesai', 1, '2025-05-24 10:49:23'),
(27, 2, 20, '', 'selesai', 1, '2025-05-24 10:49:23'),
(28, 3, 1, '', 'selesai', 1, '2025-05-24 10:49:23'),
(29, 1, 5, '', 'selesai', 1, '2025-05-24 10:49:23'),
(30, 1, 1, '', 'selesai', 1, '2025-05-24 10:49:23'),
(31, 3, 1, '', 'selesai', 1, '2025-05-24 10:49:23'),
(32, 2, 5, '', 'selesai', 1, '2025-05-24 10:49:23'),
(33, 1, 9, '', 'selesai', 1, '2025-05-24 10:49:23'),
(34, 2, 1, '', 'selesai', 1, '2025-05-24 10:49:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `youtube_video_id` varchar(20) NOT NULL,
  `profile_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `title`, `youtube_video_id`, `profile_image`) VALUES
(1, 'tanboy kun', 'Food Vlogger', 'itiHbP9WmsA\r\n', './assets/images/avatar-2.jpg'),
(2, 'pesona borobudur', 'Wisata dan Kuliner', 'Vxo153Pyk_c', './assets/images/avatar-2.jpg'),
(3, 'pesona borobudur', 'Wisata dan Kuliner', 'T4bXjFDLaHQ', './assets/images/avatar-3.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `level` enum('u','a','o') NOT NULL DEFAULT 'u',
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `whatsapp`, `first_name`, `last_name`, `level`, `email`, `password`, `created_at`, `reset_token`, `token_expiry`) VALUES
(1, '082138878657', 'Zakinanda', 'Faishal', 'u', 'zakinanda@localhost', '$2y$10$yTmPUi.Qx2Qars8y7RRG5u./QGg6jUUGUX9LccuRQU05BNCBp6bIG', '2025-04-29 03:13:20', NULL, NULL),
(2, '089651659645', 'Hanif', 'Afifudin', 'u', 'hanifafifudin13@gmail.com', '$2y$10$tRjBQSmi4zfajdRMYoT1cumzC9pN6nZKRuXOuCsjpxyPOkzrBe2HK', '2025-05-09 00:33:03', NULL, NULL),
(6, '085878380753', 'Nur', 'Arifin', 'a', 'nurarifin@localhost', '$2y$10$2exL.Q.N9dW4H3OJPOtEaO44uJNnDpf.9aIB9QCZahTCqHWt3tpvG', '2025-05-10 10:58:16', NULL, NULL),
(7, '0811111112233', 'Pemilik', 'Resto', 'o', 'pemilik@localhost', '$2y$10$AwMH.v6j1UZm3VNVnAcdgeuxLEbR5Dh6i9sMuujYiqEjklli0CT7.', '2025-05-10 16:01:38', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `fk_user` (`id_user`);

--
-- Indeks untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
