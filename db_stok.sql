-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2020 at 07:17 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stok`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_tipe_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `id_transaksi`, `id_tipe_barang`, `jumlah`) VALUES
(181, 1, 21, 5),
(182, 1, 22, 0),
(183, 1, 23, 0),
(184, 1, 24, 12),
(185, 1, 25, 10),
(186, 1, 26, 10),
(187, 1, 27, 2),
(188, 1, 28, 4),
(189, 1, 29, 8),
(190, 1, 30, 4),
(191, 1, 31, 10),
(192, 1, 32, 5),
(193, 1, 33, 10),
(194, 1, 34, 10),
(195, 1, 35, 3),
(196, 1, 36, 10),
(197, 1, 37, 7),
(198, 1, 38, 0),
(199, 1, 39, 1),
(200, 1, 41, 10),
(201, 1, 40, 8),
(202, 1, 56, 4),
(203, 1, 57, 8),
(204, 1, 58, 3),
(205, 1, 47, 9),
(206, 1, 48, 13),
(207, 1, 49, 13),
(208, 1, 50, 11),
(209, 1, 51, 13),
(210, 1, 52, 14),
(211, 1, 53, 10),
(212, 1, 54, 10),
(213, 1, 55, 9),
(214, 1, 42, 13),
(215, 1, 43, 17),
(216, 1, 44, 0),
(217, 1, 45, 6),
(218, 1, 46, 19),
(219, 1, 59, 7),
(220, 1, 60, 10),
(221, 1, 61, 9),
(222, 1, 62, 10),
(223, 1, 63, 10),
(224, 1, 64, 5),
(225, 1, 65, 7),
(226, 1, 70, 7),
(227, 1, 71, 1),
(228, 1, 72, 10),
(229, 1, 73, 7),
(230, 1, 74, 8),
(231, 1, 75, 10),
(232, 1, 76, 10),
(233, 1, 77, 9),
(234, 3, 38, 7),
(235, 3, 39, 5),
(236, 2, 21, 6),
(237, 2, 22, 7),
(238, 2, 23, 5),
(239, 2, 24, 3),
(240, 2, 28, 4),
(241, 2, 29, 2),
(242, 2, 32, 1),
(243, 2, 35, 2),
(244, 2, 56, 6),
(245, 2, 56, 4),
(246, 2, 57, 3),
(247, 2, 64, 5),
(248, 2, 65, 2),
(249, 2, 70, 2),
(250, 2, 73, 3),
(251, 2, 74, 1),
(252, 2, 77, 1),
(253, 4, 40, 2),
(254, 4, 47, 6),
(255, 4, 48, 2),
(256, 4, 49, 2),
(257, 4, 50, 3),
(258, 4, 51, 2),
(259, 4, 52, 1),
(260, 4, 55, 1),
(261, 5, 37, 3),
(262, 5, 59, 3),
(263, 5, 60, 1),
(264, 6, 42, 7),
(265, 6, 43, 3),
(266, 6, 44, 17),
(267, 6, 45, 14),
(268, 6, 46, 1),
(269, 29, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand_barang`
--

CREATE TABLE `brand_barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand_barang`
--

INSERT INTO `brand_barang` (`id`, `nama`) VALUES
(1, 'TASCO'),
(2, 'GILARDONI'),
(3, 'HANATA'),
(4, 'YOTO'),
(5, 'DURANET'),
(7, 'DURANET'),
(8, 'GILARDONI'),
(9, 'TASCO'),
(10, 'TRISEDA'),
(11, 'TASCO'),
(12, 'TASCO'),
(16, 'SONY'),
(17, 'Kiki');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_tipe_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `id_transaksi`, `id_tipe_barang`, `jumlah`) VALUES
(285, 1, 21, 9),
(286, 1, 22, 7),
(287, 1, 23, 7),
(288, 1, 24, 12),
(289, 1, 25, 10),
(290, 1, 26, 10),
(291, 1, 27, 10),
(292, 1, 28, 6),
(293, 1, 29, 8),
(294, 1, 30, 10),
(295, 1, 31, 10),
(296, 1, 32, 9),
(297, 1, 33, 10),
(298, 1, 34, 10),
(299, 1, 35, 8),
(300, 1, 36, 10),
(301, 1, 37, 7),
(302, 1, 38, 3),
(303, 1, 39, 5),
(304, 1, 41, 10),
(305, 1, 40, 8),
(306, 1, 56, 9),
(307, 1, 57, 12),
(308, 1, 58, 11),
(309, 1, 47, 9),
(310, 1, 48, 13),
(311, 1, 49, 13),
(312, 1, 50, 12),
(313, 1, 51, 13),
(314, 1, 52, 14),
(315, 1, 53, 10),
(316, 1, 54, 10),
(317, 1, 55, 9),
(318, 1, 42, 13),
(319, 1, 43, 17),
(320, 1, 44, 2),
(321, 1, 45, 6),
(322, 1, 46, 19),
(323, 1, 59, 7),
(324, 1, 60, 10),
(325, 1, 61, 9),
(326, 1, 62, 10),
(327, 1, 63, 10),
(328, 1, 64, 5),
(329, 1, 65, 8),
(330, 1, 70, 10),
(331, 1, 71, 8),
(332, 1, 72, 10),
(333, 1, 73, 7),
(334, 1, 74, 9),
(335, 1, 75, 10),
(336, 1, 76, 10),
(337, 1, 77, 9),
(338, 3, 38, 7),
(339, 3, 39, 5),
(340, 2, 21, 6),
(341, 2, 22, 8),
(342, 2, 23, 8),
(343, 2, 24, 3),
(344, 2, 28, 4),
(345, 2, 29, 2),
(346, 2, 32, 1),
(347, 2, 35, 2),
(348, 2, 56, 6),
(349, 2, 56, 4),
(350, 2, 57, 3),
(351, 2, 64, 5),
(352, 2, 65, 2),
(353, 2, 70, 2),
(354, 2, 73, 3),
(355, 2, 74, 1),
(356, 2, 77, 1),
(357, 4, 40, 2),
(358, 4, 47, 6),
(359, 4, 48, 2),
(360, 4, 49, 2),
(361, 4, 50, 3),
(362, 4, 51, 2),
(363, 4, 52, 1),
(364, 4, 55, 1),
(365, 5, 37, 3),
(366, 5, 59, 3),
(367, 5, 60, 1),
(368, 6, 42, 7),
(369, 6, 43, 3),
(370, 6, 44, 18),
(371, 6, 45, 14),
(372, 6, 46, 1),
(373, 23, 38, 3),
(374, 24, 21, 3),
(375, 24, 22, 2),
(376, 24, 23, 2),
(377, 24, 27, 1),
(378, 24, 28, 2),
(379, 24, 32, 1),
(380, 24, 56, 3),
(381, 24, 57, 1),
(382, 24, 58, 2),
(383, 24, 70, 2),
(384, 24, 71, 1),
(385, 25, 23, 1),
(386, 25, 35, 2),
(387, 25, 44, 2),
(388, 26, 21, 2),
(389, 26, 30, 2),
(390, 26, 39, 1),
(391, 26, 50, 2),
(392, 27, 65, 1),
(393, 28, 74, 1),
(395, 29, 21, 1),
(396, 30, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `history_barang`
--

CREATE TABLE `history_barang` (
  `id` int(11) NOT NULL,
  `id_barang_masuk` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_barang`
--

INSERT INTO `history_barang` (`id`, `id_barang_masuk`, `tanggal`, `jumlah`) VALUES
(126, 181, NULL, 9),
(127, 182, NULL, 7),
(128, 183, NULL, 7),
(129, 184, NULL, 12),
(130, 185, NULL, 10),
(131, 186, NULL, 10),
(132, 187, NULL, 10),
(133, 188, NULL, 6),
(134, 189, NULL, 8),
(135, 190, NULL, 10),
(136, 191, NULL, 10),
(137, 192, NULL, 9),
(138, 193, NULL, 10),
(139, 194, NULL, 10),
(140, 195, NULL, 8),
(141, 196, NULL, 10),
(142, 197, NULL, 7),
(143, 198, NULL, 3),
(144, 199, NULL, 5),
(145, 200, NULL, 10),
(146, 201, NULL, 8),
(147, 202, NULL, 9),
(148, 203, NULL, 12),
(149, 204, NULL, 11),
(150, 205, NULL, 9),
(151, 206, NULL, 13),
(152, 207, NULL, 13),
(153, 208, NULL, 12),
(154, 209, NULL, 13),
(155, 210, NULL, 14),
(156, 211, NULL, 10),
(157, 212, NULL, 10),
(158, 213, NULL, 9),
(159, 214, NULL, 13),
(160, 215, NULL, 17),
(161, 216, NULL, 2),
(162, 217, NULL, 6),
(163, 218, NULL, 19),
(164, 219, NULL, 7),
(165, 220, NULL, 10),
(166, 221, NULL, 9),
(167, 222, NULL, 10),
(168, 223, NULL, 10),
(169, 224, NULL, 5),
(170, 225, NULL, 8),
(171, 226, NULL, 10),
(172, 227, NULL, 8),
(173, 228, NULL, 10),
(174, 229, NULL, 7),
(175, 230, NULL, 9),
(176, 231, NULL, 10),
(177, 232, NULL, 10),
(178, 233, NULL, 9),
(179, 234, NULL, 7),
(180, 235, NULL, 5),
(181, 236, NULL, 6),
(182, 237, NULL, 8),
(183, 238, NULL, 8),
(184, 239, NULL, 3),
(185, 240, NULL, 4),
(186, 241, NULL, 2),
(187, 242, NULL, 1),
(188, 243, NULL, 2),
(189, 244, NULL, 6),
(190, 245, NULL, 4),
(191, 246, NULL, 3),
(192, 247, NULL, 5),
(193, 248, NULL, 2),
(194, 249, NULL, 2),
(195, 250, NULL, 3),
(196, 251, NULL, 1),
(197, 252, NULL, 1),
(198, 253, NULL, 2),
(199, 254, NULL, 6),
(200, 255, NULL, 2),
(201, 256, NULL, 2),
(202, 257, NULL, 3),
(203, 258, NULL, 2),
(204, 259, NULL, 1),
(205, 260, NULL, 1),
(206, 261, NULL, 3),
(207, 262, NULL, 3),
(208, 263, NULL, 1),
(209, 264, NULL, 7),
(210, 265, NULL, 3),
(211, 266, NULL, 18),
(212, 267, NULL, 14),
(213, 268, NULL, 1),
(214, 198, NULL, 0),
(215, 181, NULL, 8),
(216, 182, NULL, 0),
(217, 237, NULL, 7),
(218, 183, NULL, 0),
(219, 238, NULL, 7),
(220, 187, NULL, 2),
(221, 188, NULL, 4),
(222, 192, NULL, 5),
(223, 202, NULL, 4),
(224, 203, NULL, 8),
(225, 204, NULL, 3),
(226, 226, NULL, 7),
(227, 227, NULL, 1),
(228, 238, NULL, 5),
(229, 195, NULL, 3),
(230, 216, NULL, 0),
(231, 266, NULL, 17),
(232, 181, NULL, 6),
(233, 190, NULL, 4),
(234, 199, NULL, 1),
(235, 208, NULL, 11),
(236, 225, NULL, 7),
(237, 230, NULL, 8),
(238, 269, NULL, 1),
(239, 181, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `info_barang`
--

CREATE TABLE `info_barang` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info_barang`
--

INSERT INTO `info_barang` (`id`, `id_barang`, `id_brand`, `status`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 2, 2, 1),
(4, 3, 3, 1),
(5, 4, 4, 1),
(6, 4, 1, 1),
(7, 5, 4, 1),
(8, 5, 1, 1),
(13, 7, 7, 1),
(14, 8, 8, 1),
(15, 9, 9, 1),
(16, 10, 10, 1),
(17, 11, 11, 1),
(18, 12, 12, 1),
(22, 1, 16, 1),
(23, 1, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `nama`, `status`) VALUES
(1, 'Mesin Fogging', 1),
(2, 'Mesin Pemotong Rumput', 1),
(3, 'Tempat Sampah Dorong', 1),
(4, 'Gunting Ranting', 1),
(5, 'Alat Penyemprot (Handsprayer)', 1),
(7, 'Kelambu Malaria', 1),
(8, 'Gergaji Pohon', 1),
(9, 'Suf Nylon Rope', 1),
(10, 'Motor Roda Tiga', 1),
(11, 'Nozzle', 1),
(12, 'Generator Listrik', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(2) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Pengiriman'),
(2, 'Gudang'),
(3, 'Pembelian'),
(4, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(2) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Diajukan'),
(2, 'Diproses'),
(3, 'Dikirim'),
(4, 'Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_barang`
--

CREATE TABLE `tipe_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(6) NOT NULL,
  `id_info_barang` int(11) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `limit_stok` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipe_barang`
--

INSERT INTO `tipe_barang` (`id`, `kode_barang`, `id_info_barang`, `tipe`, `limit_stok`, `status`) VALUES
(21, '010101', 1, 'Mini KB-100', 5, 1),
(22, '010102', 1, 'Mini SP-2000', 5, 1),
(23, '010103', 1, 'ULV TLV-25', 5, 1),
(24, '010104', 1, 'ULV Cold Fogger TLV-25', 5, 1),
(25, '010105', 1, '150 KA', 5, 1),
(26, '010106', 1, '150 KB', 5, 1),
(27, '010107', 1, '250 KB (Portable Chemical)', 5, 1),
(28, '020101', 2, 'TAC 368E', 5, 1),
(29, '020102', 2, 'TAC 221', 5, 1),
(30, '020103', 2, 'TAC 318', 5, 1),
(31, '020104', 2, 'TAC 328', 5, 1),
(32, '020105', 2, 'TG 328', 5, 1),
(33, '020106', 2, 'TLM 18', 5, 1),
(34, '020107', 2, 'TLM 20', 5, 1),
(35, '020108', 2, 'TLM 18 E', 5, 1),
(36, '020109', 2, 'TLM 340', 5, 1),
(37, '020201', 3, 'GBC 338', 5, 1),
(38, '030301', 4, '100 Liter', 5, 1),
(39, '030302', 4, '120 Liter', 5, 1),
(40, '040401', 5, 'Gunting ranting/dahan', 5, 1),
(41, '040101', 6, 'Gunting ranting/dahan', 5, 1),
(42, '070701', 13, '190cm x 180cm x 180cm', 5, 1),
(43, '070702', 13, '190cm x 190cm x 150cm', 5, 1),
(44, '070703', 13, '190cm x 190cm x 180cm', 5, 1),
(45, '070704', 13, '200cm x 100cm x 150cm', 5, 1),
(46, '070705', 13, '180cm x 160cm x 150cm', 5, 1),
(47, '050401', 7, '1 Liter', 5, 1),
(48, '050402', 7, '2 Liter', 5, 1),
(49, '050403', 7, '4 Liter', 5, 1),
(50, '050404', 7, '5 Liter', 5, 1),
(51, '050405', 7, '7 Liter', 5, 1),
(52, '050406', 7, '9 Liter (IO5)', 5, 1),
(53, '050407', 7, '15 Liter', 5, 1),
(54, '050408', 7, '16 Liter', 5, 1),
(55, '050409', 7, '17 Liter (IO5)', 5, 1),
(56, '050101', 8, 'Mist-3', 5, 1),
(57, '050102', 8, 'Mist-5', 5, 1),
(58, '050103', 8, 'Mist-8', 5, 1),
(59, '080801', 14, 'GCS 58 (20\" SN)', 5, 1),
(60, '080802', 14, 'GCS 58 (22\" SN)', 5, 1),
(61, '080803', 14, 'GCS 58 (20\" HN)', 5, 1),
(62, '080804', 14, 'GCS 58 (22\" HN)', 5, 1),
(63, '080805', 14, 'GCS 770', 5, 1),
(64, '090901', 15, '1/2 LB Yellow 2,4mm', 5, 1),
(65, '090902', 15, '1 LB Yellow 2,4mm', 5, 1),
(66, '101001', 16, 'RX 150', 5, 1),
(67, '101002', 16, '150 New Standard', 5, 1),
(68, '101003', 16, 'XP 150', 5, 1),
(69, '101004', 16, 'XP Long 150', 5, 1),
(70, '111101', 17, 'Current Nozzle (CN) 02', 5, 1),
(71, '111102', 17, 'Universal Kyd', 5, 1),
(72, '111103', 17, 'Apollo', 5, 1),
(73, '121201', 18, 'Prowatt M1', 5, 1),
(74, '121202', 18, 'Prowatt M3', 5, 1),
(75, '121203', 18, 'Prowatt M7', 5, 1),
(76, '121204', 18, 'Powerdex DX-4000', 5, 1),
(77, '121205', 18, 'Powerdex DX-10000', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `status` int(2) NOT NULL,
  `keterangan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_transaksi`, `id_user`, `tanggal`, `status`, `keterangan`) VALUES
(1, 'BM202009001', 3, '2020-01-01', 3, ''),
(2, 'BM202009002', 3, '2020-01-02', 3, ''),
(3, 'BM202009003', 3, '2020-01-02', 3, ''),
(4, 'BM202009004', 3, '2020-01-03', 3, ''),
(5, 'BM202009005', 3, '2020-09-03', 4, ''),
(6, 'BM202009006', 3, '2020-01-03', 3, ''),
(23, 'BK202009001', 1, '2020-01-03', 3, ''),
(24, 'BK202009002', 1, '2020-01-06', 3, ''),
(25, 'BK202009003', 1, '2020-01-11', 3, ''),
(26, 'BK202009004', 1, '2020-01-15', 3, ''),
(27, 'BK202009005', 1, '2020-01-20', 3, ''),
(28, 'BK202009006', 1, '2020-01-30', 3, ''),
(29, 'BM202009007', 3, '2020-09-18', 4, ''),
(30, 'BK202009007', 1, '2020-09-18', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `role` int(2) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role`, `username`, `password`, `nama`) VALUES
(1, 1, 'pengiriman', 'd7394563946d263a0014dd98c678c43b', 'pengiriman'),
(2, 2, 'gudang', '202446dd1d6028084426867365b0c7a1', 'gudang'),
(3, 3, 'pembelian', '025b94c9e65037bb7317c8e25389155d', 'pembelian'),
(4, 4, 'manager', '21232f297a57a5a743894a0e4a801fc3', 'Manajer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`,`id_tipe_barang`),
  ADD KEY `id_tipe_barang` (`id_tipe_barang`);

--
-- Indexes for table `brand_barang`
--
ALTER TABLE `brand_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`,`id_tipe_barang`),
  ADD KEY `id_tipe_barang` (`id_tipe_barang`);

--
-- Indexes for table `history_barang`
--
ALTER TABLE `history_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang_masuk` (`id_barang_masuk`);

--
-- Indexes for table `info_barang`
--
ALTER TABLE `info_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`,`id_brand`),
  ADD KEY `id_brand` (`id_brand`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipe_barang`
--
ALTER TABLE `tipe_barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `id_info_barang` (`id_info_barang`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT for table `brand_barang`
--
ALTER TABLE `brand_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=397;

--
-- AUTO_INCREMENT for table `history_barang`
--
ALTER TABLE `history_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `info_barang`
--
ALTER TABLE `info_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipe_barang`
--
ALTER TABLE `tipe_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_tipe_barang`) REFERENCES `tipe_barang` (`id`);

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_tipe_barang`) REFERENCES `tipe_barang` (`id`);

--
-- Constraints for table `history_barang`
--
ALTER TABLE `history_barang`
  ADD CONSTRAINT `history_barang_ibfk_1` FOREIGN KEY (`id_barang_masuk`) REFERENCES `barang_masuk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `info_barang`
--
ALTER TABLE `info_barang`
  ADD CONSTRAINT `info_barang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `jenis_barang` (`id`),
  ADD CONSTRAINT `info_barang_ibfk_2` FOREIGN KEY (`id_brand`) REFERENCES `brand_barang` (`id`);

--
-- Constraints for table `tipe_barang`
--
ALTER TABLE `tipe_barang`
  ADD CONSTRAINT `tipe_barang_ibfk_1` FOREIGN KEY (`id_info_barang`) REFERENCES `info_barang` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
