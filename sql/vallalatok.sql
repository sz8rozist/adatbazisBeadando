-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Okt 02. 12:14
-- Kiszolgáló verziója: 10.4.25-MariaDB
-- PHP verzió: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `vallalatok`
--
CREATE DATABASE IF NOT EXISTS `vallalatok` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `vallalatok`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dolgozik`
--

DROP TABLE IF EXISTS `dolgozik`;
CREATE TABLE IF NOT EXISTS `dolgozik` (
  `azonosito` int(11) NOT NULL,
  `dolgozo_azonosito` int(11) NOT NULL,
  `vallalat_cegjegyzekszam` int(11) NOT NULL,
  `miota` date NOT NULL,
  `fizetes` int(11) NOT NULL,
  PRIMARY KEY (`azonosito`),
  KEY `ki_dolgozik` (`dolgozo_azonosito`),
  KEY `hol_dolgozik` (`vallalat_cegjegyzekszam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dolgozik_rajta`
--

DROP TABLE IF EXISTS `dolgozik_rajta`;
CREATE TABLE IF NOT EXISTS `dolgozik_rajta` (
  `azonosito` int(11) NOT NULL,
  `projekt_nev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `dolgozo_azonosito` int(11) NOT NULL,
  PRIMARY KEY (`azonosito`),
  KEY `dolgozo` (`dolgozo_azonosito`),
  KEY `projekt` (`projekt_nev`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dolgozo`
--

DROP TABLE IF EXISTS `dolgozo`;
CREATE TABLE IF NOT EXISTS `dolgozo` (
  `azonosito` int(11) NOT NULL,
  `vezeteknev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `keresztnev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `keszseg` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `telefonszam` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`azonosito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `projekt`
--

DROP TABLE IF EXISTS `projekt`;
CREATE TABLE IF NOT EXISTS `projekt` (
  `nev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `idotartam` int(11) NOT NULL,
  `idotartam_me` varchar(10) COLLATE utf8_hungarian_ci NOT NULL,
  `ar` int(11) NOT NULL,
  PRIMARY KEY (`nev`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vallalat`
--

DROP TABLE IF EXISTS `vallalat`;
CREATE TABLE IF NOT EXISTS `vallalat` (
  `cegjegyzekszam` int(11) NOT NULL,
  `nev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `alapitasi_datum` date NOT NULL,
  `orszag` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `iranyitoszam` int(11) NOT NULL,
  `varos` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `utca` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `hazszam` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`cegjegyzekszam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `dolgozik`
--
ALTER TABLE `dolgozik`
  ADD CONSTRAINT `hol_dolgozik` FOREIGN KEY (`vallalat_cegjegyzekszam`) REFERENCES `vallalat` (`cegjegyzekszam`),
  ADD CONSTRAINT `ki_dolgozik` FOREIGN KEY (`dolgozo_azonosito`) REFERENCES `dolgozo` (`azonosito`);

--
-- Megkötések a táblához `dolgozik_rajta`
--
ALTER TABLE `dolgozik_rajta`
  ADD CONSTRAINT `dolgozo` FOREIGN KEY (`dolgozo_azonosito`) REFERENCES `dolgozo` (`azonosito`),
  ADD CONSTRAINT `projekt` FOREIGN KEY (`projekt_nev`) REFERENCES `projekt` (`nev`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
