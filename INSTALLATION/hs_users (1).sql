-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2017 at 06:17 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foxtrot_highscores`
--

-- --------------------------------------------------------

--
-- Table structure for table `hs_users`
--

CREATE TABLE IF NOT EXISTS `hs_users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rights` int(1) NOT NULL DEFAULT '0',
  `mode` tinyint(1) NOT NULL DEFAULT '0',
  `total_level` int(11) NOT NULL DEFAULT '0',
  `overall_xp` bigint(20) NOT NULL,
  `attack_xp` int(11) NOT NULL,
  `defence_xp` int(11) NOT NULL,
  `strength_xp` int(11) NOT NULL,
  `constitution_xp` int(11) NOT NULL,
  `ranged_xp` int(11) NOT NULL,
  `prayer_xp` int(11) NOT NULL,
  `magic_xp` int(11) NOT NULL,
  `cooking_xp` int(11) NOT NULL,
  `woodcutting_xp` int(11) NOT NULL,
  `fletching_xp` int(11) NOT NULL,
  `fishing_xp` int(11) NOT NULL,
  `firemaking_xp` int(11) NOT NULL,
  `crafting_xp` int(11) NOT NULL,
  `smithing_xp` int(11) NOT NULL,
  `mining_xp` int(11) NOT NULL,
  `herblore_xp` int(11) NOT NULL,
  `agility_xp` int(11) NOT NULL,
  `thieving_xp` int(11) NOT NULL,
  `slayer_xp` int(11) NOT NULL,
  `farming_xp` int(11) NOT NULL,
  `runecrafting_xp` int(11) NOT NULL,
  `hunter_xp` int(11) NOT NULL,
  `construction_xp` int(11) NOT NULL,
  `summoning_xp` int(11) NOT NULL,
  `dungeoneering_xp` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `hs_users`
--

INSERT INTO `hs_users` (`id`, `username`, `rights`, `mode`, `total_level`, `overall_xp`, `attack_xp`, `defence_xp`, `strength_xp`, `constitution_xp`, `ranged_xp`, `prayer_xp`, `magic_xp`, `cooking_xp`, `woodcutting_xp`, `fletching_xp`, `fishing_xp`, `firemaking_xp`, `crafting_xp`, `smithing_xp`, `mining_xp`, `herblore_xp`, `agility_xp`, `thieving_xp`, `slayer_xp`, `farming_xp`, `runecrafting_xp`, `hunter_xp`, `construction_xp`, `summoning_xp`, `dungeoneering_xp`) VALUES
(1, 'King Fox 1', 0, 1, 2496, 5000000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000),
(2, 'King Fox 2', 0, 0, 2496, 5000000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000),
(3, 'King Fox 3', 0, 0, 2496, 4995000000, 12000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000),
(4, 'King Fox 4', 0, 0, 2496, 5000000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000, 200000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hs_users`
--
ALTER TABLE `hs_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hs_users`
--
ALTER TABLE `hs_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
