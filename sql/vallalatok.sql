-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Nov 12. 23:49
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
  `dolgozo_id` int(11) NOT NULL,
  `kezdes_datum` date NOT NULL,
  `munkakor` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `dolgozik`
--

INSERT INTO `dolgozik` (`id`, `projekt_id`, `dolgozo_id`, `kezdes_datum`, `munkakor`) VALUES
(4, 2, 2, '2022-11-16', 'Frontend fejlesztő');

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
  `manager_in_osztaly` int(11) NOT NULL,
  `osztaly_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `dolgozo`
--

INSERT INTO `dolgozo` (`id`, `veznev`, `kernev`, `nem`, `szulido`, `fizetes`, `manager_in_osztaly`, `osztaly_id`) VALUES
(1, 'Rózsa', 'István', 1, '1998-02-28', 350000, 0, 0),
(2, 'Kiss', 'Béla', 1, '1955-02-05', 450000, 0, 2),
(3, 'asd', 'dsadsad', 1, '2022-11-09', 25000, 0, 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `osztaly`
--

CREATE TABLE `osztaly` (
  `id` int(11) NOT NULL,
  `nev` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `osztaly`
--

INSERT INTO `osztaly` (`id`, `nev`) VALUES
(2, 'HR'),
(3, 'dsad');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `projekt`
--

CREATE TABLE `projekt` (
  `id` int(11) NOT NULL,
  `nev` varchar(40) NOT NULL,
  `ar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `projekt`
--

INSERT INTO `projekt` (`id`, `nev`, `ar`) VALUES
(2, 'DASDdas', 50000);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `dolgozik`
--
ALTER TABLE `dolgozik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projekt_id` (`projekt_id`),
  ADD KEY `dolgozo_id` (`dolgozo_id`);

--
-- A tábla indexei `dolgozo`
--
ALTER TABLE `dolgozo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manager_in_osztaly` (`manager_in_osztaly`),
  ADD KEY `osztaly_id` (`osztaly_id`);

--
-- A tábla indexei `osztaly`
--
ALTER TABLE `osztaly`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `projekt`
--
ALTER TABLE `projekt`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `dolgozik`
--
ALTER TABLE `dolgozik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `dolgozo`
--
ALTER TABLE `dolgozo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `osztaly`
--
ALTER TABLE `osztaly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `projekt`
--
ALTER TABLE `projekt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
