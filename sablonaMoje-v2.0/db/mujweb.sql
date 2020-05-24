-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 19. bře 2020, 01:58
-- Verze serveru: 10.4.8-MariaDB
-- Verze PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `mujweb`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `kontakty`
--

CREATE TABLE `kontakty` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(20) NOT NULL,
  `prijmeni` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `adresaStat` varchar(60) NOT NULL,
  `adresaMesto` varchar(60) NOT NULL,
  `adresaUlice` varchar(60) NOT NULL,
  `hodnost` enum('ZAKLADATEL','PRACOVNÍK','ÚČETNÍ','PRODAVAČ') NOT NULL DEFAULT 'PRACOVNÍK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `kontakty`
--

INSERT INTO `kontakty` (`id`, `jmeno`, `prijmeni`, `email`, `telefon`, `adresaStat`, `adresaMesto`, `adresaUlice`, `hodnost`) VALUES
(1, 'Petr', 'Boháč', 'roxiogames@email.cz', '+420 607 885 123', 'Česká Republika', 'Mšeno', 'Jatecká 399', 'ZAKLADATEL'),
(2, 'Pacros', 'Pala', 'pacros@centrum.cz', '+420 111 222 333', 'Česká Republika', 'Kropáčova Vrutice', 'Pacrosacka 9', 'PRODAVAČ');

-- --------------------------------------------------------

--
-- Struktura tabulky `novinky`
--

CREATE TABLE `novinky` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `nadpis` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `autor` varchar(250) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `text` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vypisuji data pro tabulku `novinky`
--

INSERT INTO `novinky` (`id`, `datum`, `nadpis`, `autor`, `email`, `text`) VALUES
(36, '2020-03-18', 'Novinka', 'Petr', 'roxiogames@email.cz', 'tohle je novinka\r\n');

-- --------------------------------------------------------

--
-- Struktura tabulky `uvod`
--

CREATE TABLE `uvod` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vypisuji data pro tabulku `uvod`
--

INSERT INTO `uvod` (`id`, `datum`, `text`) VALUES
(1, '2018-12-08', 'lorem ipsum lmfao f'),
(2, '2020-03-03', 'hodne narachany kamo');

-- --------------------------------------------------------

--
-- Struktura tabulky `zaznamy_hostu`
--

CREATE TABLE `zaznamy_hostu` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `prezdivka` varchar(250) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vypisuji data pro tabulku `zaznamy_hostu`
--

INSERT INTO `zaznamy_hostu` (`id`, `datum`, `prezdivka`, `email`, `text`) VALUES
(5, '2018-12-02', 'První', 'prv@pp.pl', '1111111111111111'),
(6, '2018-12-02', 'Druhý', 'druhy@pp.pl', '2222222222222222222\r\n222222\r\n22222'),
(7, '2018-12-02', 'Třetí', 'tret@pp.pl', '3333333333333\r\n3333333\r\n3');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `kontakty`
--
ALTER TABLE `kontakty`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `novinky`
--
ALTER TABLE `novinky`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Klíče pro tabulku `uvod`
--
ALTER TABLE `uvod`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Klíče pro tabulku `zaznamy_hostu`
--
ALTER TABLE `zaznamy_hostu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `kontakty`
--
ALTER TABLE `kontakty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `novinky`
--
ALTER TABLE `novinky`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pro tabulku `uvod`
--
ALTER TABLE `uvod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `zaznamy_hostu`
--
ALTER TABLE `zaznamy_hostu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
