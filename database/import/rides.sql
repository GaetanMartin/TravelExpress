-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 11 nov. 2017 à 15:56
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `travelexpress`
--

--
-- Déchargement des données de la table `rides`
--

INSERT INTO `rides` (`id`, `car_id`, `start_time`, `source_city_id`, `dest_city_id`, `nb_seats_offered`, `price`, `luggage_size`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-12-11 11:00:00', 1, 3, 3, '5.00', 'messages.large', '2017-11-10 21:05:38', '2017-11-10 21:05:38'),
(2, 1, '2018-03-11 11:00:00', 1256, 1375, 3, '5.00', 'messages.medium', '2017-11-10 21:20:41', '2017-11-10 21:20:41'),
(3, 1, '2018-03-11 11:00:00', 1256, 1375, 3, '50.00', 'messages.medium', '2017-11-10 21:20:52', '2017-11-10 21:20:52'),
(4, 1, '2018-03-15 10:00:00', 1256, 1375, 3, '51.00', 'messages.medium', '2017-11-10 21:21:54', '2017-11-10 21:21:54'),
(5, 1, '2019-06-11 11:00:00', 1256, 1375, 3, '54.00', 'messages.medium', '2017-11-10 21:23:18', '2017-11-10 21:23:18'),
(6, 1, '2017-11-23 11:30:00', 1256, 1375, 3, '589.00', 'messages.medium', '2017-11-10 21:36:43', '2017-11-10 21:36:43'),
(7, 1, '2017-11-11 11:30:00', 1256, 1375, 3, '5.00', 'messages.medium', '2017-11-10 21:37:01', '2017-11-10 21:37:01'),
(8, 1, '2017-11-22 09:30:00', 1256, 1375, 3, '5.00', 'messages.medium', '2017-11-10 21:38:01', '2017-11-10 21:38:01'),
(9, 1, '2017-11-01 11:45:00', 1256, 1375, 3, '5.00', 'messages.medium', '2017-11-10 21:52:42', '2017-11-10 21:52:42'),
(10, 1, '2017-11-22 12:45:00', 1256, 1375, 2, '5.00', 'messages.medium', '2017-11-10 22:48:51', '2017-11-10 22:48:51'),
(11, 1, '2017-11-11 12:45:00', 1256, 1375, 6, '5.00', 'messages.medium', '2017-11-10 22:49:05', '2017-11-10 22:49:05'),
(12, 1, '2017-11-11 12:45:00', 1261, 1375, 1, '0.00', 'messages.large', '2017-11-10 22:49:29', '2017-11-10 22:49:29'),
(13, 2, '2017-11-11 12:45:00', 1256, 1375, 4, '7.00', 'messages.large', '2017-11-10 22:50:23', '2017-11-10 22:50:23'),
(14, 2, '2017-11-11 14:30:00', 1256, 1375, 3, '5.00', 'messages.large', '2017-11-11 00:32:59', '2017-11-11 00:32:59'),
(15, 1, '2017-11-11 17:00:00', 1256, 1375, 3, '5.00', 'messages.medium', '2017-11-11 02:59:38', '2017-11-11 02:59:38'),
(16, 2, '2017-11-11 18:15:00', 1256, 1375, 3, '5.00', 'messages.medium', '2017-11-11 04:21:22', '2017-11-11 04:21:22'),
(17, 1, '2017-11-11 19:00:00', 1256, 1375, 3, '50.00', 'messages.large', '2017-11-11 04:56:48', '2017-11-11 04:56:48'),
(18, 2, '2017-11-12 21:30:00', 1256, 1375, 3, '35.00', 'messages.small', '2017-11-11 05:24:17', '2017-11-11 05:24:17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
