<?php
// import database
require_once('../db/connection.php');
// import Message class
require_once('../classes/Message.php');
// import Course class
require_once('../classes/Course.php');

$database = new Database('linguanow');
$conn = $database->connection();

// check if connection is correct
if (!$conn) {
    header("Location: ../error.html");
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
    <title>O nas</title>
    <meta name="author" content="Piotr Maj">
    <meta name="description" content="Szkoła językowa LinguaNow. Zapisz się już dzisiaj">
    <meta name="keywords" content="Język angielski, kursy językowe, szkoła językowa, Prywatna szkoła języka angielskiego, LinguaNow, Prywatna szkoła, Lingua">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/logo/LinguaNow.ico" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins&display=swap" rel="stylesheet">

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/f94516e036.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <!-- Nav -->
    <header>
        <!-- logo -->
        <a href="../" class="logo">
            <span class="main-color">Lingua</span><span class="second-color">Now</span>
        </a>
        <nav>
            <ul class="wide-nav">
                <!-- Nav items -->
                <li><a href="../">Strona Główna</a></li>
                <li><a href="../Kursy/">Kursy</a></li>
                <li><a href="../Instruktorzy/">Instruktorzy</a></li>
                <li><a href="../O-nas/">O nas</a></li>
                <li><a href="../Kontakt/">Kontakt</a></li>
                <li><a href="../Logowanie/">Logowanie</a></li>
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
                <li><a href="../">Strona Główna</a></li>
                <li><a href="../Kursy/">Kursy</a></li>
                <li><a href="../Instruktorzy/">Instruktorzy</a></li>
                <li><a href="../O-nas/">O nas</a></li>
                <li><a href="../Kontakt/">Kontakt</a></li>
                <li><a href="../Logowanie/">Logowanie</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- About Us section -->
        <section id="kursy">
            <article class="subpage subpageTeachers subpageAboutUs">
                <h2>O nas</h2>
                <section class="aboutUsText">
                    <p>LinguaNow to prywatna szkoła nauki języka angielskiego, która oferuje wysokiej jakości kursy dla osób w każdym wieku i na każdym poziomie zaawansowania. Nasza szkoła powstała z myślą o uczniach, którzy chcą nauczyć się angielskiego w sposób efektywny i przyjemny.</p>

                    <p>Nasi instruktorzy to najlepsi specjaliści z dziedziny nauczania języka angielskiego. Jan Kowalski, Anna Nowak i Piotr Wiśniewski posiadają bogate doświadczenie w nauczaniu angielskiego zarówno w kraju, jak i za granicą. Każdy z nich ma swoje indywidualne podejście do nauczania, co pozwala na skuteczne przekazywanie wiedzy i umiejętności.</p>

                    <p>W LinguaNow oferujemy nie tylko kursy języka angielskiego, ale także szereg dodatkowych zajęć, które pomagają naszym uczniom rozwijać się w innych obszarach, takich jak kultura anglojęzyczna, biznes, czy nawet nauka w zakresie komunikacji interpersonalnej.</p>

                    <p>Jesteśmy dumni z faktu, że nasi uczniowie osiągają wspaniałe wyniki w nauce języka angielskiego, a nasi instruktorzy są zawsze gotowi do pomocy i udzielania wsparcia w trudniejszych kwestiach. Dołącz do nas i pozwól, aby LinguaNow pomógł Ci osiągnąć Twoje cele związane z nauką języka angielskiego!</p>
                </section>
            </article>
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
                    <li><a href="../">Strona Główna</a></li>
                    <li><a href="../Kursy/">Kursy</a></li>
                    <li><a href="../Instruktorzy/">Instruktorzy</a></li>
                    <li><a href="../O-nas/">O nas</a></li>
                    <li><a href="../Kontakt/">Kontakt</a></li>
                    <li><a href="../Logowanie/">Logowanie</a></li>
                </ul>
            </article>

            <!-- Contact -->
            <article>
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
                <form action="../signIn.php" method="post">
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
                    // Showing pop out message
                    if (isset($message)) {
                        $message->printMessage();
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
    <script src="../js/hamburgerActive.js"></script>
</body>

</html>