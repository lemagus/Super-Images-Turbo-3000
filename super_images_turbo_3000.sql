-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 08, 2018 at 04:42 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `super_images_turbo_3000`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `orientation` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `style` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ppl_nb` tinyint(3) UNSIGNED DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `orientation`, `style`, `ppl_nb`, `date`, `created_at`) VALUES
(1, '1_recto', NULL, NULL, NULL, '2018-10-11 15:38:27', '2018-10-11 15:38:27'),
(2, '2_recto', NULL, NULL, NULL, '2018-10-11 15:38:27', '2018-10-11 15:38:27'),
(3, '3_recto', NULL, NULL, NULL, '2018-10-11 15:38:27', '2018-10-11 15:38:27'),
(4, '4_recto', NULL, NULL, NULL, '2018-10-11 15:38:27', '2018-10-11 15:38:27'),
(5, '5_recto', NULL, NULL, NULL, '2018-10-11 15:38:27', '2018-10-11 15:38:27'),
(6, '6_recto', NULL, NULL, NULL, '2018-10-11 15:38:27', '2018-10-11 15:38:27'),
(7, '7_recto', NULL, NULL, NULL, '2018-10-11 15:38:27', '2018-10-11 15:38:27'),
(8, '8_recto', NULL, NULL, NULL, '2018-10-11 15:38:27', '2018-10-11 15:38:27'),
(9, '9_recto', NULL, NULL, NULL, '2018-10-11 15:38:27', '2018-10-11 15:38:27'),
(10, '10_recto', NULL, NULL, NULL, '2018-10-11 15:38:27', '2018-10-11 15:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `images2keywords`
--

CREATE TABLE `images2keywords` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `image_id` smallint(5) UNSIGNED NOT NULL,
  `keyword_id` smallint(5) UNSIGNED NOT NULL,
  `total` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images2keywords`
--

INSERT INTO `images2keywords` (`id`, `image_id`, `keyword_id`, `total`) VALUES
(1, 1, 1, 4),
(2, 1, 2, 4),
(3, 1, 3, 4),
(4, 1, 4, 4),
(5, 1, 5, 4),
(6, 1, 6, 4),
(7, 1, 7, 4),
(8, 1, 8, 4),
(9, 2, 3, 4),
(10, 2, 9, 4),
(11, 2, 10, 4),
(12, 2, 6, 4),
(13, 2, 11, 4),
(14, 2, 12, 4),
(15, 2, 8, 4),
(16, 2, 13, 4),
(17, 3, 3, 4),
(18, 3, 9, 4),
(19, 3, 10, 4),
(20, 3, 6, 4),
(21, 3, 11, 4),
(22, 3, 12, 4),
(23, 3, 14, 4),
(24, 4, 9, 4),
(25, 4, 15, 4),
(26, 4, 16, 4),
(27, 4, 17, 4),
(28, 4, 18, 4),
(29, 4, 6, 4),
(30, 4, 19, 4),
(31, 5, 20, 4),
(32, 5, 21, 4),
(33, 5, 22, 4),
(34, 5, 23, 4),
(35, 5, 6, 4),
(36, 5, 24, 4),
(37, 6, 25, 4),
(38, 6, 26, 4),
(39, 7, 27, 4),
(40, 7, 28, 4),
(41, 7, 18, 4),
(42, 7, 23, 4),
(43, 7, 6, 4),
(44, 7, 29, 4),
(45, 7, 30, 4),
(46, 8, 31, 4),
(47, 8, 27, 4),
(48, 8, 16, 4),
(49, 8, 32, 4),
(50, 8, 33, 4),
(51, 9, 27, 4),
(52, 9, 16, 4),
(53, 9, 28, 4),
(54, 9, 18, 4),
(55, 9, 34, 4),
(56, 9, 35, 4),
(57, 9, 36, 4),
(58, 9, 37, 4),
(59, 10, 16, 4),
(60, 10, 27, 4),
(61, 10, 28, 4),
(62, 10, 38, 4),
(63, 10, 39, 4),
(64, 10, 40, 4),
(65, 10, 41, 4);

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `name`, `category`, `created_at`) VALUES
(1, 'ecriture', 'activité', '2018-10-11 15:38:27'),
(2, 'maillot', 'vêtement', '2018-10-11 15:38:27'),
(3, 'assis', NULL, '2018-10-11 15:38:27'),
(4, 'camping', 'lieu', '2018-10-11 15:38:27'),
(5, 'profil', NULL, '2018-10-11 15:38:27'),
(6, 'ciel', NULL, '2018-10-11 15:38:27'),
(7, 'femme', 'genre', '2018-10-11 15:38:27'),
(8, 'exterieur', NULL, '2018-10-11 15:38:27'),
(9, 'lecture', NULL, '2018-10-11 15:38:27'),
(10, 'rocher', NULL, '2018-10-11 15:38:27'),
(11, 'homme', 'genre', '2018-10-11 15:38:27'),
(12, 'short', NULL, '2018-10-11 15:38:27'),
(13, 'nature', NULL, '2018-10-11 15:38:27'),
(14, 'torse-nu nature?', NULL, '2018-10-11 15:38:27'),
(15, 'lunettes', NULL, '2018-10-11 15:38:27'),
(16, 'debout', NULL, '2018-10-11 15:38:27'),
(17, 'jupe', NULL, '2018-10-11 15:38:27'),
(18, 'chemise', NULL, '2018-10-11 15:38:27'),
(19, 'fortifications', NULL, '2018-10-11 15:38:27'),
(20, 'grille', NULL, '2018-10-11 15:38:27'),
(21, 'murs', NULL, '2018-10-11 15:38:27'),
(22, 'brique', NULL, '2018-10-11 15:38:27'),
(23, 'arbres', 'nature', '2018-10-11 15:38:27'),
(24, 'verdure - nature? Construction maison?', NULL, '2018-10-11 15:38:27'),
(25, 'grilles', NULL, '2018-10-11 15:38:27'),
(26, 'vitraux', NULL, '2018-10-11 15:38:27'),
(27, 'enfant', NULL, '2018-10-11 15:38:27'),
(28, 'costume', NULL, '2018-10-11 15:38:27'),
(29, 'mur', NULL, '2018-10-11 15:38:27'),
(30, 'griffure négatif?', NULL, '2018-10-11 15:38:27'),
(31, 'fauteuil', NULL, '2018-10-11 15:38:27'),
(32, 'chapeau', NULL, '2018-10-11 15:38:27'),
(33, 'costume-enfant? Type de vêtement? intérieur? Tache? Salon photo?', NULL, '2018-10-11 15:38:27'),
(34, 'cravate', NULL, '2018-10-11 15:38:27'),
(35, 'chaussettes', NULL, '2018-10-11 15:38:27'),
(36, 'siege / chaise', NULL, '2018-10-11 15:38:27'),
(37, 'photographe - salon photo?- livre à la main?', NULL, '2018-10-11 15:38:27'),
(38, 'crvate', NULL, '2018-10-11 15:38:27'),
(39, 'chaussette', NULL, '2018-10-11 15:38:27'),
(40, 'batiment', NULL, '2018-10-11 15:38:27'),
(41, 'nœud à la manche? Livre à la main- messe?', NULL, '2018-10-11 15:38:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images2keywords`
--
ALTER TABLE `images2keywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `images2keywords`
--
ALTER TABLE `images2keywords`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
