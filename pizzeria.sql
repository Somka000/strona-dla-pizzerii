-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 27, 2024 at 04:21 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzeria`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `Id_klienta` int(11) NOT NULL,
  `Nazwisko` text NOT NULL,
  `Imię` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klienci`
--

INSERT INTO `klienci` (`Id_klienta`, `Nazwisko`, `Imię`) VALUES
(1, 'Schabowski', 'Edward'),
(2, 'Urwiński', 'Boniek'),
(6, 'Amanda', 'Górnewska'),
(12, 'Piłsudski', 'Józef'),
(20, 'Dmowski', 'Roman'),
(25, 'test', 'test'),
(26, 'testy', 'testy'),
(27, '112233', '112233'),
(28, 'ostatecznytestttt', 'ostatecznytestttt');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `menu`
--

CREATE TABLE `menu` (
  `Id_pizzy` int(11) NOT NULL,
  `Nazwa` text NOT NULL,
  `Rozmiar` int(11) NOT NULL COMMENT '(w centrymatrach)',
  `Cena` int(11) NOT NULL COMMENT '(w złotym)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`Id_pizzy`, `Nazwa`, `Rozmiar`, `Cena`) VALUES
(1, 'Ananasowa', 70, 56),
(2, 'Babciowa', 45, 40),
(3, 'Hawajska', 31, 23),
(4, 'Smaczna', 60, 99),
(5, 'Gigant', 140, 579),
(6, 'Mirko', 5, 4),
(7, 'Gwiezdna', 66, 79);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `miejscowosc`
--

CREATE TABLE `miejscowosc` (
  `id_miejscowosc` int(11) NOT NULL,
  `miejscowosc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `miejscowosc`
--

INSERT INTO `miejscowosc` (`id_miejscowosc`, `miejscowosc`) VALUES
(1, 'Grzybowo'),
(2, 'Paryż'),
(3, 'Kraków'),
(4, 'Berlin'),
(5, 'Ulały');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `login` text NOT NULL,
  `haslo` text NOT NULL,
  `uprawnienia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `login`, `haslo`, `uprawnienia`) VALUES
(1, 'pracownik', '$2y$10$tNBNcKxv3nrah2IQWxjJje5b3fLSqPaJjm5pMB0Kz5ICu9mZyK.2O', 'pracownik'),
(2, 'administator', '$2y$10$tNBNcKxv3nrah2IQWxjJje5b3fLSqPaJjm5pMB0Kz5ICu9mZyK.2O', 'administrator'),
(3, 'wlasciciel', '$2y$10$tNBNcKxv3nrah2IQWxjJje5b3fLSqPaJjm5pMB0Kz5ICu9mZyK.2O', 'wlasciciel');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `Id_zamowienia` int(11) NOT NULL,
  `Id_klienta` int(11) DEFAULT NULL,
  `Id_pizzy` int(11) DEFAULT NULL,
  `Data_zamowienia` date DEFAULT NULL,
  `Adres` text DEFAULT NULL,
  `Id_miejscowosc` int(11) NOT NULL,
  `Uwagi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zamowienia`
--

INSERT INTO `zamowienia` (`Id_zamowienia`, `Id_klienta`, `Id_pizzy`, `Data_zamowienia`, `Adres`, `Id_miejscowosc`, `Uwagi`) VALUES
(2, 6, 2, '2024-01-30', 'Ul. Testowa 2', 1, 'Na wywóz'),
(3, 20, 3, '2024-01-26', 'Ul. Testowa 63', 2, 'Na miejscu'),
(45, 28, 1, '2024-01-27', 'ostatecznytestttt', 1, 'dowoz');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`Id_klienta`);

--
-- Indeksy dla tabeli `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`Id_pizzy`);

--
-- Indeksy dla tabeli `miejscowosc`
--
ALTER TABLE `miejscowosc`
  ADD PRIMARY KEY (`id_miejscowosc`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`Id_zamowienia`),
  ADD KEY `fk_Id_klienta` (`Id_klienta`),
  ADD KEY `fk_Id_pizzy` (`Id_pizzy`),
  ADD KEY `id_miejscowosc` (`Id_miejscowosc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klienci`
--
ALTER TABLE `klienci`
  MODIFY `Id_klienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `Id_pizzy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `miejscowosc`
--
ALTER TABLE `miejscowosc`
  MODIFY `id_miejscowosc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `Id_zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `fk_Id_klienta` FOREIGN KEY (`Id_klienta`) REFERENCES `klienci` (`Id_klienta`),
  ADD CONSTRAINT `fk_Id_pizzy` FOREIGN KEY (`Id_pizzy`) REFERENCES `menu` (`Id_pizzy`),
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`id_miejscowosc`) REFERENCES `miejscowosc` (`id_miejscowosc`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
