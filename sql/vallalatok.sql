-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Nov 21. 18:15
-- Kiszolgáló verziója: 10.4.25-MariaDB
-- PHP verzió: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `vallalat`
--
CREATE DATABASE IF NOT EXISTS `vallalat` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `vallalat`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dolgozik`
--

CREATE TABLE `dolgozik` (
  `id` int(11) NOT NULL,
  `projekt_id` int(11) NOT NULL,
  `projekt_nev` varchar(40) NOT NULL,
  `dolgozo_id` int(11) NOT NULL,
  `kezdes_datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `dolgozik`
--

INSERT INTO `dolgozik` (`id`, `projekt_id`, `projekt_nev`, `dolgozo_id`, `kezdes_datum`) VALUES
(81, 8, 'Havi könyvelés 2022.11', 37, '2022-11-17'),
(82, 8, 'Havi könyvelés 2022.11', 21, '2022-11-10'),
(83, 9, 'Havi könyvelés 2022.12', 38, '2022-11-17'),
(84, 9, 'Havi könyvelés 2022.12', 39, '2022-11-26'),
(85, 9, 'Havi könyvelés 2022.12', 37, '2022-11-11'),
(86, 10, 'Havi könyvelés 2022.10', 22, '2022-11-04'),
(87, 4, 'Bútor Webáruház', 14, '2022-11-12'),
(88, 4, 'Bútor Webáruház', 15, '2022-11-11'),
(89, 4, 'Bútor Webáruház', 16, '2022-11-12'),
(90, 4, 'Bútor Webáruház', 17, '2022-11-26'),
(91, 4, 'Bútor Webáruház', 27, '2022-11-17'),
(92, 5, 'CRM Rendszer', 16, '2022-11-18'),
(93, 5, 'CRM Rendszer', 17, '2022-11-19'),
(94, 5, 'CRM Rendszer', 28, '2022-11-20');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dolgozo`
--

CREATE TABLE `dolgozo` (
  `id` int(11) NOT NULL,
  `veznev` varchar(40) NOT NULL,
  `kernev` varchar(40) NOT NULL,
  `nem` tinyint(4) NOT NULL,
  `szulido` date NOT NULL,
  `fizetes` int(11) NOT NULL,
  `munkakor` varchar(40) NOT NULL,
  `profilkep` varchar(100) DEFAULT NULL,
  `osztaly_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `dolgozo`
--

INSERT INTO `dolgozo` (`id`, `veznev`, `kernev`, `nem`, `szulido`, `fizetes`, `munkakor`, `profilkep`, `osztaly_id`) VALUES
(14, 'Rózsa', 'István', 1, '1998-02-28', 350000, 'Webfejlesztő', '1669050461_1000_F_230608264_fhoqBuEyiCPwT0h9RtnsuNAId3hWungP.jpg', 13),
(15, 'Kiss', 'Béla', 1, '2022-11-17', 450000, 'Frontend fejlesztő', NULL, 13),
(16, 'Lak', 'Zoltán', 1, '2046-01-15', 500000, 'Backend fejlesztő', NULL, 13),
(17, 'Vicc', 'Elek', 1, '1995-11-11', 600000, 'Backend fejlesztő', '1669050472_man-avatar-profile-vector-21372076.jpg', 13),
(18, 'Szalmon', 'Ella', 0, '2022-11-17', 360000, 'Projekt Manager', '1669050479_woman-avatar-profile-vector-21372074.jpg', 13),
(19, 'Trab', 'Antal', 1, '2022-11-17', 450000, 'Projekt Manager', NULL, 15),
(20, 'Nyomó', 'Réka', 0, '2022-11-25', 580000, 'Projekt Manager', '1669050489_woman-avatar-profile-vector-21372074.jpg', 15),
(21, 'Major', 'Anna', 0, '2022-11-11', 390000, 'Könyvelő', '1669050497_woman-avatar-profile-vector-21372074.jpg', 16),
(22, 'Dil', 'Emma', 0, '2022-11-10', 395000, 'Könyvelő', NULL, 16),
(23, 'Har', 'Mónika', 0, '2001-05-05', 700000, 'Adminisztrátor', NULL, 15),
(24, 'Rabsz', 'Olga', 0, '1955-04-15', 560000, 'HR vezető', NULL, 14),
(25, 'Elektrom', 'Ágnes', 0, '1960-11-01', 890000, 'HR vezető', NULL, 14),
(26, 'Para', 'Zita', 0, '2022-11-09', 456000, 'Tesztelő', NULL, 13),
(27, 'Git', 'Áron', 1, '2022-11-10', 740000, 'Devops', '1669050514_1000_F_230608264_fhoqBuEyiCPwT0h9RtnsuNAId3hWungP.jpg', 13),
(28, 'Am', 'Erika', 0, '2022-11-17', 560000, 'Devops', NULL, 13),
(29, 'Eszte', 'Lenke', 0, '2022-11-07', 250000, 'HR kapcsolattartó', NULL, 14),
(30, 'Heu', 'Réka', 0, '2022-12-01', 360000, 'HR kapcsolattartó', NULL, 14),
(31, 'Kala', 'Pál', 1, '1965-02-03', 360000, 'HR kapcsolattartó', '1669050532_man-avatar-profile-vector-21372076.jpg', 14),
(32, 'Virra', 'Dóra', 0, '2022-11-11', 480000, 'Automatizált Tesztelő', NULL, 13),
(33, 'Fá', 'Zoltán', 1, '1945-05-06', 450000, 'Automatizált Tesztelő', '1669050542_man-avatar-profile-vector-21372076.jpg', 13),
(34, 'Wincs', 'Eszter', 0, '1996-07-15', 190000, 'Tesztelő', NULL, 13),
(35, 'Mor', 'Zsolt', 1, '1963-08-09', 260000, 'Admin', NULL, 15),
(36, 'Kispál', 'Inka', 1, '1985-09-09', 360000, 'Admin', NULL, 15),
(37, 'Könyv', 'Elek', 1, '1975-10-15', 560000, 'Könyvelő', NULL, 16),
(38, 'Koaxk', 'Ábel', 1, '2022-11-01', 750000, 'Vezető Könyvelő', NULL, 16),
(39, 'Raj', 'Zóra', 0, '2022-11-09', 600000, 'Könyvelő', NULL, 16);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `osztaly`
--

CREATE TABLE `osztaly` (
  `id` int(11) NOT NULL,
  `nev` varchar(40) NOT NULL,
  `manager_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `osztaly`
--

INSERT INTO `osztaly` (`id`, `nev`, `manager_id`) VALUES
(13, 'Szoftverfejlesztő', 14),
(15, 'Adminisztrátor', 19),
(14, 'HR', 24),
(16, 'Könyvelés', 37);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `projekt`
--

CREATE TABLE `projekt` (
  `id` int(11) NOT NULL,
  `nev` varchar(40) NOT NULL,
  `ar` int(11) NOT NULL,
  `aktiv` tinyint(4) NOT NULL,
  `osztaly_id` int(11) DEFAULT NULL,
  `osztaly_nev` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `projekt`
--

INSERT INTO `projekt` (`id`, `nev`, `ar`, `aktiv`, `osztaly_id`, `osztaly_nev`) VALUES
(4, 'Bútor Webáruház', 790000, 1, 13, 'Szoftverfejlesztő'),
(5, 'CRM Rendszer', 1500000, 1, 13, 'Szoftverfejlesztő'),
(6, 'ERP Rendszer', 2500000, 1, 13, 'Szoftverfejlesztő'),
(7, 'Rózsakert virág áruház', 600000, 1, 13, 'Szoftverfejlesztő'),
(8, 'Havi könyvelés 2022.11', 60000, 0, 16, 'Könyvelés'),
(9, 'Havi könyvelés 2022.12', 150000, 0, 16, 'Könyvelés'),
(10, 'Havi könyvelés 2022.10', 190000, 1, 16, 'Könyvelés'),
(11, 'Eszközbeszerzés', 900000, 1, 15, 'Adminisztrátor'),
(12, 'Műszaki Webáruház', 500000, 0, 13, 'Szoftverfejlesztő'),
(13, 'Autó Centrum', 500000, 0, 13, 'Szoftverfejlesztő'),
(14, 'Hálózat fejlesztés', 850000, 0, 15, 'Adminisztrátor');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `dolgozik`
--
ALTER TABLE `dolgozik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dolgozik_projekt_id` (`projekt_id`),
  ADD KEY `fk_dolgozik_dolgozo_id` (`dolgozo_id`),
  ADD KEY `projekt_nev` (`projekt_nev`);

--
-- A tábla indexei `dolgozo`
--
ALTER TABLE `dolgozo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `osztaly_id` (`osztaly_id`);

--
-- A tábla indexei `osztaly`
--
ALTER TABLE `osztaly`
  ADD PRIMARY KEY (`id`,`nev`),
  ADD KEY `fk_manager_azonosito` (`manager_id`);

--
-- A tábla indexei `projekt`
--
ALTER TABLE `projekt`
  ADD PRIMARY KEY (`id`,`nev`),
  ADD KEY `osztaly_id` (`osztaly_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `dolgozik`
--
ALTER TABLE `dolgozik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT a táblához `dolgozo`
--
ALTER TABLE `dolgozo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT a táblához `osztaly`
--
ALTER TABLE `osztaly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT a táblához `projekt`
--
ALTER TABLE `projekt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `dolgozik`
--
ALTER TABLE `dolgozik`
  ADD CONSTRAINT `fk_dolgozik_dolgozo_id` FOREIGN KEY (`dolgozo_id`) REFERENCES `dolgozo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dolgozik_projekt_id` FOREIGN KEY (`projekt_id`) REFERENCES `projekt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `dolgozo`
--
ALTER TABLE `dolgozo`
  ADD CONSTRAINT `fk_dolgozo_osztaly` FOREIGN KEY (`osztaly_id`) REFERENCES `osztaly` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Megkötések a táblához `osztaly`
--
ALTER TABLE `osztaly`
  ADD CONSTRAINT `fk_manager_azonosito` FOREIGN KEY (`manager_id`) REFERENCES `dolgozo` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Megkötések a táblához `projekt`
--
ALTER TABLE `projekt`
  ADD CONSTRAINT `fk_osztaly_id` FOREIGN KEY (`osztaly_id`) REFERENCES `osztaly` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
