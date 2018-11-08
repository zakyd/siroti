-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2018 at 01:22 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbroti`
--

-- --------------------------------------------------------

--
-- Table structure for table `masterroti`
--

CREATE TABLE `masterroti` (
  `koderoti` varchar(5) NOT NULL,
  `namaroti` varchar(30) NOT NULL,
  `hargasatuan` int(11) NOT NULL,
  `waktukadaluarsa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masterroti`
--

INSERT INTO `masterroti` (`koderoti`, `namaroti`, `hargasatuan`, `waktukadaluarsa`) VALUES
('R0001', 'Roti Coklat', 3000, 7),
('R0002', 'Roti Melon', 3000, 7),
('R0003', 'Roti Pandan', 4000, 5),
('R0004', 'Roti Abon', 4000, 5),
('R0005', 'Roti Keju', 3000, 7),
('R0006', 'Roti Stroberi', 3000, 7);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `namalengkap` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `password`, `namalengkap`) VALUES
('hoho', 'hoho', 'Resha Pratama Nugroho'),
('zaky', 'zaky', 'Ilham Zaky Dhiya Ulhaq');

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `kodeproduksi` int(11) NOT NULL,
  `koderoti` varchar(5) NOT NULL,
  `tglproduksi` date NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`kodeproduksi`, `koderoti`, `tglproduksi`, `jumlah`) VALUES
(2018060403, 'R0005', '2018-06-04', 1),
(2018060404, 'R0004', '2018-06-04', 6),
(2018060405, 'R0006', '2018-06-04', 8),
(2018062301, 'R0001', '2018-06-23', 0),
(2018062302, 'R0002', '2018-06-23', 4),
(2018062401, 'R0001', '2018-06-24', 7),
(2018062402, 'R0003', '2018-06-24', 0),
(2018062403, 'R0005', '2018-06-24', 9),
(2018062404, 'R0003', '2018-06-24', 6),
(2018070901, 'R0001', '2018-07-09', 4),
(2018070902, 'R0002', '2018-07-09', 8),
(2018070903, 'R0003', '2018-07-09', 9),
(2018070904, 'R0004', '2018-07-09', 15),
(2018070905, 'R0005', '2018-07-09', 10),
(2018070906, 'R0001', '2018-07-09', 4);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kodetransaksi` varchar(35) NOT NULL,
  `kodepemesan` varchar(15) NOT NULL,
  `tglpembelian` date NOT NULL,
  `totalharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kodetransaksi`, `kodepemesan`, `tglpembelian`, `totalharga`) VALUES
('20180701015949admin', 'admin', '2018-07-01', 38000),
('20180702101021admin', 'admin', '2018-07-02', 6000),
('20180702101755zaky', 'zaky', '2018-07-02', 15000),
('20180705102906zaky', 'zaky', '2018-07-05', 6000),
('20180707034730admin', 'admin', '2018-07-07', 17000),
('20180708072741admin', 'admin', '2018-07-08', 12000),
('20180708091339admin', 'admin', '2018-07-08', 6000),
('20180709060941admin', 'admin', '2018-07-09', 12000),
('20180709060947admin', 'admin', '2018-07-09', 3000),
('20180709061519admin', 'admin', '2018-07-09', 3000),
('20180709085801admin', 'admin', '2018-07-09', 28000),
('20180709090232admin', 'admin', '2018-07-09', 20000),
('20180709090434admin', 'admin', '2018-07-09', 12000),
('20180709090543admin', 'admin', '2018-07-09', 12000),
('20180709090600admin', 'admin', '2018-07-09', 12000),
('20180709090618admin', 'admin', '2018-07-09', 9000),
('20180709090707admin', 'admin', '2018-07-09', 9000),
('20180709090748admin', 'admin', '2018-07-09', 3000),
('20180709090811admin', 'admin', '2018-07-09', 3000),
('20180709090925admin', 'admin', '2018-07-09', 3000),
('20180709091057admin', 'admin', '2018-07-09', 3000),
('20180709091105admin', 'admin', '2018-07-09', 3000),
('20180709091110admin', 'admin', '2018-07-09', 3000),
('20180709091210admin', 'admin', '2018-07-09', 3000),
('20180709092211admin', 'admin', '2018-07-09', 3000),
('20180709092230admin', 'admin', '2018-07-09', 3000),
('20180709094421zaky', 'zaky', '2018-07-09', 18000),
('20180709094644admin', 'admin', '2018-07-09', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detil`
--

CREATE TABLE `transaksi_detil` (
  `kodetransaksidetil` varchar(37) NOT NULL,
  `kodetransaksi` varchar(35) NOT NULL,
  `koderoti` varchar(5) NOT NULL,
  `jmlroti` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_detil`
--

INSERT INTO `transaksi_detil` (`kodetransaksidetil`, `kodetransaksi`, `koderoti`, `jmlroti`, `harga`) VALUES
('20180701015949admin01', '20180701015949admin', 'R0001', 4, 12000),
('20180701015949admin02', '20180701015949admin', 'R0002', 3, 9000),
('20180701015949admin03', '20180701015949admin', 'R0004', 2, 8000),
('20180701015949admin04', '20180701015949admin', 'R0005', 3, 9000),
('20180702101021admin01', '20180702101021admin', 'R0001', 2, 6000),
('20180702101755zaky01', '20180702101755zaky', 'R0002', 2, 6000),
('20180702101755zaky02', '20180702101755zaky', 'R0005', 3, 9000),
('20180705102906zaky01', '20180705102906zaky', 'R0001', 1, 3000),
('20180705102906zaky02', '20180705102906zaky', 'R0002', 1, 3000),
('20180707034730admin01', '20180707034730admin', 'R0001', 1, 3000),
('20180707034730admin02', '20180707034730admin', 'R0003', 1, 4000),
('20180707034730admin03', '20180707034730admin', 'R0004', 1, 4000),
('20180707034730admin04', '20180707034730admin', 'R0005', 1, 3000),
('20180707034730admin05', '20180707034730admin', 'R0006', 1, 3000),
('20180708072741admin01', '20180708072741admin', 'R0003', 3, 12000),
('20180708091339admin01', '20180708091339admin', 'R0002', 2, 6000),
('20180709060941admin01', '20180709060941admin', 'R0001', 4, 12000),
('20180709060947admin01', '20180709060947admin', 'R0001', 1, 3000),
('20180709061519admin01', '20180709061519admin', 'R0001', 1, 3000),
('20180709085801admin01', '20180709085801admin', 'R0002', 2, 6000),
('20180709085801admin02', '20180709085801admin', 'R0003', 3, 12000),
('20180709085801admin03', '20180709085801admin', 'R0004', 1, 4000),
('20180709085801admin04', '20180709085801admin', 'R0006', 2, 6000),
('20180709090232admin01', '20180709090232admin', 'R0001', 1, 3000),
('20180709090232admin02', '20180709090232admin', 'R0002', 3, 9000),
('20180709090232admin03', '20180709090232admin', 'R0003', 2, 8000),
('20180709090434admin01', '20180709090434admin', 'R0003', 3, 12000),
('20180709090543admin01', '20180709090543admin', 'R0003', 3, 12000),
('20180709090600admin01', '20180709090600admin', 'R0003', 3, 12000),
('20180709090618admin01', '20180709090618admin', 'R0005', 3, 9000),
('20180709090707admin01', '20180709090707admin', 'R0005', 3, 9000),
('20180709090748admin01', '20180709090748admin', 'R0002', 1, 3000),
('20180709090811admin01', '20180709090811admin', 'R0002', 1, 3000),
('20180709090925admin01', '20180709090925admin', 'R0002', 1, 3000),
('20180709091057admin01', '20180709091057admin', 'R0002', 1, 3000),
('20180709091105admin01', '20180709091105admin', 'R0002', 1, 3000),
('20180709091110admin01', '20180709091110admin', 'R0002', 1, 3000),
('20180709091210admin01', '20180709091210admin', 'R0002', 1, 3000),
('20180709092211admin01', '20180709092211admin', 'R0002', 1, 3000),
('20180709092230admin01', '20180709092230admin', 'R0002', 1, 3000),
('20180709094421zaky01', '20180709094421zaky', 'R0001', 2, 6000),
('20180709094421zaky02', '20180709094421zaky', 'R0003', 3, 12000),
('20180709094644admin01', '20180709094644admin', 'R0001', 5, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `namalengkap` varchar(30) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `namalengkap`, `level`) VALUES
('admin', 'admin', 'admin', 'admin'),
('dapur1', 'dapur1', 'dapur1', 'dapur'),
('dapur2', 'dapur2', 'dapur2', 'dapur'),
('kasir1', 'kasir1', 'kasir1', 'kasir'),
('kasir2', 'kasir2', 'kasir2', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `masterroti`
--
ALTER TABLE `masterroti`
  ADD PRIMARY KEY (`koderoti`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`kodeproduksi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kodetransaksi`);

--
-- Indexes for table `transaksi_detil`
--
ALTER TABLE `transaksi_detil`
  ADD PRIMARY KEY (`kodetransaksidetil`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
