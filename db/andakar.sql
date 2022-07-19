-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jul 2022 pada 14.58
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
-- Struktur dari tabel `tblalamat`
--

CREATE TABLE `tblalamat` (
  `id_alamat` int(50) NOT NULL,
  `alamat` text NOT NULL,
  `c_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblalamat`
--

INSERT INTO `tblalamat` (`id_alamat`, `alamat`, `c_id`) VALUES
(10, 'Jl Raya Semarang Demak Km 5,6 Pangkalan Truk Genuk Gudang AA-24, Jawa Tengah', 4),
(11, 'Jl RS Fatmawati 39 Pus Niaga Duta Mas Fatmawati Bl D-1/29, Dki Jakarta', 4),
(12, 'Jl Prof Dr Latumeten Kompl Grogol Permai Bl C/41-44, Dki Jakarta', 4),
(13, 'Jl Jend Sudirman Kav 52-53 Ged Artha Graha, Dki Jakarta', 4),
(14, 'Mandiri Building 5th Floor, JL. Imam Bonjol No. 16D, Medan', 4),
(25, 'alamat 2', 5),
(27, 'jalan kampung tuyul', 11);

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
(1, 1000, 91, 1, 'PROD');

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
(7, '2022-06-30 18:42:25', 'BTLNSCAT3006202203590738.jpg', 'lunas', 0, 'customer', '', '', 'CAT3006202203590738'),
(8, '2022-07-03 09:30:49', 'BTCAT0307202209282463.jpg', 'deny_adm_dp', 100000, 'customer', '', 'Karena terlalu sering tidak sesuai', 'CAT0307202209282463'),
(9, '0000-00-00 00:00:00', 'BTDPCAT0307202209282463.jpg', 'deny_adm_dp', 100000, 'admin', '', '', 'CAT0307202209282463'),
(10, '2022-07-04 14:08:11', 'BTRES0407202201440047.jpg', 'dp', 0, 'customer', '', '', 'RES0407202201440047'),
(11, '2022-07-04 14:43:52', 'BTCAT0407202202433553.jpg', 'dp', 0, 'customer', '', '', 'CAT0407202202433553'),
(12, '2022-07-04 14:44:47', 'BTLNSCAT0407202202433553.jpg', 'lunas', 0, 'customer', '', '', 'CAT0407202202433553'),
(13, '2022-07-04 15:26:35', 'BTLNSRES0407202201440047.jpg', 'lunas', 0, 'customer', '', '', 'RES0407202201440047'),
(14, '2022-07-04 15:40:44', 'BTRES0407202203402921.jpg', 'deny_adm_lns', 500000, 'customer', '', 'terlalu sering salah', 'RES0407202203402921'),
(15, '2022-07-04 15:53:09', 'BTLNSRES0407202203402921.jpg', 'deny_adm_lns', 500000, 'customer', '', 'terlalu sering salah', 'RES0407202203402921'),
(16, '0000-00-00 00:00:00', 'BTREVLNSRES0407202203402921.jpg', 'revisi_pelunasan', 500000, 'admin', '', '', 'RES0407202203402921'),
(17, '0000-00-00 00:00:00', 'BTREVLNSRES0407202203402921.jpg', 'deny_adm_lns', 500000, 'admin', '', '', 'RES0407202203402921'),
(18, '2022-07-05 05:08:20', 'BTCAT0507202204522499.jpg', 'deny_adm_lns', 240000, 'customer', '', 'terlalu sering salah', 'CAT0507202204522499'),
(19, '2022-07-05 05:12:58', 'BTCAT0507202204522499.jpg', 'deny_adm_lns', 240000, 'customer', '', 'terlalu sering salah', 'CAT0507202204522499'),
(20, '0000-00-00 00:00:00', 'BTDPCAT0507202204522499.jpg', 'revisi_pelunasan', 240000, 'admin', '', '', 'CAT0507202204522499'),
(21, '0000-00-00 00:00:00', 'BTDPCAT0507202204522499.jpg', 'revisi_pelunasan', 240000, 'admin', '', '', 'CAT0507202204522499'),
(22, '0000-00-00 00:00:00', 'BTDPCAT0507202204522499.jpg', 'revisi_pelunasan', 240000, 'admin', '', '', 'CAT0507202204522499'),
(23, '0000-00-00 00:00:00', 'BTDPCAT0507202204522499.jpg', 'revisi_pelunasan', 240000, 'admin', '', '', 'CAT0507202204522499'),
(24, '0000-00-00 00:00:00', 'BTREVLNSCAT0507202204522499.jpg', 'deny_adm_lns', 240000, 'admin', '', '', 'CAT0507202204522499'),
(25, '2022-07-05 09:49:17', 'BTDEL0507202209484953.jpg', 'paid', 0, 'customer', '', '', 'DEL0507202209484953'),
(26, '2022-07-05 16:42:36', 'BTCAT0507202204422629.jpg', 'dp', 0, 'customer', '', '', 'CAT0507202204422629'),
(27, '2022-07-05 16:43:26', 'BTLNSCAT0507202204422629.jpg', 'lunas', 0, 'customer', '', '', 'CAT0507202204422629'),
(28, '2022-07-05 16:50:49', 'BTCAT0507202204503918.jpg', 'dp', 0, 'customer', '', '', 'CAT0507202204503918'),
(29, '2022-07-05 16:51:47', 'BTLNSCAT0507202204503918.jpg', 'lunas', 0, 'customer', '', '', 'CAT0507202204503918'),
(30, '2022-07-05 16:55:37', 'BTCAT0507202204524824.jpg', 'dp', 0, 'customer', '', '', 'CAT0507202204524824'),
(31, '2022-07-05 16:56:12', 'BTLNSCAT0507202204524824.jpg', 'lunas', 0, 'customer', '', '', 'CAT0507202204524824'),
(32, '2022-07-06 05:49:12', 'BTDEL0607202205484834.jpg', 'paid', 0, 'customer', '', '', 'DEL0607202205484834'),
(33, '2022-07-13 09:28:09', 'BTDEL1307202209221376.jpg', 'paid', 0, 'customer', '', '', 'DEL1307202209221376'),
(34, '2022-07-13 09:43:27', 'BTRES1307202209405789.jpg', 'dp', 0, 'customer', '', '', 'RES1307202209405789'),
(35, '2022-07-13 09:43:45', 'BTLNSRES1307202209405789.jpg', 'lunas', 0, 'customer', '', '', 'RES1307202209405789'),
(36, '2022-07-17 08:22:35', 'BTDEL1707202208221633.png', 'paid', 0, 'customer', '', '', 'DEL1707202208221633'),
(37, '2022-07-17 17:17:29', 'BTDEL1707202205171165.jpg', 'paid', 0, 'customer', '', '', 'DEL1707202205171165'),
(38, '2022-07-17 17:25:15', 'BTRES1707202205250117.jpg', 'dp', 0, 'customer', '', '', 'RES1707202205250117'),
(39, '2022-07-17 17:29:29', 'BTLNSRES1707202205250117.jpg', 'lunas', 0, 'customer', '', '', 'RES1707202205250117'),
(40, '2022-07-17 17:32:09', 'BTCAT1707202205315175.jpg', 'dp', 0, 'customer', '', '', 'CAT1707202205315175'),
(41, '2022-07-17 17:32:40', 'BTLNSCAT1707202205315175.jpg', 'lunas', 0, 'customer', '', '', 'CAT1707202205315175');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblcart`
--

CREATE TABLE `tblcart` (
  `kd_cart` varchar(255) NOT NULL,
  `jenis_cart` varchar(50) NOT NULL,
  `total` int(50) NOT NULL,
  `date` date NOT NULL,
  `c_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(13, 'Juice');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `C_ID` int(50) NOT NULL,
  `C_FNAME` varchar(50) NOT NULL,
  `C_LNAME` varchar(50) NOT NULL,
  `C_AGE` int(2) NOT NULL,
  `C_ADRESSID` int(25) NOT NULL,
  `C_PNUMBER` varchar(50) NOT NULL,
  `C_GENDER` varchar(50) NOT NULL,
  `C_AKSES` varchar(25) NOT NULL,
  `C_EMAILADD` varchar(50) NOT NULL,
  `ZIPCODE` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tblcustomer`
--

INSERT INTO `tblcustomer` (`C_ID`, `C_FNAME`, `C_LNAME`, `C_AGE`, `C_ADRESSID`, `C_PNUMBER`, `C_GENDER`, `C_AKSES`, `C_EMAILADD`, `ZIPCODE`, `username`, `password`) VALUES
(4, 'Nadya', 'Minerva', 25, 11, '082346578919', 'Perempuan', 'Customer', 'emak@gmail.com', 'asd', 'admin', '$2y$10$Nz4hwMNDYxc63dBtJ7TGl.zgvt6UXNIylukyWgRxdgvosgy5wtQOy'),
(5, 'sumail', 'cofeen', 20, 25, '0823123123', 'Laki-Laki', 'Customer', 'sumail@gmail.com', '40222', 'sumail', '$2y$10$Nz4hwMNDYxc63dBtJ7TGl.zgvt6UXNIylukyWgRxdgvosgy5wtQOy'),
(6, 'ridwan', 'remin', 21, 0, '312312', 'Laki-Laki', 'Customer', '123@gmail.com', '4321', 'ridwan12', '$2y$10$XZw1u9HtZtDpLXMsUtbHUe4m0ztA8kUttAhXpVxD71cFb9GFnkpn2'),
(11, 'Muhammad', 'Ridwan', 22, 27, '83894799380', 'Laki-Laki', 'Mitra', 'mridwane01@gmail.com', '4321', 'mridwane', '$2y$10$Ga3NPy50IwrLygWc940t/.saCTH.YdlaeOFc6VnV0ogeklgVZEWrG');

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
(55, 'Tenderloin Lokal', '2022-07-17', 1, 2, 'Tersedia', 'Makanan-Utama', 102000, '1066tenderloin-steak.jpg', 'Tenderloin atau has dalam SAPI LOKAL adalah daging sapi dari bagian tengah badan. Sesuai dengan karakteristik daging has, daging ini terdiri dari bagian-bagian otot utama di sekitar bagian tulang bela'),
(56, 'Rib Eye Lokal', '2022-07-17', 1, 2, 'Tersedia', 'Makanan-Utama', 96000, '1067rib-eye.jpg', 'Rib Eye merupakan bagian sekitar tulang rusuk pada sapi. Daging pada bagian yang sering dikenal dengan tulang iga ini mempunyai tingkat keempukan yang hampir sempurna.'),
(57, 'Sirloin Lokal', '2022-07-17', 1, 2, 'Tersedia', 'Makanan-Utama', 92000, '1068sirloin2.jpg', 'Sirloin merupakan bagian daging yang mengandung lemak lebih banyak dibandingkan tenderloin. Bila dimasak dengan tepat dan baik akan menghasilkan steak yang juicy (berair), gurih, dan empuk.'),
(58, 'Tenderloin Import', '2022-07-17', 1, 2, 'Tersedia', 'Makanan-Utama', 125000, '1069tenderloin-steak.jpg', 'Steak tenderloin juga biasa disebut khas dalam, fillet, atau fillet mignon. Dagingnya terletak di bagian tengah sapi.'),
(59, 'Rib Eye Import', '2022-07-17', 1, 2, 'Tersedia', 'Makanan Utama', 104000, '1070prime-ribeye.jpg', ''),
(60, 'Sirloin Import', '2022-07-17', 1, 2, 'Tersedia', 'Makanan Utama', 100000, '1071sirloin3.jpg', ''),
(61, 'T-Bone Import', '2022-07-17', 1, 2, 'Tersedia', 'Makanan Utama', 145000, '1072t-bone.jpg', 'Berat 300gr'),
(62, 'Iga Panggang Regular', '2022-07-17', 2, 2, 'Tersedia', 'Makanan Utama', 85000, '1073iga-reguler.jpg', ''),
(63, 'Iga Barbar', '2022-07-17', 2, 2, 'Tersedia', 'Makanan Utama', 160000, '1074iga-barbar2.jpg', ''),
(64, 'Chris Ribs', '2022-07-17', 2, 2, 'Tersedia', 'Makanan Utama', 175000, '1075chris-ribs3.jpg', ''),
(65, 'Lamb Shank', '2022-07-17', 3, 2, 'Tersedia', 'Makanan Utama', 92000, '1076lamb-shank.jpg', 'potongan daging betis atau sengkel kambing'),
(66, 'Chicken Wings', '2022-07-17', 5, 2, 'Tersedia', 'Makanan Utama', 40000, '1077bbq-chicken-wings3.jpg', '6 Pieces with french fries'),
(67, 'Boneless Chicken Steak', '2022-07-17', 5, 2, 'Tersedia', 'Makanan Utama', 55000, '1078boneless-chicken3.jpg', ''),
(68, 'Dorry Fillet', '2022-07-17', 6, 2, 'Tersedia', 'Makanan Utama', 62000, '1079dory-steak.jpg', ''),
(69, 'Fish and Chips', '2022-07-17', 6, 2, 'Tersedia', 'Makanan Utama', 75000, '1080fish-and-cips2.jpg', 'Fish and Chips adalah daging ikan berbalut tepung yang disajikan dengan kentang.'),
(70, 'Salmon Steak', '2022-07-17', 6, 2, 'Tersedia', 'Makanan Utama', 105000, '1081salmon-steak3.jpg', ''),
(71, 'Potato Wedges', '2022-07-17', 7, 2, 'Tersedia', 'Makanan-Pendamping', 20000, '1082potato-wedges.jpg', ''),
(72, 'Mix Vagatable', '2022-07-17', 7, 2, 'Tersedia', 'Makanan Pendamping', 25000, '1083mix-vagatables.jpg', ''),
(73, 'Sosis', '2022-07-17', 7, 2, 'Tersedia', 'Makanan Pendamping', 20000, '1084sosis bakar.jpg', ''),
(74, 'Pie Apel', '2022-07-17', 8, 2, 'Tersedia', 'Makanan Penutup', 23000, '1085pie2.jpg', 'Pie Isi Apel'),
(75, 'Complete Burger', '2022-07-17', 9, 2, 'Tersedia', 'Makanan Utama', 70000, '1086complete-burger.jpg', ''),
(76, 'Strawberry Milkshake', '2022-07-17', 10, 2, 'Tersedia', 'Minuman', 37000, '1087strawberry-milkshake.jpg', ''),
(77, 'Jus Mangga', '2022-07-17', 13, 2, 'Tersedia', 'Minuman', 31000, '1088jus-mangga.jpg', '');

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
  `note` text NOT NULL,
  `C_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblrequestmitra`
--

INSERT INTO `tblrequestmitra` (`id`, `regis_no`, `date_req`, `file`, `status`, `note`, `C_ID`) VALUES
(4, 'MITREG2006202203225689', '2022-06-20', 'MITREG2006202203225689_4_kemitraan.docx', 'interview', 'Selamat anda diterima sebagai mitra kami', 4),
(5, 'MITREG1507202204320195', '2022-07-15', 'MITREG1507202204320195_11_kemitraan.docx', 'interview', 'Selamat anda Lolos administrasi', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblsaus`
--

CREATE TABLE `tblsaus` (
  `id_saus` varchar(10) NOT NULL,
  `nama_saus` varchar(255) NOT NULL,
  `harga_saus` int(25) NOT NULL,
  `stok_saus` varchar(55) NOT NULL,
  `keterangan` text NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `date_saus` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblsaus`
--

INSERT INTO `tblsaus` (`id_saus`, `nama_saus`, `harga_saus`, `stok_saus`, `keterangan`, `user_id`, `date_saus`) VALUES
('', 'BBQ ', 0, 'Tersedia', 'Saus Baebeque', '2', '2022-07-17'),
('S100', 'Tanpa Saus', 0, 'Tersedia', '-', '2', '2022-06-24');

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
  `status` varchar(255) NOT NULL,
  `total_price` int(11) NOT NULL,
  `reservation_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `person_count` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbltransac`
--

INSERT INTO `tbltransac` (`id`, `transac_code`, `date`, `transac_type`, `status`, `total_price`, `reservation_date_time`, `person_count`, `customer_id`) VALUES
(34, 'DEL1707202205171165', '2022/07/17', 'Delivery', 'done', 115600, '2022-07-17 22:17:11', 0, 4),
(35, 'RES1707202205250117', '2022/07/17', 'Reservasi', 'lunas', 96000, '2022-07-17 01:24:00', 1, 4),
(36, 'CAT1707202205315175', '2022-07-17', 'Catering', 'lunas', 5074000, '2022-07-21 02:31:00', 0, 4);

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
(85, '56', 'S100', 1, 'DEL1707202205171165', 96000),
(86, '56', 'S100', 1, 'RES1707202205250117', 96000),
(87, '56', 'S100', 37, 'CAT1707202205315175', 3552000),
(88, '57', 'S100', 11, 'CAT1707202205315175', 1012000),
(89, '55', 'S100', 5, 'CAT1707202205315175', 510000);

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
(2, 'Regi', 'Sacarisa', 'caren@yahoo.com', 0, '', 'Admin Master', 'admin', '$2y$10$ds1gqSSjIHq/I7c.Ly/w9eF.OPgcXyeG09wL71loBGy0qLkNzUZlS'),
(5, 'Udin', 'Sedunia', 'iiiii@gmail.com', 2147483647, '0', 'Crew', 'udin', '$2y$10$4ohkY82iyQ2xGOkKPWSQ3O6zzjCxFiPmTVQDaViwRjK6HTyAtrm3q'),
(7, 'Asep', 'Si keungan', 'asep@gmail.com', 2147483647, '0', 'Admin Finance', 'asep', '$2y$10$QMQL8pZG7RzCzg17NpXFCuDMSj7zTU.pPTU4uHvvIr0RuXHSwZ/QC');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tblalamat`
--
ALTER TABLE `tblalamat`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indeks untuk tabel `tblautonumber`
--
ALTER TABLE `tblautonumber`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblbuktitransfer`
--
ALTER TABLE `tblbuktitransfer`
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
-- AUTO_INCREMENT untuk tabel `tblalamat`
--
ALTER TABLE `tblalamat`
  MODIFY `id_alamat` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tblautonumber`
--
ALTER TABLE `tblautonumber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tblbuktitransfer`
--
ALTER TABLE `tblbuktitransfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `tblcartdetail`
--
ALTER TABLE `tblcartdetail`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT untuk tabel `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `C_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `tblreqdetail`
--
ALTER TABLE `tblreqdetail`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tblrequestmitra`
--
ALTER TABLE `tblrequestmitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tblstockhistory`
--
ALTER TABLE `tblstockhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbltransac`
--
ALTER TABLE `tbltransac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `tbltransacdetail`
--
ALTER TABLE `tbltransacdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
