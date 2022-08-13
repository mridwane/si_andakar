-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Agu 2022 pada 14.02
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
(1, 'L. KH. Mas Mansyur No. 17 Tanah Abang Jakarta Pusat, Kebon Kacang, Kec. Tanah Abang Kota Jakarta Pusat', 4),
(2, 'Jalan Metro Pondok Indah Kav. IV, Pd. Pinang, Kec. Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta', 4),
(3, 'Jl. M.H. Thamrin No.1, Kb. Melati, Kec. Menteng, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10310', 15),
(4, 'Jl. Medan Merdeka Tim. No.1, Gambir, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10110', 15),
(5, 'Jl. Karang Anyar, Karang Anyar, Kecamatan Sawah Besar, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta', 15),
(6, 'Jl. Pintu Satu Senayan, Gelora, Kecamatan Tanah Abang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10270', 15),
(7, 'Jl. Sisingamangaraja Kebayoran Baru, RT.2/RW.1, Selong, Jakarta Selatan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12110', 15);

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
(1, 1000, 123, 1, 'PROD');

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
(1, '2022-08-10 16:08:25', 'BTDEL1008202204081093.jpeg', 'paid', 0, 'customer', '', '', 'DEL1008202204081093'),
(2, '2022-08-10 16:18:37', 'BTRES1008202204182695.jpeg', 'dp', 0, 'customer', '', '', 'RES1008202204182695'),
(3, '2022-08-10 16:19:30', 'BTLNSRES1008202204182695.jpeg', 'lunas', 0, 'customer', '', '', 'RES1008202204182695'),
(4, '2022-08-10 16:23:03', 'BTCAT1008202204225427.jpeg', 'dp', 0, 'customer', '', '', 'CAT1008202204225427'),
(5, '2022-08-10 16:26:47', 'BTLNSCAT1008202204225427.jpeg', 'lunas', 0, 'customer', '', '', 'CAT1008202204225427'),
(6, '2022-08-10 16:28:33', 'BTDEL1008202204282398.jpeg', 'paid', 0, 'customer', '', '', 'DEL1008202204282398'),
(7, '2022-08-10 16:31:15', 'BTRES1008202204310741.jpeg', 'dp', 0, 'customer', '', '', 'RES1008202204310741'),
(8, '2022-08-10 16:35:03', 'BTLNSRES1008202204310741.jpeg', 'lunas', 0, 'customer', '', '', 'RES1008202204310741'),
(9, '2022-08-12 08:28:22', 'BTDEL1208202208251482.jpeg', 'paid', 0, 'customer', '', '', 'DEL1208202208251482');

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
('Catering15', 'Catering', 5950000, '2022-08-12', 15),
('Delivery4', 'Delivery', 106000, '2022-08-12', 4),
('Reservasi15', 'Reservasi', 165000, '2022-08-12', 15);

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
(20, 'Delivery4', 3, 'S1091', 1, 106000),
(23, 'Reservasi15', 7, 'S1092', 1, 165000),
(24, 'Catering15', 7, 'S1095', 35, 5950000);

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
(4, 'Nadya', 'Minerva', 25, 2, '082346578919', 'Perempuan', 'Customer', 'nadya@gmail.com', 'asd', 'admin', '$2y$10$Nz4hwMNDYxc63dBtJ7TGl.zgvt6UXNIylukyWgRxdgvosgy5wtQOy'),
(5, 'sumail', 'cofeen', 20, 25, '0823123123', 'Laki-Laki', 'Customer', 'sumail@gmail.com', '40222', 'sumail', '$2y$10$Nz4hwMNDYxc63dBtJ7TGl.zgvt6UXNIylukyWgRxdgvosgy5wtQOy'),
(6, 'ridwan', 'remin', 21, 0, '312312', 'Laki-Laki', 'Customer', '123@gmail.com', '4321', 'ridwan12', '$2y$10$XZw1u9HtZtDpLXMsUtbHUe4m0ztA8kUttAhXpVxD71cFb9GFnkpn2'),
(11, 'Muhammad', 'Ridwan', 22, 27, '83894799380', 'Laki-Laki', 'Mitra', 'mridwane01@gmail.com', '4321', 'mridwane', '$2y$10$Ga3NPy50IwrLygWc940t/.saCTH.YdlaeOFc6VnV0ogeklgVZEWrG'),
(12, 'udin', 'pertama', 22, 29, '83894799380', 'Laki-Laki', 'Mitra', 'udin@gmail.com', '4321', 'udin', '$2y$10$bvzNCK3Zhtxynas4F3OCNeP7tzecIlrf7plV.0yYR.V6d1fmg0jci'),
(13, 'sandria', 'maulana', 25, 28, '0819929292', 'Laki-Laki', 'Mitra', 'sandria@gmail.com', '4321', 'sandria', '$2y$10$XiMjxrBLAePl58w5vHpXqOQxyekDx4CpMKo0CYRwydk5K6kZtamem'),
(14, 'Regi', 'sacharissa', 21, 0, '85759082279', 'Perempuan', 'Mitra', 'regigunawan730@gmail.com', '4321', 'rgsch', '$2y$10$x44cER891ujm0YNva0.Fe.ggHyXWheRv/azT2LrqLzO4q.eUQsSnK'),
(15, 'Regi ', 'Sacharissa G', 21, 7, '85759082279', 'Perempuan', 'Customer', 'regigunawan730@gmail.com', '4321', 'regisg', '$2y$10$JYLMosF3Ie68trY2qRtlxOxV4nMkI.MfUSmo//FWpSKy78rY8XJR.'),
(16, 'ujang', 'gobred', 31, 0, '087678945678', 'Laki-Laki', 'Mitra', 'ujang@gmail.com', '4321', 'ujang', '$2y$10$mVPdIGZ17s6rPYCKWpy0X.lIripYOtAdX9//raYvhYKe3ENRes7AC');

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
(2, 'Tenderloin Lokal', '2022-08-10', 1, 2, 'Tersedia', 'Makanan-Utama', 102000, '1097tenderloin-steak.jpg', 'Daging sapi dari bagian tengah badan atau khas dalam'),
(3, 'Rib Eye Lokal', '2022-08-10', 1, 2, 'Tersedia', 'Makanan-Utama', 96000, '1098rib-eye.jpg', 'Rib eye merupakan bagian sekitar tulang rusuk pada sapi. Plihan saus : BBQ, Black Pepper, dll.'),
(7, 'Iga Barbar', '2022-08-10', 2, 2, 'Tersedia', 'Makanan-Utama', 160000, '11021.jpg', 'Pilihan saus : BBQ, Black Pepper, Mushroom, Tartar, Honey Mustard, Smoked Paprica'),
(8, 'Chris Ribs', '2022-08-10', 2, 2, 'Tersedia', 'Makanan-Utama', 175000, '1103chris-ribs3.jpg', 'Pilihan saus : BBQ, Black Pepper, Mushroom, Tartar, Honey Mustard, Smoked Paprica'),
(9, 'Lamb Shank', '2022-08-10', 3, 2, 'Tersedia', 'Makanan-Utama', 142000, '1104lamb-shank.jpg', 'Pilihan saus : BBQ, Black Pepper, Mushroom, Tartar, Honey Mustard, Smoked Paprica'),
(10, 'Chicken Wings', '2022-08-10', 5, 2, 'Tersedia', 'Makanan-Utama', 40000, '1105bbq-chicken-wings2.jpg', '6 Pieces with French Fries. Pilihan saus : BBQ, Black Pepper, Mushroom, Tartar, Honey Mustard dll'),
(11, 'Boneless Chicken Steak', '2022-08-10', 5, 2, 'Tersedia', 'Makanan-Utama', 55000, '1106boneless-chicken.jpg', 'Pilihan saus : BBQ, Black Pepper, Mushroom, Tartar, Honey Mustard, Smoked Paprica'),
(12, 'Dorry Fillet', '2022-08-10', 6, 2, 'Tersedia', 'Makanan-Utama', 62000, '1107dory-steak.jpg', 'Pilihan saus : BBQ, Black Pepper, Mushroom, Tartar, Honey Mustard, Smoked Paprica'),
(13, 'Fish and Chips', '2022-08-10', 6, 2, 'Tersedia', 'Makanan-Utama', 75000, '1108fish-and-cips.jpg', '75000'),
(14, 'Salmon Steak', '2022-08-10', 6, 2, 'Tersedia', 'Makanan-Utama', 105000, '1109salmon-steak.jpg', 'Pilihan saus : BBQ, Black Pepper, Mushroom, Tartar, Honey Mustard, Smoked Paprica'),
(15, 'Potato Wedges', '2022-08-10', 7, 2, 'Tersedia', 'Makanan-Pendamping', 20000, '1110potato-wedges.jpg', 'Olahan kentang yang dipotong, kemudian dicampurkan beberapa bumbu dan tambahan daun seledri'),
(16, 'Sosis', '2022-08-10', 7, 2, 'Tersedia', 'Makanan-Pendamping', 20000, '1111sosis bakar.jpg', 'Sosis yang dibakar untuk pendamping steak kamu'),
(17, 'Mix Vagatable', '2022-08-10', 7, 2, 'Tersedia', 'Makanan-Pendamping', 25000, '1112mix-vagatables.jpg', 'Sayuran potong yang dicampur dari berbagai macam untuk pendamping dish kamu'),
(18, 'Pie Apel', '2022-08-10', 8, 2, 'Tersedia', 'Makanan-Penutup', 23000, '1113pie.jpg', 'Kue dengan adonan pastry yang manis dengan isi apel'),
(19, 'Complete Burger', '2022-08-10', 9, 2, 'Tersedia', 'Starter', 70000, '1114complete-burger.jpg', '150gr Beef burger dengan tambahan keju dan telur serta disajikan dengan fries'),
(20, 'Air Putih ', '2022-08-10', 10, 2, 'Tersedia', 'Minuman', 12000, '1115mineral.jpg', 'Air Mineral'),
(21, 'Strawberry Milkshake', '2022-08-10', 11, 2, 'Tersedia', 'Minuman', 37000, '1116strawberry-milkshake.jpg', 'Minuman dingin dari campuran susu, es krim, dan sirop berperasa yang dikocok'),
(22, 'Blueberry Milkshake', '2022-08-10', 11, 2, 'Tersedia', 'Minuman', 42000, '1117blueberry-milkshake.jpg', 'minuman dingin dari campuran buah bluberry, susu, es krim, dan sirop berperasa yang dikocok'),
(23, 'Ice Cream Chocolate', '2022-08-10', 11, 2, 'Tersedia', 'Minuman', 12000, '1118icecream-choco.jpg', 'Ice Cream rasa coklat dengan taburan chocochip didalamnya '),
(24, 'Jus Mangga', '2022-08-10', 13, 2, 'Tersedia', 'Minuman', 31000, '1119jus-mangga.jpg', 'Buah mangga di blender dengan campuran susu dan air'),
(25, 'Jus Melon', '2022-08-10', 13, 2, 'Tersedia', 'Minuman', 31000, '1120melon-juice.jpg', 'Buah melon di blender dengan susu dan air'),
(26, 'Sirloin Lokal', '2022-08-11', 1, 9, 'Tersedia', 'Makanan-Utama', 92000, '1121sirloin3.jpg', 'Pilihan saus : BBQ, Black Pepper, Mushroom, Tartar, Honey Mustard, Smoked Paprica'),
(27, 'Tenderloin Import', '2022-08-11', 1, 9, 'Tersedia', 'Makanan-Utama', 125000, '1122tenderloin-steak3.jpg', 'Pilihan saus : BBQ, Black Pepper, Mushroom, Tartar, Honey Mustard, Smoked Paprica');

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
(1, 'MIT1008202204385233', '2022-08-10', 'MIT1008202204403911_14_kemitraan.pdf', 'active', 'selamat', 14),
(2, 'MIT1208202207072814', '2022-08-12', 'MIT1208202207072814_16_kemitraan.pdf', 'unconfirmed', '', 16);

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
('S1091', 'Tar Tar Sauce', 10000, 'Tersedia', 'Saus ', '2', '2022-07-20'),
('S1092', 'Black Pepper', 5000, 'Tersedia', 'pedas', '2', '2022-07-22'),
('S1093', 'Mushroom', 5000, 'Tersedia', 'pedas', '2', '2022-07-22'),
('S1094', 'Honey Mustard', 10000, 'Tersedia', 'pedas', '2', '2022-07-22'),
('S1095', 'Smoked Paprika', 10000, 'Tersedia', 'pedas', '2', '2022-07-22'),
('S1096', 'BBQ ', 0, 'Tersedia', 'Saus Baebeque', '2', '2022-07-17');

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
(1, 'DINEIN1008202204063284', '2022/08/10', 'Dinein', 'done', 0, 0, 0, 0, 0, 0, 213000, '2022-08-10 21:06:32', 0, 2, ''),
(2, 'DEL1008202204081093', '2022/08/10', 'Delivery', 'done', 193000, 19300, 0, 10000, 0, 0, 222300, '2022-08-10 21:08:10', 0, 4, 'Jumlah Pembayaran Kurang -Rp 22.300,00'),
(3, 'DINEIN1008202204102533', '2022/08/10', 'Dinein', 'done', 0, 0, 0, 0, 0, 0, 107000, '2022-08-10 21:10:25', 0, 2, ''),
(4, 'RES1008202204182695', '2022/08/10', 'Reservasi', 'done', 236000, 23600, 0, 0, 120000, 130000, 259600, '2022-08-12 02:18:00', 2, 4, 'Jumlah Pembayaran Kurang -Rp 9.600,00'),
(5, 'CAT1008202204225427', '2022-08-10', 'Catering', 'done', 5605000, 560500, 280250, 0, 3000000, 3445700, 6445750, '2022-08-13 21:22:00', 0, 4, 'Jumlah Pembayaran Kurang -Rp 50,00'),
(6, 'DEL1008202204282398', '2022/08/10', 'Delivery', 'done', 101000, 10100, 0, 10000, 0, 0, 121100, '2022-08-10 21:28:23', 0, 4, 'transfer Sesuai.'),
(7, 'RES1008202204310741', '2022/08/10', 'Reservasi', 'done', 97000, 9700, 0, 0, 53000, 53700, 106700, '2022-08-11 02:31:00', 1, 4, 'transfer Sesuai.'),
(8, 'DEL1208202208251482', '2022/08/12', 'Delivery', 'paid', 271000, 27100, 0, 10000, 0, 0, 308100, '2022-08-12 13:25:14', 0, 15, '');

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
(1, '3', 'S1092', 1, 'DINEIN1008202204063284', 101000),
(2, '19', 'S100', 1, 'DINEIN1008202204063284', 70000),
(3, '22', 'S100', 1, 'DINEIN1008202204063284', 42000),
(4, '3', 'S1092', 1, 'DEL1008202204081093', 101000),
(5, '12', 'S1091', 1, 'DEL1008202204081093', 72000),
(6, '15', 'S100', 1, 'DEL1008202204081093', 20000),
(7, '2', 'S1092', 1, 'DINEIN1008202204102533', 107000),
(8, '3', 'S1092', 1, 'RES1008202204182695', 101000),
(9, '5', 'S1091', 1, 'RES1008202204182695', 135000),
(10, '7', 'S1091', 32, 'CAT1008202204225427', 5440000),
(11, '7', 'S1093', 1, 'CAT1008202204225427', 165000),
(12, '3', 'S1092', 1, 'DEL1008202204282398', 101000),
(13, '4', 'S1092', 1, 'RES1008202204310741', 97000),
(14, '3', 'S1093', 1, 'DEL1208202208251482', 101000),
(15, '7', 'S1094', 1, 'DEL1208202208251482', 170000);

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
(9, 'Sacha', 'Rissa', 'regi@gmail.com', 2147483647, '0', 'Crew', 'rissa', '$2y$10$EdDlF1D2t7AuxQxFDL1OSO/cR06cnVKDl3j6o5B2YfgugpaS2Cxyi');

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
  MODIFY `id_alamat` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tblautonumber`
--
ALTER TABLE `tblautonumber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tblbuktitransfer`
--
ALTER TABLE `tblbuktitransfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tblcartdetail`
--
ALTER TABLE `tblcartdetail`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `C_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tbldelivery`
--
ALTER TABLE `tbldelivery`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbldetailrequestmitra`
--
ALTER TABLE `tbldetailrequestmitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tblreqdetail`
--
ALTER TABLE `tblreqdetail`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tblrequestmitra`
--
ALTER TABLE `tblrequestmitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tblstockhistory`
--
ALTER TABLE `tblstockhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbltransac`
--
ALTER TABLE `tbltransac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbltransacdetail`
--
ALTER TABLE `tbltransacdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
