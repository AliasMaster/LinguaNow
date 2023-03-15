<?php
// import database
require_once('db/connection.php');
// import Message class
require_once('./classes/Message.php');
// import Course class
require_once('./classes/Course.php');

$database = new Database('linguanow');
$conn = $database->connection();

// check if connection is correct
if (!$conn) {
    header("Location: error.html");
}

// queries
$selectStationeryCourses = "SELECT id, name FROM courses WHERE type='Stacjonarny'";
$selectOnlineCourses = "SELECT id, name FROM courses WHERE type='Online'";

// get stationery courses

$stationeryCourses = [];

$result = $conn->query($selectStationeryCourses);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $course = new Course($row['id'], $row['name']);
    array_push($stationeryCourses, $course);
}

// get online courses

$onlineCourses = [];

$result = $conn->query($selectOnlineCourses);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $course = new Course($row['id'], $row['name']);
    array_push($onlineCourses, $course);
}

// close connection
$conn = '';

// getting curent directory
$directories = explode('\\', getcwd());
$directory = end($directories);

// set up pop out messeges if user signed in

// start session
session_start();

// Check if variable $_SESSION['message'] exist
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

// end session
session_unset();
session_destroy();

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinguaNow</title>
    <meta name="author" content="Piotr Maj">
    <meta name="description" content="Szkoła językowa LinguaNow. Zapisz się już dzisiaj">
    <meta name="keywords" content="Język angielski, kursy językowe, szkoła językowa, Prywatna szkoła języka angielskiego, LinguaNow, Prywatna szkoła, Lingua">

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/logo/LinguaNow.ico" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins&display=swap" rel="stylesheet">

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/f94516e036.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <!-- Nav -->
    <header>
        <!-- logo -->
        <a href="./" class="logo">
            <span class="main-color">Lingua</span><span class="second-color">Now</span>
        </a>
        <nav class="wide-nav">
            <ul>
                <!-- Nav items -->
                <li><a href="./">Strona Główna</a></li>
                <li><a href="./Kursy/">Kursy</a></li>
                <li><a href="./Instruktorzy/">Instruktorzy</a></li>
                <li><a href="./O-nas/">O nas</a></li>
                <li><a href="./Kontakt/">Kontakt</a></li>
                <li><a href="./Logowanie/">Logowanie</a></li>
            </ul>
        </nav>
        <nav class="short-nav">
            <div class="hamburger">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
            <ul>
                <!-- Nav items -->
                <li><a href="./">Strona Główna</a></li>
                <li><a href="./Kursy/">Kursy</a></li>
                <li><a href="./Instruktorzy/">Instruktorzy</a></li>
                <li><a href="./O-nas/">O nas</a></li>
                <li><a href="./Kontakt/">Kontakt</a></li>
                <li><a href="./Logowanie/">Logowanie</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main content -->
    <main>
        <!-- Welcome page -->
        <section class="main-background">
            <article class="welcome">
                <div class="welcome-text">
                    <h1>Prywatna szkoła języka angielskiego</h1>
                    <span class="logo">
                        <span class="main-color">Lingua</span><span class="second-color">Now</span>
                    </span>
                </div>
            </article>
            <a class="a-button directToCourses">Zobacz nasze kursy</a>
        </section>

        <!-- Improve your english section -->
        <section class="improve-your-english">
            <h2>Improve your English by listening music</h2>
            <blockquote>“The world’s most famous and popular language is music.” – Psy</blockquote>
            <article class="spotify-frame">
                <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/5htTj8I5Yye89EQ1hj5Rvg?utm_source=generator&theme=0" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
            </article>
        </section>

        <!-- Feutures section -->
        <section class="feature-block">
            <h2>Co nas wyróznia?</h2>
            <article class="features">
                <div class="feature">
                    <img src="assets/img/sowa.png" alt="Ikona znaku jakości">
                    <p>Szkoła za znakiem jakości TGLS Quality Alliance</p>
                </div>
                <div class="feature">
                    <img src="assets/img/optymalizacja.png" alt="Ikona znaku jakości">
                    <p>Przełamanie bariery komunikacyjnej</p>
                </div>
                <div class="feature">
                    <img src="assets/img/skuteczne.png" alt="Ikona skuteczność">
                    <p>Szybkość i skuteczność</p>
                </div>
                <div class="feature">
                    <img src="assets/img/elastycznosc.png" alt="Ikona kursów">
                    <p>Elastyczne podejście i organizacja kursów</p>
                </div>
            </article>
        </section>

        <!-- Courses section -->
        <section id="kursy">
            <h2>Nasze kursy</h2>
            <article class="courses-box">
                <div class="courses stationery">
                    <img src="./assets/img/stationery.jpg" alt="Kurs stacjonarny">
                    <div class="course-text">
                        <h3>Kursy stacionarne</h3>
                        <p>Idealne dla osób, które chcą uczyć się angielskiego w grupie i z nauczycielem na żywo. Zajęcia odbywają się w dogodnych dla uczestników godzinach. Nauczyciele indywidualnie dopasowują program zajęć do poziomu zaawansowania grupy.</p>
                        <ul class="course-offer">
                            <?php
                            foreach ($stationeryCourses as $course) {
                                echo "<li><span>$course->name</span></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="courses online">
                    <img src="./assets/img/online.jpg" alt="Kurs online">
                    <div class="course-text">
                        <h3>Kursy online</h3>
                        <p>Idealne dla osób, które chcą uczyć się angielskiego w dowolnym miejscu i czasie. Zajęcia odbywają się na platformie e-learningowej, która umożliwia uczestnikom dostęp do materiałów, zadań i testów. Nauczyciele indywidualnie dopasowują program zajęć do poziomu zaawansowania uczestnika.</p>
                        <ul class="course-offer">
                            <?php
                            foreach ($onlineCourses as $course) {
                                echo "<li><span>$course->name</span></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>

            </article>
            <a class="a-button" href="./Kursy/">Zobacz pełną oferte</a>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <section class="logo">
            <span class="main-color">Lingua</span><span class="second-color">Now</span>
        </section>
        <section class="footer-sections">
            <!-- Site map -->
            <article class="site-map">
                <h3>Mapa strony</h3>
                <ul>
                    <!-- Nav items -->
                    <li><a href="./">Strona Główna</a></li>
                    <li><a href="./Kursy/">Kursy</a></li>
                    <li><a href="./Instruktorzy/">Instruktorzy</a></li>
                    <li><a href="./O-nas/">O nas</a></li>
                    <li><a href="./Kontakt/">Kontakt</a></li>
                    <li><a href="./Logowanie/">Logowanie</a></li>
                </ul>
            </article>

            <!-- Contact -->
            <article class="contact">
                <h3>Kontakt</h3>
                <div class="contact-datas">
                    <div class="contact-data">
                        <i class="fa-solid fa-phone icons"></i>
                        <span><a href="tel:+48 555 555 555">555 555 555</a></span>
                    </div>
                    <div class="contact-data">
                        <i class="fa-solid fa-envelope icons"></i>
                        <span><a href="mailto:aaa@aaa.aa">aaa@aaa.aa</a></span>
                    </div>
                    <div class="contact-data">
                        <i class="fa-sharp fa-solid fa-location-dot icons"></i>
                        <span>Jagiellońska 13, 41-200 Sosnowiec</span>
                    </div>
                </div>
            </article>

            <!-- sign in form -->
            <article class="sign-in">
                <h3>Zapisz się</h3>
                <form action="signIn.php" method="post" id="signInForm">
                    <input type="text" name="fname" class="name" placeholder="Imię" required>
                    <input type="text" name="lname" class="name" placeholder="Nazwisko" required>
                    <input type="email" name="email" placeholder="E-mail" required>
                    <input type="tel" name="tel" placeholder="Numer telefonu" required>
                    <select name="level" required>
                        <option value="default" selected disabled>Wybierz kurs</option>
                        <optgroup label="Stacjonarne">
                            <?php
                            foreach ($stationeryCourses as $course) {
                                echo "<option value=\"course-$course->id\">$course->name</option>";
                            }
                            ?>
                        </optgroup>
                        <optgroup label="Online">
                            <?php
                            foreach ($onlineCourses as $course) {
                                echo "<option value=\"course-$course->id\">$course->name</option>";
                            }
                            ?>
                        </optgroup>
                    </select>
                    <input type="hidden" name="directory" value="<?php echo $directory ?>">
                    <input type="submit" value="Zapisz się">
                    <?php
                    if (isset($message)) {
                        // print message
                        echo $message->printMessage();
                    }
                    ?>
                </form>
            </article>
        </section>
        <section class="footer-info">
            <p>Zapisz się a skontatujemy się z Tobą, w celu umówienia pierwszej wizyty</p>
            <p>&copy LinguaNow, 2023</p>
        </section>
    </footer>

    <!-- JS -->
    <script src="./js/hamburgerActive.js"></script>
    <script src="./js/directToCourses.js"></script>
</body>

</html>