-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Agu 2022 pada 06.11
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
(27, 'jalan kampung', 11),
(28, 'Bandung', 13),
(29, 'Jalanudin', 12),
(31, 'Jl. Rawa Domba No.1A, RW.7, Duren Sawit, Kec. Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13440.', 2),
(32, 'Jl. Cipinang Baru Timur No.15, RT.2/RW.18, Cipinang, Kec. Pulo Gadung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13240.', 2),
(33, 'JL. Terusan I Gusti Ngurah Rai, No. 18A, Duren Sawit, RT.5/RW.9, Jatinegara, Kec. Cakung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13460', 6),
(34, 'Jl. Cipinang Muaral II No.14 Kec.Duren Sawit Jakarta Timur', 2);

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
(1, 1000, 121, 1, 'PROD');

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
(1, '2022-08-15 08:05:50', 'BTDEL1508202208045248.jpeg', 'paid', 0, 'customer', '', '', 'DEL1508202208045248'),
(2, '2022-08-15 08:18:14', 'BTRES1508202208175979.jpeg', 'dp', 0, 'customer', '', '', 'RES1508202208175979'),
(3, '2022-08-15 08:21:24', 'BTLNSRES1508202208175979.jpeg', 'lunas', 0, 'customer', '', '', 'RES1508202208175979'),
(4, '2022-08-15 08:28:34', 'BTCAT1508202208282352.jpeg', 'dp', 0, 'customer', '', '', 'CAT1508202208282352'),
(5, '2022-08-15 08:30:39', 'BTLNSCAT1508202208282352.jpeg', 'lunas', 0, 'customer', '', '', 'CAT1508202208282352'),
(6, '2022-08-15 11:18:11', 'BTDEL1508202210382013.jpeg', 'paid', 0, 'customer', '', '', 'DEL1508202210382013'),
(7, '2022-08-15 22:59:25', 'BTDEL1508202210583916.jpeg', 'paid', 0, 'customer', '', '', 'DEL1508202210583916'),
(8, '2022-08-15 23:10:14', 'BTCAT1508202211093376.jpeg', 'dp', 0, 'customer', '', '', 'CAT1508202211093376'),
(9, '2022-08-15 23:12:20', 'BTLNSCAT1508202211093376.jpeg', 'lunas', 0, 'customer', '', '', 'CAT1508202211093376'),
(10, '2022-08-16 00:34:50', 'BTDEL1608202212341512.jpeg', 'paid', 0, 'customer', '', '', 'DEL1608202212341512'),
(11, '2022-08-16 00:38:35', 'BTRES1608202212382219.jpeg', 'deny_adm_dp', 55550, 'customer', '', 'Tempat Penuh', 'RES1608202212382219'),
(12, '0000-00-00 00:00:00', 'BTDPRES1608202212382219.jpeg', 'deny_adm_dp', 55550, 'admin', '', '', 'RES1608202212382219'),
(13, '2022-08-16 00:44:07', 'BTCAT1608202212415734.jpeg', 'dp', 0, 'customer', '', '', 'CAT1608202212415734'),
(14, '2022-08-16 00:45:11', 'BTLNSCAT1608202212415734.jpeg', 'lunas', 0, 'customer', '', '', 'CAT1608202212415734'),
(15, '2022-08-17 04:28:17', 'BTDEL1708202204274860.png', 'paid', 0, 'customer', '', '', 'DEL1708202204274860'),
(16, '2022-08-17 04:53:07', 'BTRES1708202204525123.png', 'dp', 0, 'customer', '', '', 'RES1708202204525123'),
(17, '2022-08-17 04:57:25', 'BTRES1708202204571790.png', 'dp', 0, 'customer', '', '', 'RES1708202204571790'),
(18, '2022-08-17 04:58:38', 'BTLNSRES1708202204571790.jpeg', 'lunas', 0, 'customer', '', '', 'RES1708202204571790'),
(19, '2022-08-17 05:04:37', 'BTCAT1708202205042258.png', 'dp', 0, 'customer', '', '', 'CAT1708202205042258'),
(20, '2022-08-17 05:06:19', 'BTLNSCAT1708202205042258.png', 'lunas', 0, 'customer', '', '', 'CAT1708202205042258');

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

--
-- Dumping data untuk tabel `tblcart`
--

INSERT INTO `tblcart` (`kd_cart`, `jenis_cart`, `total`, `date`, `c_id`) VALUES
('Reservasi2', 'Reservasi', 101000, '2022-08-16', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblcartdetail`
--

CREATE TABLE `tblcartdetail` (
  `id` int(100) NOT NULL,
  `kd_cart` varchar(255) NOT NULL,
  `kd_menu` int(11) NOT NULL,
  `kd_saus` varchar(11) DEFAULT NULL,
  `kematangan` varchar(50) NOT NULL,
  `qty` int(10) NOT NULL,
  `harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tblcartdetail`
--

INSERT INTO `tblcartdetail` (`id`, `kd_cart`, `kd_menu`, `kd_saus`, `kematangan`, `qty`, `harga`) VALUES
(22, 'Reservasi2', 2, 'S1117', '', 1, 101000);

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
(1, '', '', 0, 0, '', '', '', '', '4321', '', '$2y$10$inOw2U9lwOmkwibHW76Me.5u8gcPFBo7nerCL3qAEZyS0QkAPqTMq'),
(2, 'Regi', 'Sacharissa', 21, 34, '085759082279', 'Perempuan', 'Customer', 'regigunawan730@gmail.com', '4321', 'rgsch', '$2y$10$0V1HNwSObPUR0nB5vOahB.ofe4IlS2rmpwNOKmN3OtNjumtTSaAWK'),
(3, 'vincent', 'rompies', 21, 0, '08123', 'Laki-Laki', 'Customer', 'vincent@gmail.com', '4321', 'vincent', '$2y$10$GiOKVl.7/2/SoUB07UcwjeleoU1KNkrZyWfmm.gWBsluaGk36ak02'),
(4, 'Wawan', 'adil', 23, 12, '08119635487023', 'Laki-Laki', 'Customer', 'wawan@gmail.com', '4321', 'wawan', '$2y$10$QvIvLS71iM.p2U4xRsFo/.H/rhw7Yir2OkbMfAmi78Gui9X7hdktm'),
(5, 'test', 'user', 21, 0, '087234234', 'Laki-Laki', 'Customer', 'test@gmail.com', '4321', 'testuser', '$2y$10$p0ekrsnM8HBkOvfVqyfVOe5NUMDOXZbnASAPBLn.2Qnwltk1QBxs6'),
(6, 'Stanley', 'Owen', 22, 33, '0888666221', 'Laki-Laki', 'Mitra', 'owen@gmail.com', '4321', 'stnly', '$2y$10$qkJtedZxTvRzbDjy33lxuOdCRGWxut35NIW8D5sUvACGaDQwdEFBC'),
(7, 'Muhammad ', 'Suherman', 33, 0, '081978899076', 'Laki-Laki', 'Mitra', 'suherman@gmail.com', '4321', 'suherman', '$2y$10$RvQDDK8366H4aqHg4wRxROJLqhQns30C5hqMruU9vWIMoCCkk9Jbu'),
(8, 'lala', 'pohh', 22, 0, '081987890167', 'Laki-Laki', 'Mitra', 'lala@gmail.com', '4321', 'lala', '$2y$10$bTAtkies2xmB2fc6vHgyG.Rm25NpOaIfSrTQDO1hWe86LoOR9pqb2'),
(9, 'Sacharissa', 'Gunawan', 21, 0, '85759082279', 'Perempuan', 'Mitra', 'regi@gmail.com', '4321', 'regisg', '$2y$10$9FdFAQeMJjgy46XZ4hyj8.f1bIRojBT/g38Zn3e3VX.mClsk4e4lq'),
(10, 'rissa', 'gunawan', 21, 0, '0879646567', 'Perempuan', 'Mitra', 'regigunawan730@gmail.com', '4321', 'rissa', '$2y$10$m7bbyjhm4z45ScFGrp9gFeccn1CV53nPrtc.MLasGlW.yFNO5Jdyy');

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
(1, 'Tenderloin Lokal', '2022-08-15', 1, 2, 'Tersedia', 'Makanan-Utama', 102000, '1097tenderloin-steak.jpg', 'Pilihan Saus BBQ, Black Pepper, Mushroom, Tartar'),
(2, 'Rib Eye Lokal', '2022-08-15', 1, 2, 'Tersedia', 'Makanan-Utama', 96000, '1098rib-eye.jpg', 'Pilihan Saus : BBQ, Black Pepper, Mushroom, Tartar'),
(4, 'Sirloin Lokal', '2022-08-15', 1, 5, 'Tersedia', 'Makanan-Utama', 92000, '1100sirloin3.jpg', 'Pilihan Saus : BBQ, Black Pepper, Mushroom, Tartar dll'),
(5, 'Tenderloin Import', '2022-08-15', 1, 5, 'Tersedia', 'Makanan-Utama', 125000, '1101tenderloin-steak3.jpg', 'Pilihan Saus : BBQ, Black Pepper, Mushroom, Tartar dll'),
(6, 'Iga Panggang Reguller', '2022-08-15', 2, 5, 'Tersedia', 'Makanan-Utama', 85000, '1102iga-reguler.jpg', 'Pilihan Saus : BBQ, Black Pepper, Mushroom, Tartar dll'),
(7, 'Chris Ribs', '2022-08-15', 2, 2, 'Tersedia', 'Makanan-Utama', 175000, '1103chris-ribs3.jpg', 'Pilihan Saus : BBQ, Black Pepper, Mushroom, Tartar dll'),
(8, 'Lamb Shank (Import)', '2022-08-15', 3, 2, 'Tersedia', 'Makanan-Utama', 142000, '1104lamb-shank.jpg', 'Pilihan Saus : BBQ, Black Pepper, Mushroom, Tartar dll'),
(9, 'Chicken Wings', '2022-08-15', 5, 2, 'Tersedia', 'Makanan-Utama', 40000, '1105bbq-chicken-wings2.jpg', '6 potong dengan kentang goreng '),
(10, 'Boneless Chicken Steak', '2022-08-15', 5, 2, 'Tersedia', 'Makanan-Utama', 55000, '1106boneless-chicken.jpg', 'Pilihan Saus : BBQ, Black Pepper, Mushroom, Tartar dll'),
(11, 'Dory Fillet', '2022-08-15', 1, 2, 'Tersedia', 'Makanan-Utama', 62000, '1107dory-steak.jpg', 'Pilihan Saus : BBQ, Black Pepper, Mushroom, Tartar dll'),
(12, 'Fish and Chips', '2022-08-15', 6, 2, 'Tersedia', 'Makanan-Utama', 75000, '1108fish-and-cips.jpg', 'Pilihan Saus : BBQ, Black Pepper, Mushroom, Tartar dll'),
(13, 'Potato Wedge', '2022-08-15', 7, 2, 'Tersedia', 'Makanan-Pendamping', 20000, '1109potato-wedges.jpg', 'Potongan kentang dengan bubuk daun seledri'),
(14, 'Mix Vegetable', '2022-08-15', 7, 2, 'Tersedia', 'Makanan-Pendamping', 25000, '1110mix-vagatables.jpg', 'Potongan dari berbagai macam sayur segar '),
(15, 'Pie Apel', '2022-08-15', 8, 2, 'Tersedia', 'Makanan-Penutup', 23000, '1111pie.jpg', 'Adonan pastry yang dijadikan sebagai luaran, kemudian diisi dengan apel'),
(16, 'Air Putih', '2022-08-15', 10, 2, 'Tersedia', 'Minuman', 12000, '1112mineral.jpg', 'Air Putih '),
(17, 'Strawberry Milkshake', '2022-08-15', 11, 2, 'Tersedia', 'Minuman', 37000, '1113strawberry-milkshake.jpg', 'Dari campuran susu, es krim, dan strawberry '),
(18, 'Ice Cream Coklat', '2022-08-15', 11, 2, 'Tersedia', 'Minuman', 12000, '1114icecream-choco.jpg', 'Ice Cream Rasa Coklat'),
(19, 'Jus Mangga', '2022-08-15', 13, 2, 'Tersedia', 'Minuman', 31000, '1115jus-mangga.jpg', 'Dari buah mangga segar dan terpilih'),
(20, 'Rib Eye Import', '2022-08-16', 1, 11, 'Tersedia', 'Makanan-Utama', 104000, '1120rib-eye.jpg', 'Rib Eye Import 300gr');

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
(1, 'MIT1508202208372851', '2022-08-15', 'MIT1508202208372851_6_kemitraan.pdf', 'active', 'selamat telah menjadi mitra kami', 6),
(2, 'MIT1608202212494696', '2022-08-16', 'MIT1608202212494696_9_kemitraan.pdf', 'active', 'Selamat anda diterima', 9),
(3, 'MIT1608202203551455', '2022-08-16', 'MIT1608202203551455_10_kemitraan.pdf', 'interview', 'Selamat anda kami undang untuk Interview di perusahaan kami pada tanggal 2022-08-17 Pukul 12:09 Catatan: gmeet', 10);

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
('S100', 'Tanpa Saus', 0, 'Tersedia', '-', '2', '2022-06-24'),
('S1116', 'BBQ', 0, 'Tersedia', 'Saus rasa Barbeque', '5', '2022-08-15'),
('S1117', 'Black Pepper', 5000, 'Tersedia', 'Saus rasa Blackpepper', '5', '2022-08-15'),
('S1118', 'Mushroom', 5000, 'Tersedia', 'Saus rasa mushroom', '5', '2022-08-15'),
('S1119', 'Tartar', 10000, 'Tersedia', 'Saus Tartar', '5', '2022-08-15');

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
  `subtotal` int(50) NOT NULL,
  `tax_sepuluh` int(20) NOT NULL,
  `tax_lima` int(20) NOT NULL,
  `biaya_kirim` int(20) NOT NULL,
  `dp` int(25) NOT NULL,
  `pelunasan` int(25) NOT NULL,
  `total_price` int(50) NOT NULL,
  `reservation_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `person_count` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `catatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbltransac`
--

INSERT INTO `tbltransac` (`id`, `transac_code`, `date`, `transac_type`, `status`, `subtotal`, `tax_sepuluh`, `tax_lima`, `biaya_kirim`, `dp`, `pelunasan`, `total_price`, `reservation_date_time`, `person_count`, `customer_id`, `catatan`) VALUES
(1, 'DIN1508202201540818', '2022/08/15', 'Dinein', 'done', 0, 0, 0, 0, 0, 0, 139000, '2022-08-15 02:58:17', 0, 5, ''),
(2, 'DEL1508202208045248', '2022/08/15', 'Delivery', 'done', 707000, 70700, 0, 10000, 0, 0, 787700, '2022-08-15 09:09:00', 0, 2, 'Jumlah Pembayaran Kurang -RpÂ 700,00'),
(3, 'DIN1508202208134715', '2022/08/15', 'Dinein', 'done', 0, 0, 0, 0, 0, 0, 202000, '2022-08-15 09:17:55', 0, 5, ''),
(4, 'RES1508202208175979', '2022/08/15', 'Reservasi', 'done', 1302000, 130200, 0, 0, 700000, 732000, 1432200, '2022-08-17 12:09:00', 2, 2, 'Jumlah Pembayaran Kurang -RpÂ 200,00'),
(5, 'CAT1508202208282352', '2022/08/15', 'Catering', 'done', 644000, 64400, 32200, 0, 370000, 370000, 740600, '2022-08-18 17:00:00', 0, 2, 'Jumlah Pembayaran Kurang -RpÂ 600,00'),
(6, 'DEL1508202210382013', '2022/08/15', 'Delivery', 'done', 136000, 13600, 0, 10000, 0, 0, 159600, '2022-08-15 11:42:29', 0, 2, 'Jumlah Pembayaran Kurang -RpÂ 9.600,00'),
(7, 'DEL1508202210583916', '2022/08/15', 'Delivery', 'done', 214000, 21400, 0, 10000, 0, 0, 245400, '2022-08-16 00:02:46', 0, 2, 'Jumlah Pembayaran Kurang -RpÂ 5.400,00'),
(8, 'CAT1508202211093376', '2022/08/15', 'Catering', 'done', 6120000, 612000, 306000, 0, 3500000, 3538000, 7038000, '2022-08-19 10:09:00', 0, 2, 'transfer Sesuai.'),
(9, 'DEL1608202212341512', '2022/08/16', 'Delivery', 'done', 214000, 21400, 0, 10000, 0, 0, 245400, '2022-08-16 01:38:21', 0, 2, 'Jumlah Pembayaran Kurang -RpÂ 5.400,00'),
(10, 'RES1608202212382219', '2022/08/16', 'Reservasi', 'deny_adm_dp', 101000, 10100, 0, 0, 0, 0, 111100, '2022-08-17 11:38:00', 1, 2, ''),
(11, 'CAT1608202212415734', '2022/08/16', 'Catering', 'done', 5400000, 540000, 270000, 0, 3000000, 3210000, 6210000, '2022-08-20 11:42:00', 0, 2, 'transfer Sesuai.'),
(12, 'DIN1608202212460167', '2022/08/16', 'Dinein', 'done', 0, 0, 0, 0, 0, 0, 101000, '2022-08-16 01:50:07', 0, 11, ''),
(13, 'DEL1708202203194474', '2022/08/17', 'Delivery', 'pending', 245000, 24500, 0, 10000, 0, 0, 279500, '2022-08-17 08:19:44', 0, 4, ''),
(14, 'DEL1708202204274860', '2022/08/17', 'Delivery', 'done', 146000, 14600, 0, 10000, 0, 0, 170600, '2022-08-17 09:27:48', 0, 4, 'Jumlah Pembayaran Kurang -Rp 600,00'),
(15, 'RES1708202204525123', '2022/08/17', 'Reservasi', 'dp', 311000, 31100, 0, 0, 0, 0, 342100, '2022-08-19 11:54:00', 3, 4, ''),
(16, 'RES1708202204571790', '2022/08/17', 'Reservasi', 'done', 313000, 31300, 0, 0, 172150, 172150, 344300, '2022-08-19 10:00:00', 2, 4, 'transfer Sesuai.'),
(17, 'CAT1708202205042258', '2022/08/17', 'Catering', 'done', 6392000, 639200, 319600, 0, 2500000, 4850000, 7350800, '2022-08-27 10:04:00', 0, 4, 'Jumlah Pembayaran Kurang -Rp 800,00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbltransacdetail`
--

CREATE TABLE `tbltransacdetail` (
  `id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `kd_saus` varchar(11) DEFAULT NULL,
  `kematangan` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `transac_code` varchar(255) NOT NULL,
  `harga` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbltransacdetail`
--

INSERT INTO `tbltransacdetail` (`id`, `product_code`, `kd_saus`, `kematangan`, `qty`, `transac_code`, `harga`) VALUES
(1, '16', 'S100', '', 1, 'DIN1508202201540818', 12000),
(2, '14', 'S100', '', 1, 'DIN1508202201540818', 25000),
(3, '1', 'S1116', '', 1, 'DIN1508202201540818', 102000),
(4, '2', 'S1117', '', 7, 'DEL1508202208045248', 707000),
(5, '2', 'S1117', '', 2, 'DIN1508202208134715', 202000),
(6, '2', 'S1118', '', 7, 'RES1508202208175979', 707000),
(7, '6', 'S1116', '', 7, 'RES1508202208175979', 595000),
(8, '4', 'S1116', '', 7, 'CAT1508202208282352', 644000),
(9, '6', 'S1117', '', 1, 'DEL1508202210382013', 90000),
(10, '15', 'S100', '', 2, 'DEL1508202210382013', 46000),
(11, '1', 'S1117', '', 2, 'DEL1508202210583916', 214000),
(12, '7', 'S1117', '', 5, 'CAT1508202211093376', 900000),
(13, '7', 'S1118', '', 29, 'CAT1508202211093376', 5220000),
(14, '2', 'S1117', '', 2, 'DEL1608202212341512', 202000),
(15, '16', 'S100', '', 1, 'DEL1608202212341512', 12000),
(16, '2', 'S1117', '', 1, 'RES1608202212382219', 101000),
(17, '9', 'S1117', '', 4, 'CAT1608202212415734', 180000),
(18, '7', 'S1117', '', 29, 'CAT1608202212415734', 5220000),
(19, '2', 'S1118', '', 1, 'DIN1608202212460167', 101000),
(20, '2', 'S1116', '', 1, 'DEL1708202203194474', 96000),
(21, '14', 'S100', '', 1, 'DEL1708202203194474', 25000),
(22, '15', 'S100', '', 1, 'DEL1708202203194474', 23000),
(23, '2', 'S1117', '', 1, 'DEL1708202203194474', 101000),
(24, '2', 'S1117', 'Medium Rare', 1, 'DEL1708202204274860', 101000),
(25, '9', 'S1117', '', 1, 'DEL1708202204274860', 45000),
(26, '9', 'S1117', '', 1, 'RES1708202204525123', 45000),
(27, '4', 'S1119', '', 2, 'RES1708202204525123', 204000),
(28, '17', 'S100', '', 1, 'RES1708202204525123', 37000),
(29, '14', 'S100', '', 1, 'RES1708202204525123', 25000),
(30, '2', 'S1116', 'Medium Well', 1, 'RES1708202204571790', 96000),
(31, '14', 'S100', '', 1, 'RES1708202204571790', 25000),
(32, '7', 'S1117', '', 1, 'RES1708202204571790', 180000),
(33, '18', 'S100', '', 1, 'RES1708202204571790', 12000),
(34, '13', 'S100', '', 2, 'CAT1708202205042258', 40000),
(35, '17', 'S100', '', 1, 'CAT1708202205042258', 37000),
(36, '9', 'S1117', '', 1, 'CAT1708202205042258', 45000),
(37, '2', 'S1117', 'Medium', 58, 'CAT1708202205042258', 5858000),
(38, '7', 'S1118', '', 1, 'CAT1708202205042258', 180000),
(39, '4', 'S1118', 'Well Done', 1, 'CAT1708202205042258', 97000),
(40, '5', 'S1119', 'Rare', 1, 'CAT1708202205042258', 135000);

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
(7, 'Asep', 'Si keungan', 'asep@gmail.com', 2147483647, '0', 'Admin Finance', 'asep', '$2y$10$QMQL8pZG7RzCzg17NpXFCuDMSj7zTU.pPTU4uHvvIr0RuXHSwZ/QC'),
(9, 'muhammad', 'alucard', 'alucard@gmail.com', 899902020, '0', 'Admin Finance', 'alucard', '$2y$10$zodW7f2l0ncdi2U4JECyK.IMw1ioGjaYvGtWk.6Ath0IznD9Mxnsa'),
(10, 'Savier', 'healer', 'savier@gmail.com', 89929300, '0', 'Crew', 'savier', '$2y$10$.PNZaKCAtyBJxCczSdtRm.xsUzZXgJ9wmPxqPal51X4sfiB944WnG'),
(11, 'Rara', 'Putri', 'rara@gmail.com', 2147483647, '0', 'Crew', 'rara', '$2y$10$dCQHUf3RyeFF4KO8DRO.5eYFVKj9BTZERI.HQZELm3gk7O22XBahm');

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
  MODIFY `id_alamat` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tblautonumber`
--
ALTER TABLE `tblautonumber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tblbuktitransfer`
--
ALTER TABLE `tblbuktitransfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tblcartdetail`
--
ALTER TABLE `tblcartdetail`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `C_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbldelivery`
--
ALTER TABLE `tbldelivery`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbldetailrequestmitra`
--
ALTER TABLE `tbldetailrequestmitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tblreqdetail`
--
ALTER TABLE `tblreqdetail`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tblrequestmitra`
--
ALTER TABLE `tblrequestmitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tblstockhistory`
--
ALTER TABLE `tblstockhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbltransac`
--
ALTER TABLE `tbltransac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbltransacdetail`
--
ALTER TABLE `tbltransacdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
