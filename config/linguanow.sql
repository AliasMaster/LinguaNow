-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Mar 2023, 23:45
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
-- Struktura tabeli dla tabeli `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `teacher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `groups`
--

INSERT INTO `groups` (`id`, `teacher`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `students`
--

INSERT INTO `students` (`id`, `userId`, `groupId`) VALUES
(1, 4, 1),
(2, 5, 1),
(3, 6, 2),
(4, 7, 2),
(5, 8, 3),
(6, 9, 3);

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
(1, 'jkowalski@example.com', '$2y$10$9a3cskedJroiqzB5Z5ZDtOnk3liVxfP/BGyC02VfPMeJapMx3DB22', 'Jan', 'Kowalski', '111-222-333', 'ul. Główna 1', 'Warszawa', 2),
(2, 'anowak@example.com', '$2y$10$p8LElA/kgwoVCoPmyCR6KOZa0xJHNGwzEZbI6jQzM9JhZuyErk3fK', 'Anna', 'Nowak', '222-111-333', 'ul. Słoneczna 5', 'Kraków', 2),
(3, 'pwisniewski@example.com', '$2y$10$jACnnuK.JtaD7Cs806QAUOxHqAB6HqDrD9pl9kEl.x1AZYT.eGGuC', 'Piotr', 'Wiśniewski', '333-222-111', 'ul. Zielona 10', 'Gdańsk', 2),
(4, 'janek@example.com', '$2y$10$HvZBdyVKH1WrU6czpScO8unpYf97oiyFur/pBwHapwMopIBXGBNOS', 'Jan', 'Kowalski', '234-242-131', 'ul. Nowa 10', 'Warszawa', 3),
(5, 'ania@example.com', '$2y$10$YRmOq0TluyGT99ykk6rvg.0xbyiVnRLv8XQ4J1aQkYKJotVnw2tZu', 'Anna', 'Nowak', '878-424-243', 'ul. Kwiatowa 3', 'Kraków', 3),
(6, 'tomek@example.com', '$2y$10$QGkpwNa5xOTMM2Xyfp/VXOa4m0/waaGM902tYniBKtIlSCBfIJ7FW', 'Tomasz', 'Wójcik', '872-422-423', 'ul. Zielona 7', 'Poznań', 3),
(7, 'kasia@example.com', '$2y$10$a.xRZuKVqo9aybVQzPhTWOQPL2DE.KWF5qfUhvnwdCFxt3U4o0BVW', 'Katarzyna', 'Kowalczyk', '472-894-734', 'ul. Lipowa 2', 'Gdańsk', 3),
(8, 'pawel@example.com', '$2y$10$n.PARMfkesvSDnyj7Hd3GePWX4L/31JyONYNd0LwgVJhe3dXYcskm', 'Paweł', 'Kaczmarek', '876-432-132', 'ul. Czerwona 5', 'Łódź', 3),
(9, 'marta@example.com', '$2y$10$KFl92FeSt8W4LgDlE7bwVeQgLWYluVWOILlwhJyAkdz7xxM/ubiDi', 'Marta', 'Zając', '231-997-122', 'ul. Słoneczna 9', 'Wrocław', 3),
(10, 'mateusz@example.com', '$2y$10$l5p86juqD8l9AHcUvF0O6uGQEnB12Muap8rLH3fnJObqiwpKuoEkC', 'Mateusz', 'Włodarczyk', '123-123-123', 'Jagiellońska 13', 'Sosnowiec', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `accesslevels`
--
ALTER TABLE `accesslevels`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `students`
--
ALTER TABLE `students`
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
-- AUTO_INCREMENT dla tabeli `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT dla tabeli `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
