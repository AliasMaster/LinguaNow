<?php
    require_once('../classes/User.php');
    session_start();

    if(isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    } else {
        header('Location: ../');
    }

    if(isset($_GET['site'])) {
        $site = $_GET['site'];
    }

?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
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
    <main>
        <?php
            switch ($user->accessLevel) {
                case 1:
                    require_once('./principal.php');
                    break;
                case 2:
                    require_once('./teacher.php');
                    break;
                case 3:
                    require_once('./student.php');
                    break;
                default:
                    header('Location: ../');
                    break;
            }

            if(isset($site)) {
                switch ($site) {
                    case 'message':
                        # code...
                        break;
                    case 'singOut':
                        header('Location: singOut.php');
                    default:
                        # code...
                        break;
                }
            }
        ?>
    </main>
    <footer>
        <p>&copy LinguaNow, 2023</p>
    </footer>
</body>
</html>