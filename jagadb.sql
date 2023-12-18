-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Des 2023 pada 09.15
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jagadb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(3) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `nik`, `username`, `password`) VALUES
(2, 'Razif', '2172021180662000', 'Pakuo', 'razif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(3) NOT NULL,
  `jenis_laporan` enum('Ringan','Darurat') NOT NULL,
  `deskripsi_laporan` varchar(255) DEFAULT NULL,
  `detail_lokasi` enum('BLOK A','BLOK B') DEFAULT NULL,
  `dokumentasi` varchar(255) DEFAULT NULL,
  `tanggal_kirim` datetime DEFAULT NULL,
  `status_tindaklanjut` enum('Sedang di proses','Tidak di proses','Sudah di proses') DEFAULT NULL,
  `id_user` int(3) NOT NULL,
  `id_admin` int(3) DEFAULT NULL,
  `id_keamanan` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `jenis_laporan`, `deskripsi_laporan`, `detail_lokasi`, `dokumentasi`, `tanggal_kirim`, `status_tindaklanjut`, `id_user`, `id_admin`, `id_keamanan`) VALUES
(71, 'Ringan', 'tes', 'BLOK A', NULL, '2023-12-13 05:25:03', 'Sedang di proses', 1, NULL, NULL),
(76, 'Ringan', 'rizwal ganteng', 'BLOK B', 'upload/download.jpg', '2023-12-13 19:50:04', '', 13, NULL, NULL),
(77, 'Darurat', 'Ada ular masuk ke dalam rumah saya pak di blok b no 1 ', 'BLOK B', 'upload/ular-masuk-rumah-tanda-tamu-tak-di-undang.jpg', '2023-12-14 03:02:56', 'Sudah di proses', 19, NULL, NULL),
(78, 'Ringan', 'Ada keributan didepan rumah saya di blok a no 4', 'BLOK A', NULL, '2023-12-14 03:13:27', 'Sudah di proses', 17, NULL, NULL),
(79, 'Ringan', 'Ada orang mencurigakan. dia seperti mengincar sesuatu didekat masjid', 'BLOK B', 'upload/Viral-video-orang-mencurigakan-di-dekat-SDN-Pelambuan-1-Banjarmasin-Barat-guru-lapor-Bhabinkamtibmas.-tangkap-layar-video-WAG..jpg', '2023-12-14 03:15:53', 'Tidak di proses', 14, NULL, NULL),
(80, 'Ringan', 'Pohon tumbang di warung makan bude', 'BLOK B', NULL, '2023-12-14 03:19:10', 'Sudah di proses', 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id_user` int(3) NOT NULL,
  `nama_masy` varchar(255) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(20) NOT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `umur` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `masyarakat`
--

INSERT INTO `masyarakat` (`id_user`, `nama_masy`, `nik`, `username`, `password`, `alamat`, `jenis_kelamin`, `no_telp`, `tanggal_lahir`, `umur`) VALUES
(14, 'Heru', '2171077001230002', 'Heru', 'Heru', 'Blok A No. 02', 'Laki-laki', '081967651202', '1991-02-19', 32),
(17, 'Salsa', '2171077001230004', 'Salsa', 'Salsa', 'Blok A no. 4', 'Laki-laki', '081967651204', '2000-11-09', 23),
(19, 'Rizwal', '2171077001234211', 'Rizwalstarboy', 'Rizwal', 'Blok B No 1', 'Laki-laki', '081967651221', '2005-04-11', 18),
(20, 'Daniel', '217107700123405', 'Daniel', 'Daniel', 'Blok B No 2', 'Laki-laki', '081967651205', '1997-07-16', 26),
(21, 'Fauzi', '2171077001230009', 'Fauzi', 'Fauzi', 'Blok A No. 03', 'Laki-laki', '081967651209', '2000-09-19', 23);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tim_keamanan`
--

CREATE TABLE `tim_keamanan` (
  `id_keamanan` int(3) NOT NULL,
  `nama_keamanan` varchar(50) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tim_keamanan`
--

INSERT INTO `tim_keamanan` (`id_keamanan`, `nama_keamanan`, `nik`, `username`, `password`) VALUES
(1, 'Asep', '2171077001230007', 'as', 'as');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `nama_masy` (`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `nama_masy` (`nama_masy`);

--
-- Indeks untuk tabel `tim_keamanan`
--
ALTER TABLE `tim_keamanan`
  ADD PRIMARY KEY (`id_keamanan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tim_keamanan`
--
ALTER TABLE `tim_keamanan`
  MODIFY `id_keamanan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
