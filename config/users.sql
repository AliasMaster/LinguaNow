-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Mar 2023, 18:28
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
(1, 'jkowalski@example.com', '$2y$10$9a3cskedJroiqzB5Z5ZDtOnk3liVxfP/BGyC02VfPMeJapMx3DB22', 'Jan', 'Kowalski', '111-222-333', 'ul. Główna 1', 'Warszawa', 2),
(2, 'anowak@example.com', '$2y$10$p8LElA/kgwoVCoPmyCR6KOZa0xJHNGwzEZbI6jQzM9JhZuyErk3fK', 'Anna', 'Nowak', '222-111-333', 'ul. Słoneczna 5', 'Kraków', 2),
(3, 'pwisniewski@example.com', '$2y$10$jACnnuK.JtaD7Cs806QAUOxHqAB6HqDrD9pl9kEl.x1AZYT.eGGuC', 'Piotr', 'Wiśniewski', '333-222-111', 'ul. Zielona 10', 'Gdańsk', 2),
(4, 'janek@example.com', '$2y$10$HvZBdyVKH1WrU6czpScO8unpYf97oiyFur/pBwHapwMopIBXGBNOS', 'Jan', 'Kowalczyk', '234-242-131', 'ul. Nowa 10', 'Warszawa', 3),
(5, 'ania@example.com', '$2y$10$YRmOq0TluyGT99ykk6rvg.0xbyiVnRLv8XQ4J1aQkYKJotVnw2tZu', 'Anna', 'Kwaśniewska', '878-424-243', 'ul. Kwiatowa 3', 'Kraków', 3),
(6, 'tomek@example.com', '$2y$10$QGkpwNa5xOTMM2Xyfp/VXOa4m0/waaGM902tYniBKtIlSCBfIJ7FW', 'Tomasz', 'Wójcik', '872-422-423', 'ul. Zielona 7', 'Poznań', 3),
(7, 'kasia@example.com', '$2y$10$a.xRZuKVqo9aybVQzPhTWOQPL2DE.KWF5qfUhvnwdCFxt3U4o0BVW', 'Katarzyna', 'Kowalczyk', '472-894-734', 'ul. Lipowa 2', 'Gdańsk', 3),
(8, 'pawel@example.com', '$2y$10$n.PARMfkesvSDnyj7Hd3GePWX4L/31JyONYNd0LwgVJhe3dXYcskm', 'Paweł', 'Kaczmarek', '876-432-132', 'ul. Czerwona 5', 'Łódź', 3),
(9, 'marta@example.com', '$2y$10$KFl92FeSt8W4LgDlE7bwVeQgLWYluVWOILlwhJyAkdz7xxM/ubiDi', 'Marta', 'Zając', '231-997-122', 'ul. Słoneczna 9', 'Wrocław', 3),
(10, 'mateusz@example.com', '$2y$10$l5p86juqD8l9AHcUvF0O6uGQEnB12Muap8rLH3fnJObqiwpKuoEkC', 'Mateusz', 'Włodarczyk', '123-123-123', 'Jagiellońska 13', 'Sosnowiec', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
