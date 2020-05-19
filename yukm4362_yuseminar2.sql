-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Bulan Mei 2020 pada 17.20
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yukm4362_yuseminar2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tkategori`
--

CREATE TABLE `tkategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `aktif` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tkategori`
--

INSERT INTO `tkategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`, `aktif`) VALUES
(1, 'Pembelajaran', '2019-11-02 07:33:30', '2019-10-20 12:40:19', 0),
(2, 'Bisnis', '2019-11-02 07:04:23', '2019-10-20 12:41:00', 1),
(63, 'Kesenian', '2020-02-09 04:58:51', '2020-02-08 22:58:51', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpeserta`
--

CREATE TABLE `tpeserta` (
  `id_peserta` int(11) NOT NULL,
  `id_seminar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `paper_peserta` text DEFAULT NULL,
  `pembayaran_peserta` text DEFAULT NULL,
  `konfirmasi_peserta` int(2) NOT NULL,
  `hadir` int(2) DEFAULT NULL,
  `rekening_user` varchar(60) DEFAULT NULL,
  `an_user` varchar(60) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `promo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trekap`
--

CREATE TABLE `trekap` (
  `id_rekap` int(11) NOT NULL,
  `nama_seminar` varchar(100) NOT NULL,
  `email_penanggungjawab` varchar(50) NOT NULL,
  `jml_peserta` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tseminar`
--

CREATE TABLE `tseminar` (
  `id_seminar` int(11) NOT NULL,
  `nama_seminar` varchar(100) NOT NULL,
  `jadwal` varchar(50) NOT NULL,
  `tempat_seminar` varchar(100) NOT NULL,
  `narasumber` varchar(100) NOT NULL,
  `jml_peserta` int(5) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `paper` int(2) DEFAULT NULL,
  `pembayaran` int(2) DEFAULT NULL,
  `waktu` varchar(10) NOT NULL,
  `poster` text NOT NULL,
  `kategori_seminar` int(11) NOT NULL,
  `deskripsi_seminar` text NOT NULL,
  `harga_seminar` int(100) DEFAULT NULL,
  `harga_umum` int(100) DEFAULT NULL,
  `rekening_seminar` varchar(60) DEFAULT NULL,
  `an_penyelenggara` varchar(60) DEFAULT NULL,
  `bank_rekening` varchar(30) NOT NULL,
  `buka_pendaftaran` int(11) NOT NULL,
  `selesai_seminar` int(11) DEFAULT NULL,
  `total_peserta` int(11) DEFAULT NULL,
  `url_seminar` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `nama_gedung` varchar(100) NOT NULL,
  `lantai` varchar(60) NOT NULL,
  `kode_promo` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tuser`
--

CREATE TABLE `tuser` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `pass_user` varchar(200) NOT NULL,
  `nim_user` int(15) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `universitas` varchar(100) DEFAULT NULL,
  `phone_user` varchar(20) DEFAULT NULL,
  `address_user` text DEFAULT NULL,
  `bday_user` date DEFAULT NULL,
  `gender_user` varchar(20) DEFAULT NULL,
  `photo_user` varchar(255) DEFAULT NULL,
  `role_user` varchar(50) NOT NULL,
  `pengawas_seminar` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tuser`
--

INSERT INTO `tuser` (`id_user`, `nama_user`, `email_user`, `pass_user`, `nim_user`, `jurusan`, `universitas`, `phone_user`, `address_user`, `bday_user`, `gender_user`, `photo_user`, `role_user`, `pengawas_seminar`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Goldy Widiyanto', 'goldy@gmail.com', '$2y$10$ouh6QHRNyx19/wg1TFzbTOKsUbkrZHhUXxPPMuw9is7K1XWbv4mte', 2016102800, 'Teknik Informatika', 'Kalbis Institute', '082213525038', 'Matraman', '1998-07-31', 'Male', 'img_user/15cde6436e6cf2.jpg', 'user', NULL, 1, NULL, NULL),
(2, 'admin', 'admin1@gmail.com', '$2y$10$qdkfoayAoZjKgEyjMO7gRuW/92nvsuKrtvzxAKWeRqWiDeeSpwKLW', 0, '', '', NULL, NULL, NULL, NULL, NULL, 'admin', NULL, 1, NULL, NULL),
(6, 'henryds', 'henry@gmail.com', '$2y$10$5KyOvkhe6kwCKJPV2GMj8etm/XGdhYS.foFccfyfdv4A6gPiaMutO', 20161027, 'Teknik Informatika', 'Kalbis', '085888460763', 'Jl. cip elok', '2019-09-14', 'Male', 'img_user/foto.jpg', 'user', NULL, 1, NULL, '2020-04-29 05:42:31'),
(7, 'pengawas2', 'pengawas2@gmail.com', '$2y$10$.9IaRCuw.o52pPfnSyLUGuzQyXGpJEfaP7e9T2c.Cug1XutZyrkD.', NULL, NULL, '', NULL, NULL, NULL, 'Male', NULL, 'pengawas', 4, 0, NULL, NULL),
(8, 'leonardo', 'leo@gmail.com', '$2y$10$vDtmowMaMPTiMJvaCsCX5ebs5mtUNeZrgrfaU7Lc5MpuVCe1adYty', 2016102794, 'Teknik Informatika', 'Kalbis Institute', NULL, NULL, NULL, NULL, NULL, 'user', NULL, 0, NULL, NULL),
(9, 'Wisnu', 'wisnu@gmail.com', '$2y$10$K0CdVaP/1nTQkcrLBJ5Lt.q5159fcHLEcSz8uB8WYuEGFZzvo/Tz6', 0, 'Ilmu Sosial', 'Universitas Prof Dr Moestopo', NULL, NULL, NULL, NULL, NULL, 'user', NULL, 0, NULL, NULL),
(10, 'Kevin', 'kevin@gmail.com', '$2y$10$.p2P1p/Dcjn5StO9Zsfsau.dFWuMs8eds0hzUs65pPvocIavgv09m', 0, 'Ilmu Sosial', 'Universitas Prof Dr Moestopo', NULL, NULL, NULL, NULL, NULL, 'user', NULL, 0, NULL, NULL),
(11, 'pengawas3', 'pengawas3@gmail.com', '$2y$10$7FLjK4ql0oWUel4p8uBa4.xtYYCw6UYNL/yJk43b3K8vwZkzYS4Ge', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pengawas', 7, 0, NULL, NULL),
(30, 'Goldy Widiyanto', 'goldywidiyanto@gmail.com', '$2y$10$fvbcZ1BRU75JPKX99/BY3eOzMnMiMIcUiqKaAmTC8Eqf4hJ40G0Ae', 2016102800, 'Teknik Informatika', 'Kalbis Institute', NULL, NULL, NULL, NULL, 'img_user/IMG-20180331-WA0002.jpg', 'user', NULL, 1, '0000-00-00 00:00:00', NULL),
(32, 'MRezaKhalafi', 'mrezakhalafi@yahoo.com', '$2y$10$fVsQ9yMWt.x0WqoUV5YLouMx4WpJLLQCj8D3LMGlh4neuw7XVhs/a', 2016102754, 'Infomatika', 'KALBIS Institute', '081293291580', 'Jl.Cipinang Elok 1 Blok.C No.13', '1998-06-23', 'Male', 'img_user/RW7XRUY.jpg', 'user', NULL, 1, '0000-00-00 00:00:00', '2019-09-17 17:00:00'),
(38, 'Pengawas Building', 'pengawasbuilding@gmail.com', '$2y$10$1GBin87lib7Plzmkgua3tuZnw8D9okbAksG5kleqPNPEWxaJm.2Pq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pengawas', 6, 1, '2019-10-12 17:00:00', NULL),
(39, 'Pengawas International', 'pengawasinternational@gmail.com', '$2y$10$BG6wfia8x1ScsnQ1z3XoAewCvSYXsou/g3tSz8mAqA14xxSV1zRmy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pengawas', 2, 1, '2019-10-12 17:00:00', NULL),
(44, 'GL ACC', 'glaccs1997@gmail.com', '$2y$10$HgFTOOURvZsQVNFz5VY3N.hKGrgOg120UVTLgHXh1YBUTXCQIngL.', 0, 'Teknik Informatika', 'Kalbis Institute', NULL, NULL, NULL, NULL, 'img/profile/default.jpg', 'user', NULL, 1, '0000-00-00 00:00:00', NULL),
(45, 'dede', 'dede@yahoo.com', '$2y$10$SJTaTpNQXY2ItA57r8o48eu4t.Pp19RCV3znTf80q5aZjHivXc7Xm', 2012712812, 'informatika', 'kalbis institute', NULL, NULL, NULL, NULL, 'img/profile/default.jpg', 'user', NULL, 1, '0000-00-00 00:00:00', NULL),
(48, 'henryds', 'henrycuber@gmail.com', '$2y$10$Hc4l1jsMelJ8kSLhhDetfeMrevup400o/h7Axb.mD3fMrte7emBou', 2342342, 'sdas', 'fdsdfsdffsdf', '0898928323', NULL, NULL, NULL, 'img/profile/default.jpg', 'admin', NULL, 1, '0000-00-00 00:00:00', NULL),
(50, 'Goldy Widiyantoo', 'goldywidiyantoo@gmail.com', '$2y$10$szYpGYl/NSmDpcllDyC64ukavxrV3APD4MHiMyyg5w2gpOFIROpHW', 2016102800, 'Teknik Informatika', 'Kalbis Institute', NULL, NULL, NULL, NULL, 'img/profile/default.jpg', 'user', NULL, 1, '0000-00-00 00:00:00', NULL),
(51, 'centhia', 'centhiarooroh40@gmail.com', '$2y$10$gB/KDI.1awQ7h0oWPM5GJO2xnoCgNAunT2pGx4PIUBpoMF6WyfFDS', 2016102777, 'informatika', 'kalbis institute', NULL, NULL, NULL, NULL, 'img/profile/default.jpg', 'user', NULL, 1, '0000-00-00 00:00:00', NULL),
(63, 'Reza Khalafi', 'reza@gmail.com', '$2y$10$xFW5Co.ARy/TGp6CxhmZ7ui8tyhKIfUOIwAtzROh2S1X6AIVXgjCa', 2147483647, 'informatika', 'Tri Sakti', NULL, NULL, NULL, NULL, 'img/profile/default.jpg', 'user', NULL, 1, '2020-04-16 07:37:17', NULL),
(64, 'henryds', 'henrydwiseptian@gmail.com', '$2y$10$iFNSSH1RgyUKjzJxSX12Henq/5CbMzfC/ZYJD4.I91nqupzol/GXS', 2016102773, 'informatika', 'Kalbis Institute', '08293728472384', NULL, NULL, NULL, 'img/profile/default.jpg', 'user', NULL, 1, '2020-04-16 08:10:49', NULL),
(65, 'Nathan', 'nathan@gmail.com', '$2y$10$CGEpRGXDBjVlCqzKDWwEpuSQ7ayo6PFsa5Pd0egOKAInBX3PsnsSm', NULL, NULL, NULL, '0855423642', NULL, NULL, NULL, 'img_user/default.jpg', 'pengawas', 27, 1, '2020-04-16 08:20:21', NULL),
(67, 'sasa', 'sasa@yahoo.com', '$2y$10$A/WykqS8ny7RD3m09gDPEOcMqpGm8D6wWmu6PD6IDpwrK99ualzKC', 0, '', '', '08213123123', NULL, NULL, NULL, 'img/profile/default.jpg', 'user', NULL, 0, '2020-04-29 08:59:24', NULL),
(68, 'Santi', 'santi@gmail.com', '$2y$10$S9Xc0tHtDVenMFFDgneUVO94Ak/YixH9DPRqYu6RVI5f4yZ3HzysK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'img_user/default.jpg', 'pengawas', 28, 1, '2020-04-29 10:53:42', NULL),
(69, 'mahasiswa', '2016102773@student.kalbis.ac.id', '$2y$10$YUkbe9oQ6qINRODjhIhJ0uj8gH0Slc6lieHzfaQJtsK0.ofnpsafa', 0, '', '', '038283239123', NULL, NULL, NULL, 'img/profile/default.jpg', 'user', NULL, 0, '2020-04-30 15:32:58', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tuser_token`
--

CREATE TABLE `tuser_token` (
  `id` int(11) NOT NULL,
  `email` varchar(144) NOT NULL,
  `token` varchar(144) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tuser_token`
--

INSERT INTO `tuser_token` (`id`, `email`, `token`, `date_created`) VALUES
(35, 'reza@gmail.com', 'aa07ce788a8458a1bf06ccb96157d045', '2020-04-16'),
(37, 'sasa@yahoo.com', 'e88696a0c455faa8160b708ac94fae51', '2020-04-29'),
(38, 'sasa@yahoo.com', '958d7188123396bf36e414475d2d71fc', '2020-04-29'),
(39, '2016102773@student.kalbis.ac.id', '618e78882a7a665341cfacbd3bb4fc36', '2020-04-30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tkategori`
--
ALTER TABLE `tkategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tpeserta`
--
ALTER TABLE `tpeserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_seminar` (`id_seminar`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `trekap`
--
ALTER TABLE `trekap`
  ADD PRIMARY KEY (`id_rekap`);

--
-- Indeks untuk tabel `tseminar`
--
ALTER TABLE `tseminar`
  ADD PRIMARY KEY (`id_seminar`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tuser`
--
ALTER TABLE `tuser`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email_user`);

--
-- Indeks untuk tabel `tuser_token`
--
ALTER TABLE `tuser_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tkategori`
--
ALTER TABLE `tkategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `tpeserta`
--
ALTER TABLE `tpeserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `trekap`
--
ALTER TABLE `trekap`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tseminar`
--
ALTER TABLE `tseminar`
  MODIFY `id_seminar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `tuser_token`
--
ALTER TABLE `tuser_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
