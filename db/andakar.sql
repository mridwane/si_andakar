-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2022 pada 19.00
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

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
-- Struktur dari tabel `tblautonumber`
--

CREATE TABLE `tblautonumber` (
  `id` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `increment` int(11) NOT NULL,
  `desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tblautonumber`
--

INSERT INTO `tblautonumber` (`id`, `start`, `end`, `increment`, `desc`) VALUES
(1, 1000, 62, 1, 'PROD');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblcart`
--

CREATE TABLE `tblcart` (
  `kd_cart` varchar(255) NOT NULL,
  `jenis_cart` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `c_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblcart`
--

INSERT INTO `tblcart` (`kd_cart`, `jenis_cart`, `date`, `c_id`) VALUES
('Delivery4', 'Delivery', '2022-06-23', 4),
('Delivery5', 'Delivery', '2022-06-23', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblcartdetail`
--

CREATE TABLE `tblcartdetail` (
  `id` int(100) NOT NULL,
  `kd_cart` varchar(255) NOT NULL,
  `kd_menu` int(11) NOT NULL,
  `kd_saus` varchar(11) DEFAULT NULL,
  `qty` int(10) NOT NULL,
  `harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblcartdetail`
--

INSERT INTO `tblcartdetail` (`id`, `kd_cart`, `kd_menu`, `kd_saus`, `qty`, `harga`) VALUES
(1, 'Delivery4', 49, 'S002', 2, 114000),
(2, 'Delivery4', 51, 'S003', 1, 128000),
(3, 'Delivery4', 46, 'S002', 2, 414000),
(4, 'Delivery4', 46, 'S001', 2, 418000),
(29, 'Delivery5', 49, 'S001', 2, 118000),
(30, 'Delivery5', 46, 'S100', 2, 414000),
(33, 'Delivery5', 49, 'S001', 2, 118000),
(34, 'Delivery5', 53, 'S100', 2, 24000),
(35, 'Delivery5', 52, 'S100', 1, 10000),
(36, 'Delivery5', 46, 'S002', 1, 207000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblcategory`
--

CREATE TABLE `tblcategory` (
  `category_id` int(11) NOT NULL,
  `category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tblcategory`
--

INSERT INTO `tblcategory` (`category_id`, `category`) VALUES
(1, 'Steak'),
(2, 'Ribs'),
(3, 'Lamb'),
(5, 'Chicken'),
(6, 'Seafood'),
(7, 'Side Dish'),
(8, 'Pie & Pasta'),
(9, 'Starter'),
(10, 'Regular Drink'),
(11, 'Squash'),
(12, 'Tea & Coffee & Blend'),
(13, 'Juice'),
(14, 'Saus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `C_ID` int(50) NOT NULL,
  `C_FNAME` varchar(50) NOT NULL,
  `C_LNAME` varchar(50) NOT NULL,
  `C_AGE` int(2) NOT NULL,
  `C_ADDRESS` text NOT NULL,
  `C_PNUMBER` varchar(50) NOT NULL,
  `C_GENDER` varchar(50) NOT NULL,
  `C_EMAILADD` varchar(50) NOT NULL,
  `ZIPCODE` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tblcustomer`
--

INSERT INTO `tblcustomer` (`C_ID`, `C_FNAME`, `C_LNAME`, `C_AGE`, `C_ADDRESS`, `C_PNUMBER`, `C_GENDER`, `C_EMAILADD`, `ZIPCODE`, `username`, `password`) VALUES
(4, 'Nadya', 'Minerva', 25, 'Jalanin aja dulu', '082346578910', 'Perempuan', 'emak@gmail.com', 'asd', 'admin', '$2y$10$Nz4hwMNDYxc63dBtJ7TGl.zgvt6UXNIylukyWgRxdgvosgy5wtQOy'),
(5, 'sumail', 'cofeen', 20, 'Jl Lembang', '0823123123', 'Laki-Laki', 'sumail@gmail.com', '40222', 'sumail', '$2y$10$Nz4hwMNDYxc63dBtJ7TGl.zgvt6UXNIylukyWgRxdgvosgy5wtQOy'),
(6, 'ridwan', 'remin', 21, 'Jl asd', '312312', 'Laki-Laki', '123@gmail.com', '4321', 'ridwan12', '$2y$10$XZw1u9HtZtDpLXMsUtbHUe4m0ztA8kUttAhXpVxD71cFb9GFnkpn2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbldelivery`
--

CREATE TABLE `tbldelivery` (
  `id` int(50) NOT NULL,
  `transac_code` int(100) NOT NULL,
  `receiver` varchar(200) NOT NULL,
  `dated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbldelivery`
--

INSERT INTO `tbldelivery` (`id`, `transac_code`, `receiver`, `dated`) VALUES
(1, 1593533066, 'Ridwan', '0000-00-00'),
(2, 1595246871, 'Cahadi', '2020-07-22'),
(3, 1654487872, 'asd asd', '2022-06-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbldetailrequestmitra`
--

CREATE TABLE `tbldetailrequestmitra` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `note` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbldetailrequestmitra`
--

INSERT INTO `tbldetailrequestmitra` (`id`, `date`, `note`, `status`, `user_id`) VALUES
(2, '2022-06-20 16:39:35', 'Masih ada dokumen yang belum lengkap', 'denied', '4'),
(3, '2022-06-21 16:45:30', '-', 'accepted', '4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblproducts`
--

CREATE TABLE `tblproducts` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `date_in` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `detail_product` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tblproducts`
--

INSERT INTO `tblproducts` (`product_id`, `product_name`, `date_in`, `category_id`, `user_id`, `status`, `type`, `price`, `image`, `detail_product`) VALUES
(45, 'Iga Bakar', '2022-06-12', 2, 2, 'Habis', 'Makanan Utama', 80000, '1053bbq-chicken-wings2.jpg', ''),
(46, 'Iga Barbar', '2022-06-12', 2, 2, 'Tersedia', 'Makanan Utama', 200000, '1054boneless-chicken2.jpg', ''),
(49, 'Daging ayam', '2022-06-16', 2, 2, 'Tersedia', 'Makanan Utama', 50000, '', ''),
(51, 'ikan bakar', '2022-06-17', 6, 2, 'Tersedia', 'Makanan Utama', 120000, '10587.jpg', ''),
(52, 'Jus Melon', '2022-06-17', 13, 2, 'Tersedia', 'Minuman', 10000, '10598.jpg', ''),
(53, 'Nasi Lengko', '2022-06-17', 7, 2, 'Tersedia', 'Makanan Pendamping', 12000, '106011.jpg', ''),
(54, 'Salmon Barbar', '2022-06-20', 9, 2, 'Tersedia', 'Makanan Utama', 190000, '1061boneless-chicken2.jpg', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblreq`
--

CREATE TABLE `tblreq` (
  `no_permintaan` varchar(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `tgl_input` date NOT NULL,
  `jml_barang` int(20) NOT NULL,
  `jml_qty` int(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblreq`
--

INSERT INTO `tblreq` (`no_permintaan`, `user_id`, `tgl_input`, `jml_barang`, `jml_qty`, `status`) VALUES
('0906202203404422', 2, '2022-06-09', 6, 10, 2),
('0906202203413488', 2, '2022-06-09', 7, 13, 1),
('0906202203415089', 2, '2022-06-09', 7, 13, 0),
('0906202203421889', 2, '2022-06-09', 7, 13, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblreqdetail`
--

CREATE TABLE `tblreqdetail` (
  `id` int(100) NOT NULL,
  `no_permintaan` varchar(100) NOT NULL,
  `product_code` varchar(25) NOT NULL,
  `qty` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblreqdetail`
--

INSERT INTO `tblreqdetail` (`id`, `no_permintaan`, `product_code`, `qty`) VALUES
(1, '0906202203404422', '1023', 2),
(2, '0906202203404422', '1024', 2),
(3, '0906202203404422', '1026', 1),
(4, '0906202203404422', '1027', 1),
(5, '0906202203404422', '1028', 1),
(6, '0906202203404422', '1029', 3),
(7, '0906202203413488', '1023', 2),
(8, '0906202203413488', '1024', 2),
(9, '0906202203413488', '1027', 1),
(10, '0906202203413488', '1033', 2),
(11, '0906202203413488', '1042', 2),
(12, '0906202203413488', '1041', 1),
(13, '0906202203413488', '1051', 3),
(14, '0906202203415089', '1023', 2),
(15, '0906202203415089', '1024', 2),
(16, '0906202203415089', '1027', 1),
(17, '0906202203415089', '1033', 2),
(18, '0906202203415089', '1042', 2),
(19, '0906202203415089', '1041', 1),
(20, '0906202203415089', '1051', 3),
(21, '0906202203421889', '1023', 2),
(22, '0906202203421889', '1024', 2),
(23, '0906202203421889', '1027', 1),
(24, '0906202203421889', '1033', 2),
(25, '0906202203421889', '1042', 2),
(26, '0906202203421889', '1041', 1),
(27, '0906202203421889', '1051', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblrequestmitra`
--

CREATE TABLE `tblrequestmitra` (
  `id` int(11) NOT NULL,
  `regis_no` varchar(255) NOT NULL,
  `date_req` date NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `C_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblrequestmitra`
--

INSERT INTO `tblrequestmitra` (`id`, `regis_no`, `date_req`, `file`, `status`, `C_ID`) VALUES
(4, 'MITREG2006202203225689', '2022-06-20', 'MITREG2006202203225689_4_kemitraan.docx', 'unconfirmed', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblsaus`
--

CREATE TABLE `tblsaus` (
  `id_saus` varchar(10) NOT NULL,
  `nama_saus` varchar(255) NOT NULL,
  `harga_saus` int(25) NOT NULL,
  `stok_saus` int(10) NOT NULL,
  `keterangan` text NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblsaus`
--

INSERT INTO `tblsaus` (`id_saus`, `nama_saus`, `harga_saus`, `stok_saus`, `keterangan`, `user_id`, `date`) VALUES
('S001', 'Saus Keju', 9000, 50, '-', '2', '2022-06-22'),
('S002', 'Saus BBQ', 7000, 50, '-', '2', '2022-06-22'),
('S003', 'Saus Tartar', 8000, 50, '-', '2', '2022-06-22'),
('S100', 'Tanpa Saus', 0, 10000, '-', '2', '2022-06-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblstockhistory`
--

CREATE TABLE `tblstockhistory` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `qty` int(5) NOT NULL,
  `user_id` varchar(5) NOT NULL,
  `product_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblstockhistory`
--

INSERT INTO `tblstockhistory` (`id`, `date`, `qty`, `user_id`, `product_code`) VALUES
(1, '2020-07-22', 1, '2', '1023'),
(2, '2020-07-22', 2, '2', '1023'),
(3, '2020-08-22', 5, '2', '1023'),
(4, '2020-08-22', 6, '2', '1023'),
(5, '2020-08-22', 3, '2', '1023'),
(6, '2022-06-07', 2, '2', '1023'),
(7, '2022-06-07', 3, '2', '1023'),
(8, '2022-06-07', 4, '2', '1023');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbltransac`
--

CREATE TABLE `tbltransac` (
  `id` int(11) NOT NULL,
  `transac_code` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `transac_type` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `reservation_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `person_count` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbltransac`
--

INSERT INTO `tbltransac` (`id`, `transac_code`, `date`, `transac_type`, `status`, `total_price`, `reservation_date_time`, `person_count`, `customer_id`) VALUES
(2, 'DEL2406202205023689', '2022/06/24', 'reservasi', 0, 650000, '2022-06-24 22:02:36', 0, 5),
(3, 'DEL2406202205040181', '2022/06/24', 'reservasi', 0, 650000, '2022-06-24 22:04:01', 0, 5),
(4, 'DEL2406202205152159', '2022/06/24', 'reservasi', 0, 684000, '2022-06-24 22:15:21', 0, 5),
(5, 'DEL2406202206365142', '2022/06/24', 'reservasi', 4, 891000, '2022-06-24 23:36:51', 0, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbltransacdetail`
--

CREATE TABLE `tbltransacdetail` (
  `id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `kd_saus` varchar(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `transac_code` varchar(255) NOT NULL,
  `harga` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbltransacdetail`
--

INSERT INTO `tbltransacdetail` (`id`, `product_code`, `kd_saus`, `qty`, `transac_code`, `harga`) VALUES
(38, '49', 'S001', 2, 'DEL2406202205023689', 118000),
(39, '46', 'S100', 2, 'DEL2406202205023689', 414000),
(40, '49', 'S001', 2, 'DEL2406202205023689', 118000),
(41, '49', 'S001', 2, 'DEL2406202205040181', 118000),
(42, '46', 'S100', 2, 'DEL2406202205040181', 414000),
(43, '49', 'S001', 2, 'DEL2406202205040181', 118000),
(44, '49', 'S001', 2, 'DEL2406202205152159', 118000),
(45, '46', 'S100', 2, 'DEL2406202205152159', 414000),
(46, '49', 'S001', 2, 'DEL2406202205152159', 118000),
(47, '53', 'S100', 2, 'DEL2406202205152159', 24000),
(48, '52', 'S100', 1, 'DEL2406202205152159', 10000),
(49, '49', 'S001', 2, 'DEL2406202206365142', 118000),
(50, '46', 'S100', 2, 'DEL2406202206365142', 414000),
(51, '49', 'S001', 2, 'DEL2406202206365142', 118000),
(52, '53', 'S100', 2, 'DEL2406202206365142', 24000),
(53, '52', 'S100', 1, 'DEL2406202206365142', 10000),
(54, '46', 'S002', 1, 'DEL2406202206365142', 207000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblusers`
--

CREATE TABLE `tblusers` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` int(11) NOT NULL,
  `address` text NOT NULL,
  `position` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pass` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tblusers`
--

INSERT INTO `tblusers` (`user_id`, `fname`, `lname`, `email`, `contact`, `address`, `position`, `username`, `pass`) VALUES
(2, 'Regi', 'Sacarisa', 'caren@yahoo.com', 0, '', 'Admin', 'admin', '$2y$10$ds1gqSSjIHq/I7c.Ly/w9eF.OPgcXyeG09wL71loBGy0qLkNzUZlS');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tblautonumber`
--
ALTER TABLE `tblautonumber`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`kd_cart`);

--
-- Indeks untuk tabel `tblcartdetail`
--
ALTER TABLE `tblcartdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`C_ID`);

--
-- Indeks untuk tabel `tbldelivery`
--
ALTER TABLE `tbldelivery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbldetailrequestmitra`
--
ALTER TABLE `tbldetailrequestmitra`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `FK_tblproducts_tblsupplier` (`user_id`);

--
-- Indeks untuk tabel `tblreq`
--
ALTER TABLE `tblreq`
  ADD PRIMARY KEY (`no_permintaan`);

--
-- Indeks untuk tabel `tblreqdetail`
--
ALTER TABLE `tblreqdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblrequestmitra`
--
ALTER TABLE `tblrequestmitra`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblsaus`
--
ALTER TABLE `tblsaus`
  ADD PRIMARY KEY (`id_saus`);

--
-- Indeks untuk tabel `tblstockhistory`
--
ALTER TABLE `tblstockhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbltransac`
--
ALTER TABLE `tbltransac`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tbltransac_details_tblcustomer` (`customer_id`);

--
-- Indeks untuk tabel `tbltransacdetail`
--
ALTER TABLE `tbltransacdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tblautonumber`
--
ALTER TABLE `tblautonumber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tblcartdetail`
--
ALTER TABLE `tblcartdetail`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `C_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbldelivery`
--
ALTER TABLE `tbldelivery`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbldetailrequestmitra`
--
ALTER TABLE `tbldetailrequestmitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `tblreqdetail`
--
ALTER TABLE `tblreqdetail`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tblrequestmitra`
--
ALTER TABLE `tblrequestmitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tblstockhistory`
--
ALTER TABLE `tblstockhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbltransac`
--
ALTER TABLE `tbltransac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbltransacdetail`
--
ALTER TABLE `tbltransacdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
