-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jul 2022 pada 11.53
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `andakar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblbuktitransfer`
--

CREATE TABLE `tblbuktitransfer` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `nominal_trf` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `margin` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `no_transac` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblbuktitransfer`
--

INSERT INTO `tblbuktitransfer` (`id`, `date`, `file_name`, `status`, `nominal_trf`, `user`, `margin`, `note`, `no_transac`) VALUES
(1, '2022-06-30 15:59:20', 'BTCAT3006202203590738.jpg', 'after_revision', 0, 'customer', '0', 'asdasd', 'CAT3006202203590738'),
(2, '0000-00-00 00:00:00', 'BTDPCAT3006202203590738.png', 'revisi_dp', 12312313, 'admin', '', '', 'CAT3006202203590738'),
(3, '0000-00-00 00:00:00', 'BTDPCAT3006202203590738.jpg', 'revisi_dp', 200000, 'admin', '', '', 'CAT3006202203590738'),
(4, '0000-00-00 00:00:00', 'BTDPCAT3006202203590738.jpg', 'revisi_dp', 123213, 'admin', '', '', 'CAT3006202203590738'),
(5, '0000-00-00 00:00:00', 'BTDPCAT3006202203590738.jpg', 'revisi_dp', 123123, 'admin', '', '', 'CAT3006202203590738'),
(7, '2022-06-30 18:42:25', 'BTLNSCAT3006202203590738.jpg', 'lunas', 0, 'customer', '', '', 'CAT3006202203590738');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tblbuktitransfer`
--
ALTER TABLE `tblbuktitransfer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tblbuktitransfer`
--
ALTER TABLE `tblbuktitransfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
