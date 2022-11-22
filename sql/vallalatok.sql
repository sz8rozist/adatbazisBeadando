-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Nov 22. 15:51
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
(1, 4, 'Rózsakert virág áruház', 1, '2022-11-13'),
(2, 4, 'Rózsakert virág áruház', 3, '2022-11-12'),
(3, 4, 'Rózsakert virág áruház', 4, '2022-11-12'),
(4, 4, 'Rózsakert virág áruház', 7, '2022-11-18'),
(5, 7, 'Havi könyvelés 2022.10', 8, '2022-11-11'),
(6, 7, 'Havi könyvelés 2022.10', 9, '2022-11-18'),
(7, 7, 'Havi könyvelés 2022.10', 24, '2022-11-13'),
(8, 8, 'Eszközbeszerzés', 10, '2022-11-06'),
(9, 8, 'Eszközbeszerzés', 22, '2022-11-19'),
(10, 8, 'Eszközbeszerzés', 23, '2022-12-01');

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
(1, 'Rózsa', 'István', 1, '1998-02-28', 350000, 'Webfejlesztő', '1669050461_1000_F_230608264_fhoqBuEyiCPwT0h9RtnsuNAId3hWungP.jpg', 1),
(2, 'Kiss', 'Béla', 1, '2022-11-17', 450000, 'Frontend fejlesztő', NULL, 1),
(3, 'Lak', 'Zoltán', 1, '2046-01-15', 500000, 'Backend fejlesztő', NULL, 1),
(4, 'Vicc', 'Elek', 1, '1995-11-11', 600000, 'Backend fejlesztő', '1669050472_man-avatar-profile-vector-21372076.jpg', 1),
(5, 'Szalmon', 'Ella', 0, '2022-11-17', 360000, 'Projekt Manager', '1669050479_woman-avatar-profile-vector-21372074.jpg', 1),
(6, 'Trab', 'Antal', 1, '2022-11-17', 450000, 'Projekt Manager', NULL, 1),
(7, 'Nyomó', 'Réka', 0, '2022-11-25', 580000, 'Projekt Manager', '1669050489_woman-avatar-profile-vector-21372074.jpg', 1),
(8, 'Major', 'Anna', 0, '2022-11-11', 390000, 'Könyvelő', '1669050497_woman-avatar-profile-vector-21372074.jpg', 4),
(9, 'Dil', 'Emma', 0, '2022-11-10', 395000, 'Könyvelő', NULL, 4),
(10, 'Har', 'Mónika', 0, '2001-05-05', 700000, 'Adminisztrátor', NULL, 2),
(11, 'Rabsz', 'Olga', 0, '1955-04-15', 560000, 'HR vezető', NULL, 3),
(12, 'Elektrom', 'Ágnes', 0, '1960-11-01', 890000, 'HR vezető', NULL, 3),
(13, 'Para', 'Zita', 0, '2022-11-09', 456000, 'Tesztelő', NULL, 1),
(14, 'Git', 'Áron', 1, '2022-11-10', 740000, 'Devops', '1669050514_1000_F_230608264_fhoqBuEyiCPwT0h9RtnsuNAId3hWungP.jpg', 1),
(15, 'Am', 'Erika', 0, '2022-11-17', 560000, 'Devops', NULL, 1),
(16, 'Eszte', 'Lenke', 0, '2022-11-07', 250000, 'HR kapcsolattartó', NULL, 3),
(17, 'Heu', 'Réka', 0, '2022-12-01', 360000, 'HR kapcsolattartó', NULL, 3),
(18, 'Kala', 'Pál', 1, '1965-02-03', 360000, 'HR kapcsolattartó', '1669050532_man-avatar-profile-vector-21372076.jpg', 3),
(19, 'Virra', 'Dóra', 0, '2022-11-11', 480000, 'Automatizált Tesztelő', NULL, 1),
(20, 'Fá', 'Zoltán', 1, '1945-05-06', 450000, 'Automatizált Tesztelő', '1669050542_man-avatar-profile-vector-21372076.jpg', 1),
(21, 'Wincs', 'Eszter', 0, '1996-07-15', 190000, 'Tesztelő', NULL, 1),
(22, 'Mor', 'Zsolt', 1, '1963-08-09', 260000, 'Admin', NULL, 2),
(23, 'Kispál', 'Inka', 1, '1985-09-09', 360000, 'Admin', NULL, 2),
(24, 'Könyv', 'Elek', 1, '1975-10-15', 560000, 'Könyvelő', NULL, 4),
(25, 'Koaxk', 'Ábel', 1, '2022-11-01', 750000, 'Vezető Könyvelő', NULL, 4),
(26, 'Raj', 'Zóra', 0, '2022-11-09', 600000, 'Könyvelő', NULL, 4);

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
(1, 'Szoftverfejlesztő', 1),
(3, 'HR', 2),
(4, 'Könyvelés', 9),
(2, 'Adminisztrátor', 22);

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
(1, 'Bútor Webáruház', 790000, 1, 1, 'Szoftverfejlesztő'),
(2, 'CRM Rendszer', 1500000, 1, 1, 'Szoftverfejlesztő'),
(3, 'ERP Rendszer', 2500000, 1, 1, 'Szoftverfejlesztő'),
(4, 'Rózsakert virág áruház', 600000, 1, 1, 'Szoftverfejlesztő'),
(5, 'Havi könyvelés 2022.11', 60000, 0, 4, 'Könyvelés'),
(6, 'Havi könyvelés 2022.12', 150000, 0, 4, 'Könyvelés'),
(7, 'Havi könyvelés 2022.10', 190000, 1, 4, 'Könyvelés'),
(8, 'Eszközbeszerzés', 900000, 1, 2, 'Adminisztrátor'),
(9, 'Műszaki Webáruház', 500000, 0, 1, 'Szoftverfejlesztő'),
(10, 'Autó Centrum', 500000, 0, 1, 'Szoftverfejlesztő'),
(11, 'Hálózat fejlesztés', 850000, 0, 2, 'Adminisztrátor');

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
  ADD KEY `osztaly_id` (`osztaly_id`),
  ADD KEY `osztaly_nev` (`osztaly_nev`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `dolgozik`
--
ALTER TABLE `dolgozik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `dolgozo`
--
ALTER TABLE `dolgozo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT a táblához `osztaly`
--
ALTER TABLE `osztaly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `projekt`
--
ALTER TABLE `projekt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `fk_manager_id` FOREIGN KEY (`manager_id`) REFERENCES `dolgozo` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Megkötések a táblához `projekt`
--
ALTER TABLE `projekt`
  ADD CONSTRAINT `fk_projekt_osztaly_id` FOREIGN KEY (`osztaly_id`) REFERENCES `osztaly` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
