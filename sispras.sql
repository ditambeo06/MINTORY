-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Des 2025 pada 05.31
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
-- Database: `sispras`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_login`
--

CREATE TABLE `tb_login` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_login`
--

INSERT INTO `tb_login` (`id`, `email`, `username`, `passwd`, `level`) VALUES
(11, 'apa@gmail.com', 'operator', '202cb962ac59075b964b07152d234b70', 'operator'),
(12, 'coba1', 'admin', '202cb962ac59075b964b07152d234b70', 'admin'),
(13, 'coba2', 'user', '202cb962ac59075b964b07152d234b70', 'user'),
(14, 'coba3', 'superuser', '202cb962ac59075b964b07152d234b70', 'super user'),
(15, 'coba4', 'user2', '202cb962ac59075b964b07152d234b70', 'user'),
(16, 'coba5', 'user3', '202cb962ac59075b964b07152d234b70', 'user'),
(17, 'coba6', 'user5', '202cb962ac59075b964b07152d234b70', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengadaan`
--

CREATE TABLE `tb_pengadaan` (
  `id_pengadaan` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_barang` varchar(255) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `tahun_ajar` varchar(50) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pengadaan`
--

INSERT INTO `tb_pengadaan` (`id_pengadaan`, `nama_barang`, `jumlah_barang`, `jurusan`, `tahun_ajar`, `keterangan`) VALUES
(2, 'asdasd', '12', 'sda', 'asdas', 'asdas'),
(3, 'wasd', '2', 'asdas', '2022', 'fsdj'),
(4, 'wasd', '2', 'adas', 'asdas', 'sdas'),
(5, 'ead', '2', 'dsfew', '2024', 'dfdsfs'),
(6, 'admin', '1', 'admin', 'admin', 'admin'),
(7, 'super user', '1', 'super user', 'super user', 'super user'),
(8, 'operator', '1', 'operator', 'operator', 'operator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_perbaikan`
--

CREATE TABLE `tb_perbaikan` (
  `id_perbaikan` int(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_barang` varchar(255) NOT NULL,
  `foto_barang` text NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `dibuat` varchar(255) NOT NULL,
  `status` varchar(2) NOT NULL DEFAULT '1',
  `Nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_perbaikan`
--

INSERT INTO `tb_perbaikan` (`id_perbaikan`, `nama_barang`, `jumlah_barang`, `foto_barang`, `keterangan`, `dibuat`, `status`, `Nama`) VALUES
(32, 'meja', '3', '1732857356Poster.png', 'kaki patah', 'operator', '3', ''),
(33, 'kursi', '3', '1732859300Poster.png', 'kaki patah', 'user', '2', ''),
(34, 'dsuhdsh', '2', '1732859984Poster.png', '', 'user', '2', ''),
(35, 'admin', '1', '1732868100Poster.png', 'admin', 'admin', '2', ''),
(36, 'user', '1', '1732868293Poster.png', 'user', 'user', '2', ''),
(37, 'superuser', '1', '1732868423Poster.png', 'superuser', 'superuser', '2', ''),
(38, 'super user', '1', '1732868549Poster.png', 'super user', 'superuser', '2', ''),
(39, 'operator', '1', '1732868875Poster.png', 'operator', 'operator', '2', ''),
(40, 'meja', '2', '1733463455Poster.png', 'kaki patah', 'superuser', '2', ''),
(42, 'kursi', '2', '1733790491bg.png', '', 'user', '3', ''),
(50, 'dewa', '3', '1764822357Screenshot (1).png', 'kaki ilang', 'admin', '1', 'dewa'),
(51, 'dewa', '3', '1764822431Screenshot (1).png', 'kaki hilang', 'user2', '2', 'dewa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pinjam`
--

CREATE TABLE `tb_pinjam` (
  `id_peminjaman` int(11) NOT NULL,
  `nama_properti` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `tanggal_pinjam` varchar(50) NOT NULL,
  `tanggal_kembali` varchar(50) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `dibuat` varchar(255) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pinjam`
--

INSERT INTO `tb_pinjam` (`id_peminjaman`, `nama_properti`, `jumlah`, `tanggal_pinjam`, `tanggal_kembali`, `keterangan`, `dibuat`, `status`) VALUES
(6, 'ddsfs', '3', '2024-11-29', '2024-11-30', 'ded', 'user\r\n', '2'),
(7, 'lab biologi', '1', '2024-11-29', '2024-11-30', 'mata pelajaran', 'admin', '2'),
(8, 'admin', '1', '2024-11-29', '2024-11-30', 'admin', 'admin', '3'),
(9, 'user', '1', '2024-11-29', '2024-11-30', 'user', 'user', '2'),
(10, 'super user', '1', '2024-11-29', '2024-11-30', 'super user', 'superuser', '2'),
(11, 'operator', '1', '2024-11-29', '2024-11-30', 'operator', 'operator', '2'),
(12, 'pensil', '3', '2024-12-10', '', 'admin', 'superuser', '1'),
(13, 'Moh. Ardianysah Nento', '2', '2024-12-10', '2024-12-11', 'gaga', 'superuser', '1'),
(14, 'Rizki', '2', '2024-12-10', '2024-12-11', 'admin', 'superuser', '1'),
(15, 'rizki', '-23', '2024-12-10', '', 'bolong', 'superuser', '1'),
(16, 'pensil', '2', '2024-12-10', '2024-12-09', 'bolong', 'superuser', '1'),
(17, 'wdaq', '1', '2024-12-10', '2024-12-11', 'fsd', 'superuser', '1'),
(18, 'adfa', '2', '2024-12-11', '2024-12-12', 'adaeq', 'user', '1'),
(19, 'pensil', '1', '2024-12-11', '2024-12-12', 'dewa', 'user', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `tb_pengadaan`
--
ALTER TABLE `tb_pengadaan`
  ADD PRIMARY KEY (`id_pengadaan`);

--
-- Indeks untuk tabel `tb_perbaikan`
--
ALTER TABLE `tb_perbaikan`
  ADD PRIMARY KEY (`id_perbaikan`);

--
-- Indeks untuk tabel `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_pengadaan`
--
ALTER TABLE `tb_pengadaan`
  MODIFY `id_pengadaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_perbaikan`
--
ALTER TABLE `tb_perbaikan`
  MODIFY `id_perbaikan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
