-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: ian. 05, 2020 la 03:11 PM
-- Versiune server: 10.4.8-MariaDB
-- Versiune PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `ls-project`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(6) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `role` varchar(1000) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `locked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `role`, `name`, `locked`) VALUES
(1, 'iancugeorgealexandru@gmail.com', '6bf6e545dd039485b062ca178bee93a2', 'administrator', 'Alex Iancu', 0);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `coordinates_default`
--

CREATE TABLE `coordinates_default` (
  `id` int(11) NOT NULL,
  `coordX` varchar(1000) NOT NULL,
  `coordY` varchar(1000) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `marker_color` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `coordinates_default`
--

INSERT INTO `coordinates_default` (`id`, `coordX`, `coordY`, `title`, `description`, `marker_color`, `status`) VALUES
(1, '45.6523093', '25.6102746', 'Brasov', 'Brasov oras de poveste', 'purple', 1),
(2, '44.43377984606825', '26.103515625000004', 'Bucuresti', 'Bucuresti ', 'ltblue', 1),
(3, '45.7538355', '21.2257474', 'Timisoara', 'Timisoara', 'green', 1),
(12, '47.161494', '27.5840504', 'Iasi', 'Iasi', 'yellow', 1),
(13, '44.8572343', '24.8719422', 'Pitesti', 'Pitesti', 'red', 1),
(14, '47.05922315', '21.927665180187653', 'Oradea', 'Oradea', 'orange', 1),
(15, '46.6383435', '27.7318681', 'Vaslui', 'Vaslui', 'red', 1),
(16, '45.1469341', '24.6779826', 'Curtea de Arges', 'Curtea de Arges', 'yellow', 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `role` varchar(1000) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `locked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `name`, `locked`) VALUES
(1, 'iancugeorgealexandru@gmail.com', '6bf6e545dd039485b062ca178bee93a2', 'user', 'Alex Iancu', 0),
(2, 'user1@weather.com', '24c9e15e52afc47c225b757e7bee1f9d', 'user', 'User 1', 0);

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `coordinates_default`
--
ALTER TABLE `coordinates_default`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pentru tabele `coordinates_default`
--
ALTER TABLE `coordinates_default`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
