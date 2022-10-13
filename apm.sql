-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 02:59 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(50) NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Obat Herbal'),
(3, 'Obat Bebas'),
(4, 'Antibiotik');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_obat`
--

CREATE TABLE `tbl_obat` (
  `kd_obat` varchar(100) NOT NULL,
  `kat_obat` varchar(100) NOT NULL,
  `nm_obat` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL,
  `stok` int(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_obat`
--

INSERT INTO `tbl_obat` (`kd_obat`, `kat_obat`, `nm_obat`, `harga`, `stok`, `deskripsi`, `gambar`) VALUES
('KDO-001', 'Obat Bebas', 'Actifed', 295000, 8, 'Meringankan gejala flu, batuk pilek, dan alergi', 'actifed.jpg'),
('KDO-002', 'Antibiotik', 'Amikacin', 1200000, 10, 'Mengobati infeksi bakteri', 'amikacin.jpg'),
('KDO-003', 'Obat Herbal', 'Antangin', 5000, 7, 'Menghilangkan Masuk Angin', 'antangin.jpg'),
('KDO-004', 'Obat Bebas', 'Decolgen', 10000, 8, 'Meredakan Gejala Flu', 'decolgen.jpg'),
('KDO-005', 'Obat Bebas', 'Norit', 15000, 7, 'Membantu mengurangi frekuensi buang air besar dan menyerap racun', 'norit.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembelian`
--

CREATE TABLE `tbl_pembelian` (
  `kd_beli` varchar(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `kd_obat` varchar(100) NOT NULL,
  `tgl_beli` varchar(100) NOT NULL,
  `jml_beli` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pembelian`
--

INSERT INTO `tbl_pembelian` (`kd_beli`, `id_user`, `kd_obat`, `tgl_beli`, `jml_beli`) VALUES
('TB-001', 1, 'KDO-003', '17-04-2021 02:50:31', 3);

--
-- Triggers `tbl_pembelian`
--
DELIMITER $$
CREATE TRIGGER `tambah_stok` AFTER INSERT ON `tbl_pembelian` FOR EACH ROW BEGIN
	UPDATE tbl_obat SET stok = stok + new.jml_beli WHERE tbl_obat.kd_obat = new.kd_obat;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `kd_transaksi` varchar(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `kd_obat` varchar(100) NOT NULL,
  `tgl_transaksi` varchar(128) NOT NULL,
  `jml_transaksi` int(128) NOT NULL,
  `total` int(225) NOT NULL,
  `pembayaran` varchar(100) NOT NULL,
  `bukti` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`kd_transaksi`, `id_user`, `kd_obat`, `tgl_transaksi`, `jml_transaksi`, `total`, `pembayaran`, `bukti`) VALUES
('TR-001', 3, 'KDO-001', '10-04-2021 23:05:26', 2, 590000, 'BCA', 'download.jpg'),
('TR-002', 2, 'KDO-002', '15-04-2021 21:18:33', 2, 2400000, 'BCA', '');

--
-- Triggers `tbl_transaksi`
--
DELIMITER $$
CREATE TRIGGER `kurang_stok` AFTER UPDATE ON `tbl_transaksi` FOR EACH ROW BEGIN
	UPDATE tbl_obat SET stok = stok - NEW.jml_transaksi WHERE tbl_obat.kd_obat = NEW.kd_obat;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(100) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `tp_lahir` varchar(100) NOT NULL,
  `tgl_lahir` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` int(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nm_user`, `jenis_kelamin`, `tp_lahir`, `tgl_lahir`, `alamat`, `no_telp`, `username`, `password`, `level`) VALUES
(1, 'admin', 'Laki-Laki', 'London', '2002-02-28', 'London', 123456789, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'user', 'Perempuan', 'PAS', '2021-03-26', 'Australia', 2147483647, 'user', 'user1235', 'user'),
(3, 'febret', 'Laki-Laki', 'rusia', '2021-03-27', 'boston', 2147483647, 'febret', 'febret12345', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_obat`
--
ALTER TABLE `tbl_obat`
  ADD PRIMARY KEY (`kd_obat`);

--
-- Indexes for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  ADD PRIMARY KEY (`kd_beli`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kd_obat` (`kd_obat`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`kd_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kd_obat` (`kd_obat`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
