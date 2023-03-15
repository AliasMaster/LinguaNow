<?php

// import Message class
require_once('./classes/Message.php');

// removing all white spaces in $_POST
$posts = array_map(function ($post) {
    return trim($post);
}, $_POST);


// start session
session_start();

function isAllPostSetCorrectly(): bool
{
    global $posts;

    $postsArray = ["fname", "lname", "email", "tel", "level", "directory"];
    $patterns = [
        "phone" => "/^(?:(?:(?:\+|00)?48)|(?:\(\+?48\)))?[ -]*(\d[ -]*){9}$/",
        "email" => "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
        "names" => "/^[a-zA-Z\s]{3,}$/",
        "level" => "/^course-\d+$/"
    ];

    // check if 
    foreach ($postsArray as $post) {
        if (!in_array($post, array_keys($posts))) {
            $_SESSION['message'] = new Message(true, "Nie wypełniono wszystkich pól");
            return false;
        }
    }

    // check if phone numer is polish correct numer
    if (!preg_match($patterns['phone'], $posts['tel'])) {
        $_SESSION['message'] = new Message(true, "Niepoprawny numer telefonu");
        return false;
    }

    // check if email is correct
    if (!preg_match($patterns['email'], $posts['email'])) {
        $_SESSION['message'] = new Message(true, "Niepoprawny adres E-mail");
        return false;
    }

    // check if first name or last name are correct
    if (!(preg_match($patterns['names'], $posts['fname']) && preg_match($patterns['names'], $posts['lname']))) {
        $_SESSION['message'] = new Message(true, "Niepoprawne imię lub nazwisko");
        return false;
    }

    // check if level is correct
    if (!preg_match($patterns['level'], $posts['level'])) {
        $_SESSION['message'] = new Message(true, "Niewybrano poziomu");
        return false;
    }

    // if all is correct return true
    return true;
}

// if all $_POST are correct send it to database
if (isAllPostSetCorrectly()) {
    global $posts;

    // import database
    require_once('db/connection.php');

    $database = new Database('linguanow');
    $conn = $database->connection();

    // check if connection is not correct
    if (!$conn) {
        header('Location: error.html');
    }

    // set variables
    $fname = htmlspecialchars($posts['fname']);
    $lname = htmlspecialchars($posts['lname']);
    $email = htmlspecialchars($posts['email']);
    $phone = htmlspecialchars($posts['tel']);
    $level = htmlspecialchars($posts['level']);

    // convert to course id
    $courseId = substr($level, strpos($level, '-') + 1);
    // set currect date and time

    $date = date('Y-m-d H:i:s');

    $insertQuery = "
        INSERT INTO admissions
        VALUES(
            NULL,
            '$fname',
            '$lname',
            '$email',
            '$phone',
            $courseId,
            '$date',
            'Undone'
        );
    ";

    // insert values to database
    $insertResult = $conn->query($insertQuery);

    // check if query is done
    if ($insertResult) {
        $_SESSION['message'] = new Message(false, "Wysłano pomyślnie");
    } else {
        $_SESSION['message'] = new Message(true, "Błąd wysłania");
    }
}

// Returning to page

// Directories we have
$directories = ['Kursy', 'O-nas', 'Logowanie', 'Instruktorzy'];

// set variable directory to return to page where we were
$directory = in_array($_POST['directory'], $directories) ? $_POST['directory'] . '/' : '';

header("Location: ./$directory#signInForm");
