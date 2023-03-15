-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Mar 2023, 00:07
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `linguanow`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accesslevels`
--

CREATE TABLE `accesslevels` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `accesslevels`
--

INSERT INTO `accesslevels` (`id`, `name`) VALUES
(1, 'dyrektor'),
(2, 'nauczyciel'),
(3, 'uczeń');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admissions`
--

CREATE TABLE `admissions` (
  `id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `coursesId` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('Done','Undone') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `admissions`
--

INSERT INTO `admissions` (`id`, `fname`, `lname`, `email`, `phone`, `coursesId`, `date`, `status`) VALUES
(22, 'Adam', 'Kowalski', 'adamkowalski@gmail.com', '555-123-456', 1, '2022-01-01 10:00:00', 'Undone'),
(23, 'Anna', 'Nowak', 'annanowak@gmail.com', '555-234-567', 2, '2022-01-02 11:00:00', 'Undone'),
(24, 'Piotr', 'Lewandowski', 'piotrlewandowski@gmail.com', '555-345-678', 3, '2022-01-03 12:00:00', 'Undone'),
(25, 'Katarzyna', 'Wójcik', 'katarzynawojcik@gmail.com', '555-456-789', 4, '2022-01-04 13:00:00', 'Undone'),
(26, 'Tomasz', 'Kamiński', 'tomaszkaminski@gmail.com', '555-567-890', 5, '2022-01-05 14:00:00', 'Undone'),
(27, 'Magdalena', 'Kowalczyk', 'magdalenakowalczyk@gmail.com', '555-678-901', 6, '2022-01-06 15:00:00', 'Undone'),
(28, 'Marcin', 'Zieliński', 'marcinzielinski@gmail.com', '555-789-012', 7, '2022-01-07 16:00:00', 'Undone'),
(29, 'Aleksandra', 'Szymańska', 'aleksandraszymanska@gmail.com', '555-890-123', 8, '2022-01-08 17:00:00', 'Undone'),
(30, 'Jan', 'Dąbrowski', 'jandabrowski@gmail.com', '555-901-234', 9, '2022-01-09 18:00:00', 'Undone'),
(31, 'Karolina', 'Jankowska', 'karolinajankowska@gmail.com', '555-012-345', 1, '2022-01-10 19:00:00', 'Undone'),
(32, 'Piotr', 'Maj', 'piotr.maj642@gmail.com', '123123123', 3, '2023-03-01 22:08:39', 'Undone');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `type` enum('Online','Stacjonarny') NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `type`, `price`) VALUES
(1, 'Kursy dla dzieci', 'To kursy językowe dla dzieci w wieku od 6 do 11 lat. Program nauczania jest dostosowany do wieku i potrzeb uczniów. Zajęcia są prowadzone w sposób zabawowy i interaktywny, aby zachęcić dzieci do nauki języka angielskiego.', 'Stacjonarny', 1980),
(2, 'Kursy dla młodzieży', 'To kursy językowe dla młodzieży w wieku od 12 do 17 lat. Program nauczania jest dostosowany do wieku i poziomu zaawansowania uczniów. Zajęcia mają na celu rozwijanie umiejętności komunikacyjnych i gramatycznych w języku angielskim.', 'Stacjonarny', 2000),
(3, 'Kursy dla dorosłych', 'To kursy językowe dla dorosłych, którzy chcą nauczyć się języka angielskiego lub doskonalić swoje umiejętności językowe. Program nauczania jest dostosowany do indywidualnych potrzeb i celów uczniów.', 'Stacjonarny', 2500),
(4, 'Kursy egzaminacyjne (egzamin FCE/CAE)', 'To kursy przygotowujące do egzaminów Cambridge English: First (FCE) i Advanced (CAE). Zajęcia koncentrują się na rozwijaniu umiejętności językowych wymaganych na egzaminie, takich jak czytanie, pisanie, słuchanie i mówienie.', 'Stacjonarny', 3000),
(5, 'Kursy egzaminacyjne (egzamin ósmoklasisty)', 'To kursy przygotowujące uczniów klas ósmych do egzaminu ósmoklasisty z języka angielskiego. Zajęcia koncentrują się na rozwijaniu umiejętności językowych wymaganych na egzaminie, takich jak czytanie, pisanie, słuchanie i mówienie.', 'Stacjonarny', 1600),
(6, 'Kursy egzaminacyjne (egzamin maturalny)', 'To kursy przygotowujące uczniów do egzaminu maturalnego z języka angielskiego. Zajęcia koncentrują się na rozwijaniu umiejętności językowych wymaganych na egzaminie, takich jak czytanie, pisanie, słuchanie i mówienie.', 'Stacjonarny', 1840),
(7, 'Dorośli A2 (poziom podstawowy wyższy)', 'To kurs online dla dorosłych, którzy chcą nauczyć się języka angielskiego od podstaw na poziomie wyższym niż podstawowy. Program nauczania skupia się na rozwijaniu umiejętności językowych, takich jak słownictwo, gramatyka, mówienie i słuchanie.', 'Online', 2100),
(8, 'Dorośli B2 (poziom średniozaawansowany wyższy)', 'To kurs online dla dorosłych, którzy chcą doskonalić swoje umiejętności językowe na poziomie średniozaawansowanym wyższym. Program nauczania skupia się na rozwijaniu umiejętności językowych, takich jak gramatyka, słownictwo, rozumienie ze słuchu, czytanie i mówienie.', 'Online', 2300),
(9, 'Dzieci klasa 7, B1 (poziom średniozaawansowany)', 'To kurs online dla dzieci w klasie siódmej, którzy chcą rozwijać swoje umiejętności językowe na poziomie średniozaawansowanym. Program nauczania skupia się na rozwijaniu umiejętności językowych w zakresie gramatyki, słownictwa, czytania, rozumienia ze słuchu i mówienia w języku angielskim.', 'Online', 2150);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `fromId` int(11) NOT NULL,
  `toId` int(11) NOT NULL,
  `subject` text COLLATE utf8_polish_ci NOT NULL,
  `message` text COLLATE utf8_polish_ci NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `fromId`, `toId`, `subject`, `message`, `date`) VALUES
(1, 1, 2, 'Przywitanie', 'Witam!', '2023-03-13 08:20:22'),
(2, 2, 1, 'Witaj', 'Co tam?', '2023-03-13 23:41:14');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `teachers`
--

INSERT INTO `teachers` (`id`, `userId`, `description`, `img`) VALUES
(1, 1, 'Jan jest nauczycielem z ponad 10-letnim doświadczeniem w nauczaniu języka angielskiego. Jego pasją jest pomaganie swoim uczniom osiągnąć swój pełny potencjał w nauce języka angielskiego. Jan jest ekspertem w zakresie gramatyki angielskiej i ma wiele ciekawych technik nauczania, które sprawiają, że lekcje są interaktywne i przyjemne dla uczniów.', '1.jpg'),
(2, 3, 'Anna jest młodą nauczycielką z wielką pasją do nauczania języka angielskiego. Uwielbia pracować z dziećmi i młodzieżą i wykorzystuje innowacyjne metody, aby uczniowie byli zainteresowani nauką języka angielskiego. Anna zawsze stara się przekazać swoją wiedzę w ciekawy i przystępny sposób, co sprawia, że jej lekcje są zawsze wypełnione pozytywną energią.', '2.jpg'),
(3, 2, 'Piotr jest doświadczonym nauczycielem języka angielskiego, który ma ponad 15 lat doświadczenia w nauczaniu języka angielskiego na różnych poziomach zaawansowania. Piotr specjalizuje się w nauczaniu biznesowego języka angielskiego i pomaga swoim uczniom rozwijać umiejętności komunikacyjne potrzebne w świecie biznesu. Piotr jest również autorem wielu podręczników do nauki języka angielskiego, które są wykorzystywane w szkołach na całym świecie.', '3.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `accessLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fname`, `lname`, `phone`, `address`, `city`, `accessLevel`) VALUES
(1, 'jkowalski@example.com', '$2y$10$aOK0GhrEjZuIhcLDj/gFpOHlNS8Odl4jaHkD5lciLzv5MZRKqCsiK', 'Jan', 'Kowalski', '111-222-333', 'ul. Główna 1', 'Warszawa', 2),
(2, 'pwisniewski@example.com', '$2y$10$l6D8HZtXh1RM8LiEaMW3VugAyLPhERQUA4bmPxxkQRCbybd0R.zDm', 'Piotr', 'Wiśniewski', '333-222-111', 'ul. Zielona 10', 'Gdańsk', 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `accesslevels`
--
ALTER TABLE `accesslevels`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `accesslevels`
--
ALTER TABLE `accesslevels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
