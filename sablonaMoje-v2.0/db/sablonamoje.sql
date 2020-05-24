-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 24. kvě 2020, 19:07
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
-- Databáze: `sablonamoje`
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
(2, 'Pacrosak', 'Pala', 'pacros@centrum.cz', '+420 111 222 333', 'Česká Republika', 'Kropáčova Vrutice', 'Pacrosacka 9', 'PRODAVAČ');

-- --------------------------------------------------------

--
-- Struktura tabulky `navigation`
--

CREATE TABLE `navigation` (
  `id` int(11) NOT NULL,
  `displayName` varchar(60) NOT NULL,
  `url` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `removable` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `navigation`
--

INSERT INTO `navigation` (`id`, `displayName`, `url`, `enabled`, `removable`) VALUES
(1, 'Kontakty', 'contacts.php', 1, 1),
(2, 'Záznamy hostů', 'visitors.php', 1, 1),
(3, 'Novinky', 'news.php', 1, 1),
(4, 'Domů', 'index.php', 1, 1),
(7, 'Fotogalerie', 'photogallery.php', 1, 1);

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
  `text` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vypisuji data pro tabulku `novinky`
--

INSERT INTO `novinky` (`id`, `datum`, `nadpis`, `autor`, `email`, `text`, `file`) VALUES
(48, '2020-05-20', 'Novinka w/o file', 'Pzdrs', 'petrbohac3@seznam.cz', 'Novinka neobsahuje ani PDF ani JPG.', ''),
(49, '2020-05-20', 'Novinka w/ file => PDF', 'Pzdrs', 'petrbohac3@seznam.cz', 'Novinka obsahuje PDF.', 'data/news/udrzba_b.pdf'),
(50, '2020-05-20', 'Novinka w/ file => JPG', 'Pzdrs', 'petrbohac3@seznam.cz', 'Novinka obsahuje JPG.', 'data/news/naruto.jpg');

-- --------------------------------------------------------

--
-- Struktura tabulky `photogallery`
--

CREATE TABLE `photogallery` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `path` varchar(255) NOT NULL,
  `fullResPath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `photogallery`
--

INSERT INTO `photogallery` (`id`, `description`, `path`, `fullResPath`) VALUES
(8, 'Pes #1', 'data/foto/dogcunt1.jpg', 'data/nahledy/dogcunt1.jpg'),
(9, 'Pes #2', 'data/foto/dogcunt2.jpg', 'data/nahledy/dogcunt2.jpg'),
(10, 'Pes #3', 'data/foto/dogcunt3.jpg', 'data/nahledy/dogcunt3.jpg'),
(11, 'Pes #4', 'data/foto/dogcunt4.jpg', 'data/nahledy/dogcunt4.jpg'),
(12, 'Pes #5', 'data/foto/dogcunt5.jpg', 'data/nahledy/dogcunt5.jpg');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, '2018-12-08', 'lorem ipsum lmfao ff3'),
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
(5, '2018-12-02', 'První', 'prv@pp.pl', '111111111111111123'),
(6, '2018-12-02', 'Druhý', 'druhy@pp.pl', '2222222222222222222\r\n222222\r\n22222');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `kontakty`
--
ALTER TABLE `kontakty`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `novinky`
--
ALTER TABLE `novinky`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Klíče pro tabulku `photogallery`
--
ALTER TABLE `photogallery`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT pro tabulku `navigation`
--
ALTER TABLE `navigation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `novinky`
--
ALTER TABLE `novinky`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pro tabulku `photogallery`
--
ALTER TABLE `photogallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `uvod`
--
ALTER TABLE `uvod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `zaznamy_hostu`
--
ALTER TABLE `zaznamy_hostu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
