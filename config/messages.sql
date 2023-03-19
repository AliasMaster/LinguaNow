-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Mar 2023, 23:44
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
(2, 2, 1, 'Witaj', 'Co tam?', '2023-03-13 23:41:14'),
(138, 1, 2, 'Ważna informacja', 'To jest krótka wiadomość.', '2023-03-19 09:00:00'),
(139, 3, 4, 'Temat wiadomości', 'To jest długa wiadomość, która ma na celu przetestowanie funkcjonalności systemu.', '2023-03-18 12:34:56'),
(140, 2, 1, 'Zaproszenie na spotkanie', 'Cześć, chciałem Cię zaprosić na spotkanie w naszej firmie w przyszłym tygodniu.', '2023-03-17 15:45:00'),
(141, 5, 6, 'Pytanie o projekt', 'Cześć, mam pytanie odnośnie projektu, nad którym pracujemy.', '2023-03-16 18:30:00'),
(142, 6, 5, 'Odpowiedź na pytanie', 'Cześć, oczywiście, chętnie pomogę Ci z projektem. Kiedy moglibyśmy o tym porozmawiać?', '2023-03-15 21:15:00'),
(143, 7, 8, 'Ważna aktualizacja', 'Hej, mamy ważną aktualizację w systemie, która wprowadza kilka nowych funkcjonalności.', '2023-03-14 07:30:00'),
(144, 8, 9, 'Nowy projekt', 'Cześć, mam dla Ciebie propozycję nowego projektu, który chcielibyśmy zrealizować.', '2023-03-13 10:45:00'),
(145, 9, 10, 'Pytanie o harmonogram', 'Cześć, mam pytanie odnośnie harmonogramu projektu. Kiedy możemy się spodziewać pierwszej wersji?', '2023-03-12 14:00:00'),
(146, 10, 1, 'Podsumowanie', 'Dzięki za dzisiejsze spotkanie, podsumowanie naszych rozmów wygląda następująco...', '2023-03-11 17:15:00'),
(147, 1, 3, 'Prośba o pomoc', 'Cześć, potrzebuję pomocy przy konfiguracji naszej aplikacji. Czy mógłbyś mi pomóc?', '2023-03-10 20:30:00'),
(148, 2, 4, 'Zmiana harmonogramu', 'Cześć, niestety musimy zmienić harmonogram naszych działań. Nowy plan wygląda tak...', '2023-03-09 23:45:00'),
(149, 3, 5, 'Raport', 'Cześć, mam dla Ciebie raport dotyczący naszych działań w ostatnim miesiącu. Możesz się z nim zapoznać?', '2023-03-08 11:00:00'),
(150, 4, 6, 'Nowy pomysł', 'Cześć, mam nowy pomysł na projekt, który chcilibyśmy zrealizować. Chętnie wysłucham Twojej opinii na jego temat.', '2023-03-07 14:15:00'),
(151, 5, 7, 'Wniosek', 'Cześć, chciałem przedstawić Ci swój wniosek odnośnie naszej strategii marketingowej.', '2023-03-06 17:30:00'),
(152, 6, 8, 'Podziękowanie', 'Dzięki za pomoc przy problemie, którego nie mogłem rozwiązać. Doceniam Twoje wsparcie.', '2023-03-05 20:45:00'),
(153, 7, 9, 'Przypomnienie', 'Cześć, przypominam o naszym spotkaniu jutro o godzinie 10:00.', '2023-03-04 08:00:00'),
(154, 8, 10, 'Pytanie o dostępność', 'Cześć, mam pytanie odnośnie Twojej dostępności na przyszły tydzień. Czy mógłbyś mi powiedzieć, kiedy możemy się umówić na spotkanie?', '2023-03-03 11:15:00'),
(155, 9, 1, 'Informacja', 'Cześć, chciałem Cię poinformować o tym, że nasza firma zyskała nowego klienta.', '2023-03-02 14:30:00'),
(156, 10, 2, 'Dziękuję', 'Dzięki za miłe spotkanie, było mi bardzo miło.', '2023-03-01 17:45:00'),
(157, 1, 4, 'Propozycja współpracy', 'Cześć, chcielibyśmy zaproponować Ci współpracę przy naszym nowym projekcie. Co o tym myślisz?', '2023-02-28 21:00:00'),
(158, 2, 5, 'Prośba o spotkanie', 'Cześć, chciałbym umówić się z Tobą na krótkie spotkanie w celu omówienia naszych działań.', '2023-02-27 08:30:00'),
(159, 3, 6, 'Uwagi do projektu', 'Cześć, mam kilka uwag odnośnie projektu, nad którym pracujemy. Mogę się z Tobą tym podzielić?', '2023-02-26 11:45:00'),
(160, 4, 7, 'Rozwiązanie problemu', 'Cześć, udało mi się rozwiązać problem, z którym borykaliśmy się od kilku dni.', '2023-02-25 15:00:00'),
(161, 5, 8, 'Prośba o wsparcie', 'Cześć, potrzebuję Twojego wsparcia przy konfiguracji naszej aplikacji. Czy mógłbyś mi pomóc?', '2023-02-24 18:15:00'),
(162, 6, 9, 'Zaproszenie na konferencję', 'Cześć, chcielibyśmy Cię zaprosić na naszą konferencję, która odbędzie się za dwa tygodnie.', '2023-03-11 23:12:23'),
(163, 6, 7, 'Pytanie o propozycję', 'Cześć, czy już zdecydowałeś co do naszej propozycji współpracy?', '2023-03-02 12:45:00'),
(164, 7, 8, 'Zapytanie o informację', 'Cześć, mam pytanie odnośnie raportu, który mi przesłałeś. Czy mógłbyś mi udzielić kilku informacji na jego temat?', '2023-03-09 16:00:00'),
(165, 8, 9, 'Podziękowanie za wsparcie', 'Dziękuję Ci za pomoc przy wdrożeniu nowego oprogramowania. Bez Twojego wsparcia nie byłoby to możliwe.', '2023-03-16 19:15:00'),
(166, 9, 10, 'Zaproszenie na spotkanie', 'Cześć, chcielibyśmy Cię zaprosić na spotkanie, na którym będziemy omawiać nasze plany na przyszłość.', '2023-03-19 22:30:00'),
(167, 10, 1, 'Prośba o przesłanie danych', 'Cześć, potrzebuję, abyś przesłał mi kilka danych, które mi obiecałeś. Czy mogę na to liczyć?', '2023-03-18 06:00:00'),
(168, 1, 2, 'Odpowiedź na pytanie', 'Cześć, co do Twojego pytania, uważam że nasz plan działań jest odpowiedni i nie wymaga zmian.', '2023-03-17 09:15:00'),
(169, 2, 3, 'Zapytanie o stan projektu', 'Cześć, chciałem się dowiedzieć, jaki jest obecny stan naszego projektu.', '2023-03-16 12:30:00'),
(170, 3, 4, 'Podziękowanie za informację', 'Dzięki za przesłanie mi tych informacji, były dla mnie bardzo pomocne.', '2023-03-15 15:45:00'),
(171, 4, 5, 'Pytanie o możliwość współpracy', 'Cześć, czy Twoja firma jest zainteresowana współpracą przy naszym kolejnym projekcie?', '2023-03-14 19:00:00'),
(172, 5, 6, 'Dziękuję za spotkanie', 'Dzięki za spotkanie, było mi bardzo miło i mam nadzieję na dalszą owocną współpracę.', '2023-03-13 22:15:00'),
(173, 6, 7, 'Zapytanie o dostępność', 'Cześć, chciałbym umówić się z Tobą na spotkanie, ale nie wiem kiedy jesteś dostępny. Czy możesz mi powiedzieć, kiedy Ci pasuje?', '2023-03-12 11:30:00'),
(174, 7, 8, 'Prośba o informację', 'Cześć, czy mogę prosić Cię o przesłanie mi kilku informacji na temat ostatniego projektu, nad którym pracowaliście?', '2023-03-11 14:45:00'),
(175, 8, 9, 'Odpowiedź na maila', 'Cześć, dzięki za maila. Co do Twojego pytania, jestem gotowy do omówienia naszych planów na przyszłość.', '2023-03-10 18:00:00'),
(176, 9, 10, 'Dziękuję za wsparcie', 'Chciałbym Ci podziękować za wsparcie przy projekcie, który kończyliśmy w zeszłym tygodniu. Bez Twojej pomocy nie udałoby nam się zakończyć go na czas.', '2023-03-09 21:15:00'),
(177, 10, 1, 'Zapytanie o termin', 'Cześć, chciałbym się dowiedzieć, kiedy planujesz zakończyć pracę nad swoim projektem, ponieważ potrzebuję wyników do mojego projektu.', '2023-03-08 09:30:00'),
(178, 1, 2, 'Podziękowanie za współpracę', 'Dziękuję za współpracę przy ostatnim projekcie, mam nadzieję na kolejne.', '2023-03-07 12:45:00'),
(179, 2, 3, 'Prośba o spotkanie', 'Cześć, czy mógłbyś się ze mną spotkać, abyśmy omówili pewną sprawę?', '2023-03-06 16:00:00'),
(180, 3, 4, 'Pytanie o raport', 'Cześć, mam pytanie dotyczące raportu, który mi przesłałeś. Czy mógłbyś mi pomóc?', '2023-03-05 19:15:00'),
(181, 4, 5, 'Zaproszenie na spotkanie', 'Cześć, chciałbym Cię zaprosić na spotkanie, na którym będziemy omawiać nasze plany na najbliższe miesiące.', '2023-03-04 22:30:00'),
(182, 5, 6, 'Pytanie o harmonogram', 'Cześć, chciałbym się dowiedzieć, jaki jest obecny harmonogram naszych działań i kiedy możemy spodziewać się wyników.', '2023-03-03 06:00:00'),
(183, 6, 7, 'Podziękowanie za spotkanie', 'Dzięki za spotkanie, było mi bardzo miło i mam nadzieję na dalszą współpracę.', '2023-03-02 09:15:00'),
(184, 7, 8, 'Zapytanie o zdanie', 'Cześć, chciałbym poznać Twoje zdanie na temat ostatniego projektu, nad którym pracowaliśmy. Jakie masz wrażenia?', '2023-03-01 12:30:00'),
(185, 8, 9, 'Potwierdzenie spotkania', 'Cześć, potwierdzam nasze spotkanie na jutro o godzinie 10:00.', '2023-02-28 15:45:00'),
(186, 9, 10, 'Przypomnienie o spotkaniu', 'Cześć, przypominam o naszym spotkaniu jutro o godzinie 11:00.', '2023-02-27 19:00:00'),
(187, 10, 1, 'Zapytanie o dokument', 'Cześć, czy mógłbyś przesłać mi dokument, który mi obiecałeś?', '2023-02-26 22:15:00'),
(188, 1, 2, 'Potwierdzenie otrzymania dokumentu', 'Cześć, dzięki za przesłanie dokumentu, wszystko wygląda dobrze.', '2023-02-25 10:30:00'),
(189, 2, 3, 'Zapytanie o pomoc', 'Cześć, mam pewien problem i potrzebuję Twojej pomocy, czy mogę na Ciebie liczyć?', '2023-02-24 13:45:00'),
(190, 3, 4, 'Podziękowanie za pomoc', 'Dzięki za pomoc w rozwiązaniu mojego problemu, bardzo mi pomogłeś.', '2023-02-23 17:00:00'),
(191, 4, 5, 'Prośba o udostępnienie materiałów', 'Cześć, czy mógłbyś udostępnić mi materiały, które wykorzystałeś w swoim projekcie?', '2023-02-22 20:15:00'),
(192, 5, 6, 'Potwierdzenie odbioru materiałów', 'Cześć, dzięki za przesłanie materiałów, wszystko wygląda dobrze.', '2023-02-21 23:30:00'),
(193, 6, 7, 'Dziękuję za spotkanie', 'Dzięki za spotkanie, mam nadzieję, że nasza współpraca przyniesie dobre efekty.', '2023-02-20 06:45:00');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
