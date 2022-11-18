-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Nov 18. 11:11
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

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dolgozik`
--

CREATE TABLE `dolgozik` (
  `id` int(11) NOT NULL,
  `projekt_id` int(11) NOT NULL,
  `dolgozo_id` int(11) NOT NULL,
  `kezdes_datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `dolgozik`
--

INSERT INTO `dolgozik` (`id`, `projekt_id`, `dolgozo_id`, `kezdes_datum`) VALUES
(5, 2, 1, '2022-11-24');

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
  `profilkep` varchar(50) DEFAULT NULL,
  `osztaly_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `dolgozo`
--

INSERT INTO `dolgozo` (`id`, `veznev`, `kernev`, `nem`, `szulido`, `fizetes`, `munkakor`, `profilkep`, `osztaly_id`) VALUES
(1, 'Rózsa', 'István', 1, '1998-02-28', 350000, '', '1668328397_Képernyőkép_20221110_153719.png', 3),
(2, 'Kiss', 'Béla', 1, '1955-02-05', 450000, '', '0', 2),
(3, 'asd', 'dsadsad', 1, '2022-11-09', 25000, '', '0', 2),
(4, 'asdas', 'dsadsad', 1, '2022-11-25', 465546546, '', '', 2),
(9, 'Kele', 'Dominik', 1, '2022-11-25', 500000, '', '', 3),
(11, 'Valaki', 'Valaki', 1, '2022-11-26', 50000, '', '1668431333_Képernyőkép 2022-11-10 153721.png', 2);

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
(2, 'HR', 1),
(3, 'dsad', 2),
(8, 'DASD', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `projekt`
--

CREATE TABLE `projekt` (
  `id` int(11) NOT NULL,
  `nev` varchar(40) NOT NULL,
  `ar` int(11) NOT NULL,
  `aktiv` tinyint(4) NOT NULL,
  `osztaly_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `projekt`
--

INSERT INTO `projekt` (`id`, `nev`, `ar`, `aktiv`, `osztaly_id`) VALUES
(2, 'DASDdas', 50000, 0, 2),
(3, 'EDAS', 500, 1, 3);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `dolgozik`
--
ALTER TABLE `dolgozik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dolgozik_projekt_id` (`projekt_id`),
  ADD KEY `fk_dolgozik_dolgozo_id` (`dolgozo_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_manager_azonosito` (`manager_id`);

--
-- A tábla indexei `projekt`
--
ALTER TABLE `projekt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `osztaly_id` (`osztaly_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `dolgozik`
--
ALTER TABLE `dolgozik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `dolgozo`
--
ALTER TABLE `dolgozo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `osztaly`
--
ALTER TABLE `osztaly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `projekt`
--
ALTER TABLE `projekt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
