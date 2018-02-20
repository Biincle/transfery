-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Lis 2017, 19:48
-- Wersja serwera: 10.1.9-MariaDB
-- Wersja PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `transfery`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klub`
--

CREATE TABLE `klub` (
  `id` int(6) UNSIGNED NOT NULL,
  `nazwa` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_liga` int(6) DEFAULT NULL,
  `liczba_zawodnikow` int(6) DEFAULT NULL,
  `data_zalozenia` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `klub`
--

INSERT INTO `klub` (`id`, `nazwa`, `id_liga`, `liczba_zawodnikow`, `data_zalozenia`, `logo`) VALUES
(3, 'Wisła Kraków', 1, 0, '2017-11-11', 'https://www.google.pl/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwj92Kr0rp3XAhXIKOwKHR3uA9wQjRwIBw&url=http%3A%2F%2Fpilka24.com.pl%2Flechia-gdansk-3-3-lech-poznan-skrot-meczu-i-bramki%2F&psig=AOvVaw31WsLQb_XCQCEHpqXtNUba&ust=1509625374785553'),
(4, 'FC Kapiszony', 2, 0, '2017-10-03', 'http://test.pl'),
(5, 'Real Madryt', 2, 0, '1902-03-06', 'http://i.imgur.com/Vz2HtKe.png'),
(6, 'Lechia Gdańsk', 1, 0, '1954-01-01', 'Brak'),
(7, 'FC Barcelona', 2, 0, '0001-01-01', 'Brak');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `liga`
--

CREATE TABLE `liga` (
  `id` int(6) UNSIGNED NOT NULL,
  `nazwa` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ilosc_druzyn` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `liga`
--

INSERT INTO `liga` (`id`, `nazwa`, `ilosc_druzyn`) VALUES
(1, 'Ekstraklasa', 16),
(2, 'La Liga Santander', 21),
(3, 'Premier League', 22),
(4, 'Serie A', 18);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pilkarz`
--

CREATE TABLE `pilkarz` (
  `id` int(6) UNSIGNED NOT NULL,
  `imie` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nazwisko` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_klub` int(6) DEFAULT NULL,
  `data_urodzenia` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `narodowosc` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wiek` int(6) DEFAULT NULL,
  `pozycja` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wartosc_rynkowa` decimal(11,2) DEFAULT NULL,
  `zdjecie` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `pilkarz`
--

INSERT INTO `pilkarz` (`id`, `imie`, `nazwisko`, `id_klub`, `data_urodzenia`, `narodowosc`, `wiek`, `pozycja`, `wartosc_rynkowa`, `zdjecie`) VALUES
(3, 'Paweł', 'Ciarka', 4, '1999-05-16', 'PL', 18, 'Napastnik', '1000.00', 'Brak'),
(4, 'Cristiano', 'Ronaldo', 5, '0001-01-01', 'Portugalia', 32, 'Skrzydłowy', '10000000.00', 'Brak'),
(5, 'Grzegorz', 'Rasiak', NULL, '1979-01-12', 'PL', 40, 'Napastnik', '0.00', 'Brak');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `transfer`
--

CREATE TABLE `transfer` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_pilkarz` int(6) DEFAULT NULL,
  `id_klub` int(6) DEFAULT NULL,
  `id_nowy_klub` int(6) DEFAULT NULL,
  `kwota` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `transfer`
--

INSERT INTO `transfer` (`id`, `id_pilkarz`, `id_klub`, `id_nowy_klub`, `kwota`) VALUES
(2, 3, 4, 5, '25000.00'),
(3, 4, 5, 4, '4000.00'),
(4, 5, NULL, 6, '200.00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `nick` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `haslo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `uprawnienia` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `nick`, `haslo`, `email`, `uprawnienia`) VALUES
(7, 'admin', '$2y$10$flTOQQiJsSJK3VoNmcx42u4zDEpTF7KbsN1vs8PeS0xZIJZic201.', 'admin@transfery.cc', 'admin'),
(8, 'test', '$2y$10$Y1i51Ii0oe1GWlUlUfAYeu/ZBScLvx3c4pga9Piq3PunGjskrhF2a', 'test@gmail.com', 'normal');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `klub`
--
ALTER TABLE `klub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liga`
--
ALTER TABLE `liga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pilkarz`
--
ALTER TABLE `pilkarz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `klub`
--
ALTER TABLE `klub`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `liga`
--
ALTER TABLE `liga`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `pilkarz`
--
ALTER TABLE `pilkarz`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
