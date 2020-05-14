-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Máj 14. 00:41
-- Kiszolgáló verziója: 10.4.11-MariaDB
-- PHP verzió: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `ply8k1`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `company`
--

CREATE TABLE `company` (
  `id` int(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `company`
--

INSERT INTO `company` (`id`, `name`, `phone`, `email`) VALUES
(0, 'Penny', '+365023416', 'penny@market.com'),
(1, 'CBA', '+362067894', 'cba@shop.com'),
(2, 'Bella', '+363062518', 'bella@supermarket.com');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `permission` int(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `permission`) VALUES
(1, 'Norbert', 'Szucs', 'mail.norbert.szucs@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 1),
(2, 'Elek', 'Teszt', 'Teszt@elek.com', '4b4b04529d87b5c318702bc1d7689f70b15ef4fc', 1),
(3, 'Alexandra', 'Jambor', 'ja20000907@gmail.com', 'ccaa8d8dcc7d030cd6a6768db81f90d0ef976c3d', 1),
(4, 'Asd', 'Asd', 'asd@asd.com', 'c8499454bada15f6d76bbf8cf133960f93f9b4eb', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `workers`
--

CREATE TABLE `workers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(250) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `nationality` varchar(250) NOT NULL DEFAULT 'Undefined',
  `company` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `workers`
--

INSERT INTO `workers` (`id`, `first_name`, `last_name`, `email`, `gender`, `nationality`, `company`) VALUES
(5, 'Alex', 'Jbr', 'ja@gmail.com', 1, 'Hungarian', 0),
(6, 'Béla', 'Jambor', 'email@email.com', 2, 'German', 2),
(7, 'Bence', 'Geszti', 'asd@asd.com', 1, 'Hungarian', 2),
(8, 'Józsi', 'Varázsló', 'jozsi@varazslo.com', 2, 'Enlish', 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
