-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 03:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `h_id` int(50) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `USERNAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblautonumber`
--

CREATE TABLE `tblautonumber` (
  `id` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `increment` int(11) NOT NULL,
  `desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblautonumber`
--

INSERT INTO `tblautonumber` (`id`, `start`, `end`, `increment`, `desc`) VALUES
(1, 1000, 53, 1, 'PROD');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `category_id` int(11) NOT NULL,
  `category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`category_id`, `category`) VALUES
(1, 'Tanaman Gantung'),
(2, 'Tanaman Standar'),
(3, 'Tanaman Koleksi');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
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
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`C_ID`, `C_FNAME`, `C_LNAME`, `C_AGE`, `C_ADDRESS`, `C_PNUMBER`, `C_GENDER`, `C_EMAILADD`, `ZIPCODE`, `username`, `password`) VALUES
(4, 'asd', 'asd', 12, '12', '12', 'Male', 'san@gmail.com', 'asd', 'admin', '$2y$10$Nz4hwMNDYxc63dBtJ7TGl.zgvt6UXNIylukyWgRxdgvosgy5wtQOy'),
(5, 'sumail', 'cofeen', 20, 'Jl Lembang', '0823123123', 'Male', 'sumail@gmail.com', '40222', 'sumail', '$2y$10$U2TzhLkk5CXnAC/BgCo13uExQlFl9Nyc6CVs1LcSlbHef92KAzUXm'),
(6, 'ridwan', 'remin', 21, 'Jl asd', '312312', 'Laki-Laki', '123@gmail.com', '4321', 'ridwan12', '$2y$10$XZw1u9HtZtDpLXMsUtbHUe4m0ztA8kUttAhXpVxD71cFb9GFnkpn2');

-- --------------------------------------------------------

--
-- Table structure for table `tbldelivery`
--

CREATE TABLE `tbldelivery` (
  `id` int(50) NOT NULL,
  `transac_code` int(100) NOT NULL,
  `receiver` varchar(200) NOT NULL,
  `dated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldelivery`
--

INSERT INTO `tbldelivery` (`id`, `transac_code`, `receiver`, `dated`) VALUES
(1, 1593533066, 'Ridwan', '0000-00-00'),
(2, 1595246871, 'Cahadi', '2020-07-22'),
(3, 1654487872, 'asd asd', '2022-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE `tblemployee` (
  `emp_id` int(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` int(2) NOT NULL,
  `position` varchar(50) NOT NULL,
  `hire_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`emp_id`, `fname`, `lname`, `contact`, `email`, `address`, `gender`, `age`, `position`, `hire_date`) VALUES
(1, 'Caren', 'Bautista', '09098591074', 'caren@yahoo.com', 'Kabankalan', 'Female', 23, 'Manager', '2019-11-30'),
(2, 'Jahzel', 'Alarcon', '09509827365', 'jahiam07@gmail.com', 'Isabela', 'Female', 22, 'Manager', '2019-12-01'),
(3, 'Ryan', 'Mana-ay', '09786534342', 'Ryan@yahoo.com', 'Himamaylan ', 'Male', 21, 'Supervisor', '2019-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `tblinventory`
--

CREATE TABLE `tblinventory` (
  `transac_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `date_in` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpot`
--

CREATE TABLE `tblpot` (
  `id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `transac_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpot`
--

INSERT INTO `tblpot` (`id`, `size`, `transac_code`) VALUES
(1, '17', ''),
(2, '21', ''),
(3, '30', ''),
(6, '17', '1598178883'),
(7, '17', '1598178883'),
(8, '17', '1598178932');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `date_in` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_code` varchar(25) NOT NULL,
  `status` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`product_id`, `product_name`, `quantity`, `date_in`, `category_id`, `supplier_id`, `user_id`, `product_code`, `status`, `image`, `Description`) VALUES
(1, 'Gelombang Love', 49, '2020-06-24', 2, 1, 2, '1023', 'Available', '1023Kembang cinta.png', ''),
(2, 'Red Kongo', 25, '2020-06-24', 1, 1, 2, '1024', 'Available', '1024red koongo.png', ''),
(3, 'Kaktus Koboi', 11, '2020-06-24', 3, 1, 2, '1026', 'Available', '1026Kaktus Koboi.png', ''),
(4, 'Bromelia Gede', 22, '2020-06-24', 1, 1, 2, '1027', 'Available', '1027Bromelia Gede.png', ''),
(5, 'Sensiveira', 20, '2020-06-24', 1, 1, 2, '1028', 'Available', '1028Sensiveira.png', ''),
(6, 'Suji', 20, '2020-06-24', 1, 1, 2, '1029', 'Available', '1029Suji.png', ''),
(7, 'Roten/Hortensiah', 33, '2020-06-24', 1, 1, 2, '1030', 'Available', '1030Roten atau Hortensiah.png', ''),
(8, 'Wijaya Kusuma Kepiting', 32, '2020-06-24', 1, 1, 2, '1031', 'Available', '1031Wijaya Kusuma Kepiting.png', ''),
(9, 'Wijaya Kusuma Californian Dream', 23, '2020-06-24', 1, 1, 2, '1032', 'Available', '1032Wijaya Kusuma Californian Dream.png', ''),
(10, 'Lavender', 25, '2020-06-24', 1, 1, 2, '1033', 'Available', '1033Lavender.png', ''),
(11, 'Lipstik', 35, '2020-06-24', 1, 1, 2, '1034', 'Available', '1034Lipstik.png', ''),
(12, 'Pilo Katak', 30, '2020-06-24', 1, 1, 2, '1035', 'Available', '1035Pilo Katak.png', ''),
(13, 'Gewor', 25, '2020-06-24', 1, 1, 2, '1036', 'Available', '1036Gewor.png', ''),
(14, 'Janda Bolong/Monstera Obliqua', 22, '2020-06-24', 1, 1, 2, '1037', 'Available', '1037Janda Bolong.png', ''),
(15, 'Dianthus/Anyelir', 55, '2020-06-24', 1, 1, 2, '1038', 'Available', '1038Diantus atau anyelir.png', ''),
(16, 'Peplan/Peperonia Merah', 45, '2020-06-24', 1, 1, 2, '1039', 'Available', '1039Peplan atau peperonia merah.png', ''),
(17, 'Peplan/Peperonia', 45, '2020-06-24', 1, 1, 2, '1040', 'Available', '1040Peplan atau peperonia.png', ''),
(18, 'Keladi Daun Kecil', 6, '2020-06-24', 1, 1, 2, '1041', 'Available', '1041Keladi daun kecil.png', ''),
(19, 'Kuping Gajah', 10, '2020-06-24', 1, 1, 2, '1042', 'Available', '1042Kuping gajah.png', ''),
(20, 'Kribo', 66, '2020-06-24', 1, 1, 2, '1043', 'Available', '1043Kribo.png', ''),
(21, 'Hebras Rambat/Baby Sun Rose', 52, '2020-06-24', 1, 1, 2, '1044', 'Available', '1044Hebras Rambat atau baby sun rose.png', ''),
(22, 'Petunia', 40, '2020-06-24', 1, 1, 2, '1045', 'Available', '1045Petunia.png', ''),
(23, 'Pakis Haji', 65, '2020-06-24', 1, 1, 2, '1046', 'Available', '1046Pakis Haji.png', ''),
(24, 'Sri Rezeki', 32, '2020-06-24', 1, 1, 2, '1048', 'Available', '1048sri rejeki.png', ''),
(25, 'Bromelia Three Color', 50, '2020-06-24', 1, 1, 2, '1049', 'Available', '1049Bromelia Three Color.png', ''),
(42, 'Bunga Test', 35, '2020-07-04', 1, 1, 2, '1050', 'Available', '1050career.jpg', ''),
(43, 'Tanaman Koleksi test', 25, '2020-07-11', 3, 1, 2, '1051', 'Available', '1051Wijaya Kusuma Kepiting.png', ''),
(44, 'Janda Kembang', 23, '2022-06-06', 2, 1, 2, '1052', 'Available', '1052wallpaperflare.com_wallpaper_2.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblreq`
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
-- Dumping data for table `tblreq`
--

INSERT INTO `tblreq` (`no_permintaan`, `user_id`, `tgl_input`, `jml_barang`, `jml_qty`, `status`) VALUES
('0906202203404422', 2, '2022-06-09', 6, 10, 2),
('0906202203413488', 2, '2022-06-09', 7, 13, 1),
('0906202203415089', 2, '2022-06-09', 7, 13, 0),
('0906202203421889', 2, '2022-06-09', 7, 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblreqdetail`
--

CREATE TABLE `tblreqdetail` (
  `id` int(100) NOT NULL,
  `no_permintaan` varchar(100) NOT NULL,
  `product_code` varchar(25) NOT NULL,
  `qty` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblreqdetail`
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
-- Table structure for table `tblstockhistory`
--

CREATE TABLE `tblstockhistory` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `qty` int(5) NOT NULL,
  `user_id` varchar(5) NOT NULL,
  `product_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstockhistory`
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
-- Table structure for table `tblsupplier`
--

CREATE TABLE `tblsupplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(30) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsupplier`
--

INSERT INTO `tblsupplier` (`supplier_id`, `supplier_name`, `contact`, `email`, `address`) VALUES
(1, 'Harvester', '9095643236', 'Harvester@yahoo.com', 'Brgy.Sum-ag, Bacolod City'),
(2, 'Amigo', '9786534213', 'Amigo@yahoo.com', 'Bgry.Singkang Bacolod City'),
(3, 'Atlas', '9096547321', 'Atlas@yahoo.com', 'Brgy.Poblacion, Bacolod City');

-- --------------------------------------------------------

--
-- Table structure for table `tbltransac`
--

CREATE TABLE `tbltransac` (
  `transac_id` int(11) NOT NULL,
  `transac_code` int(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_code` varchar(200) NOT NULL,
  `qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltransacdetail`
--

CREATE TABLE `tbltransacdetail` (
  `detail_id` int(11) NOT NULL,
  `transac_code` int(11) NOT NULL,
  `date` datetime(6) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `remarks` text NOT NULL,
  `delivery_date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
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
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`user_id`, `fname`, `lname`, `email`, `contact`, `address`, `position`, `username`, `pass`) VALUES
(2, 'Tasya', 'Pratama', 'caren@yahoo.com', 0, '', 'Admin', 'admin', '$2y$10$ds1gqSSjIHq/I7c.Ly/w9eF.OPgcXyeG09wL71loBGy0qLkNzUZlS'),
(4, 'adi', 'a', 'Adi@gmail.com', 0, '', 'Kurir', 'kurir', '$2y$10$uYGNuUtZm0hTEnX88Jof/unW0PY.etrQ3hR6xWwtTxKZ4V941jBpe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `tblautonumber`
--
ALTER TABLE `tblautonumber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`C_ID`);

--
-- Indexes for table `tbldelivery`
--
ALTER TABLE `tbldelivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `tblpot`
--
ALTER TABLE `tblpot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `FK_tblproducts_tblsupplier` (`supplier_id`,`user_id`);

--
-- Indexes for table `tblreq`
--
ALTER TABLE `tblreq`
  ADD PRIMARY KEY (`no_permintaan`);

--
-- Indexes for table `tblreqdetail`
--
ALTER TABLE `tblreqdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstockhistory`
--
ALTER TABLE `tblstockhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbltransac`
--
ALTER TABLE `tbltransac`
  ADD PRIMARY KEY (`transac_id`),
  ADD KEY `FK_tbltransac_details_tblcustomer` (`customer_id`);

--
-- Indexes for table `tbltransacdetail`
--
ALTER TABLE `tbltransacdetail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `h_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblautonumber`
--
ALTER TABLE `tblautonumber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `C_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbldelivery`
--
ALTER TABLE `tbldelivery`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblemployee`
--
ALTER TABLE `tblemployee`
  MODIFY `emp_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpot`
--
ALTER TABLE `tblpot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tblreqdetail`
--
ALTER TABLE `tblreqdetail`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tblstockhistory`
--
ALTER TABLE `tblstockhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbltransac`
--
ALTER TABLE `tbltransac`
  MODIFY `transac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `tbltransacdetail`
--
ALTER TABLE `tbltransacdetail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
