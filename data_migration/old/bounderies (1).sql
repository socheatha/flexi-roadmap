-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2019 at 03:30 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flex_roadmap_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `bounderies`
--

CREATE TABLE `bounderies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bounderies`
--

INSERT INTO `bounderies` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Boeng Kak Ti Mouy', NULL, NULL),
(2, 'Boeng Kak Ti Pir', NULL, NULL),
(3, 'Boeng Keng Kang Bei', NULL, NULL),
(4, 'Boeng Keng Kang Pir', NULL, NULL),
(5, 'Boeng Keng Kang Ti Bei', NULL, NULL),
(6, 'Boeng Keng Kang Ti Mouy', NULL, NULL),
(7, 'Boeng Prolit', NULL, NULL),
(8, 'Boeng Raing', NULL, NULL),
(9, 'Boeng Salang', NULL, NULL),
(10, 'Boeng Trabaek', NULL, NULL),
(11, 'Boeng Tumpun', NULL, NULL),
(12, 'Chak Angrae Kraom', NULL, NULL),
(13, 'Chaktomuk', NULL, NULL),
(14, 'Chamkar Mon', NULL, NULL),
(15, 'Chaom Chau', NULL, NULL),
(16, 'Chbar Ampov', NULL, NULL),
(17, 'Chbar Ampov Ti Muoy', NULL, NULL),
(18, 'Chbar Ampov Ti Pir', NULL, NULL),
(19, 'Cheung Aek', NULL, NULL),
(20, 'Chey Chomneas', NULL, NULL),
(21, 'Chomkar Mon', NULL, NULL),
(22, 'Chrouy Changvar', NULL, NULL),
(23, 'Dangkao', NULL, NULL),
(24, 'Doun Penh', NULL, NULL),
(25, 'Kakab', NULL, NULL),
(26, 'Kamboul', NULL, NULL),
(27, 'Kantaok', NULL, NULL),
(28, 'Kbal Kaoh', NULL, NULL),
(29, 'Khmuonh', NULL, NULL),
(30, 'Kong Noy', NULL, NULL),
(31, 'Kouk Roka', NULL, NULL),
(32, 'Krang Pongro', NULL, NULL),
(33, 'Krang Thnong', NULL, NULL),
(34, 'Mean Chey', NULL, NULL),
(35, 'Mittakpheap', NULL, NULL),
(36, 'Monourom', NULL, NULL),
(37, 'Nirouth', NULL, NULL),
(38, 'Olampic', NULL, NULL),
(39, 'Ou Ruessei Ti Bei', NULL, NULL),
(40, 'Ou Ruessei Ti Boun', NULL, NULL),
(41, 'Ou Ruessei Ti Muoy', NULL, NULL),
(42, 'Ou Ruessei Ti Pir', NULL, NULL),
(43, 'Oulampic', NULL, NULL),
(44, 'Phleung Chheh Roteh', NULL, NULL),
(45, 'Phnom Penh Thmey', NULL, NULL),
(46, 'Phsar Chas', NULL, NULL),
(47, 'Phsar Daeum Kor', NULL, NULL),
(48, 'Phsar Daeum Thkov', NULL, NULL),
(49, 'Phsar Depo Ti Bei', NULL, NULL),
(50, 'Phsar Depou Ti Muoy', NULL, NULL),
(51, 'Phsar Depou Ti Pir', NULL, NULL),
(52, 'Phsar Kandal Muoy', NULL, NULL),
(53, 'Phsar Kandal Pir', NULL, NULL),
(54, 'Phsar Thmey Bei', NULL, NULL),
(55, 'Phsar Thmey Muoy', NULL, NULL),
(56, 'Phsar Thmey Pir', NULL, NULL),
(57, 'Ponsang', NULL, NULL),
(58, 'Pou Senchey', NULL, NULL),
(59, 'Prampir Makkaka', NULL, NULL),
(60, 'Prateah Pnov', NULL, NULL),
(61, 'Preaek Aeng', NULL, NULL),
(62, 'Preaek Kampues', NULL, NULL),
(63, 'Preaek Lieb', NULL, NULL),
(64, 'Preaek Pnov', NULL, NULL),
(65, 'Preaek Pra', NULL, NULL),
(66, 'Preaek Ta Sek', NULL, NULL),
(67, 'Preaek Thmei', NULL, NULL),
(68, 'Prey Veaeng', NULL, NULL),
(69, 'Roluos', NULL, NULL),
(70, 'Ruessei Kaev', NULL, NULL),
(71, 'Sak Sampov', NULL, NULL),
(72, 'Samraong Kraom', NULL, NULL),
(73, 'Sen Sok', NULL, NULL),
(74, 'Snao', NULL, NULL),
(75, 'Snaor', NULL, NULL),
(76, 'Spean Thma', NULL, NULL),
(77, 'Srah Chak', NULL, NULL),
(78, 'StuengMean Chey', NULL, NULL),
(79, 'Svay Pak', NULL, NULL),
(80, 'Tien', NULL, NULL),
(81, 'Tonle Basak', NULL, NULL),
(82, 'Toul Kork', NULL, NULL),
(83, 'Toul Svay Prey Ti Pir', NULL, NULL),
(84, 'Trapeang Krasang', NULL, NULL),
(85, 'Tuek L''Tuek L''ak Ti Muoy', NULL, NULL),
(86, 'Tuek L''ak Ti Bei', NULL, NULL),
(87, 'Tuek L''ak Ti Muoy', NULL, NULL),
(88, 'Tuek L''ak Ti Pir', NULL, NULL),
(89, 'Tuek Thla', NULL, NULL),
(90, 'Tumnob Tuek', NULL, NULL),
(91, 'Tuol Sangkae', NULL, NULL),
(92, 'Tuol Svay Prey Ti Muoy', NULL, NULL),
(93, 'Tuol Svay Prey Ti Pir', NULL, NULL),
(94, 'Tuol Tumpug Ti Muoy', NULL, NULL),
(95, 'Tuol Tumpung Ti Pir', NULL, NULL),
(96, 'Veal Sbov', NULL, NULL),
(97, 'Veal Vong', NULL, NULL),
(98, 'Wat Phnom', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bounderies`
--
ALTER TABLE `bounderies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bounderies_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bounderies`
--
ALTER TABLE `bounderies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
