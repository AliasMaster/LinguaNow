<?php
require_once('./db/connection.php');
require_once('./classes/Message.php');

// start session
session_start();

$posts = array_map(function ($post) {
    return trim($post);
}, $_POST);

function validateData() : bool {
    global $posts;
    
    $postsArray = ['login', 'password'];

    foreach ($postsArray as $post) {
        if (!in_array($post, array_keys($posts))) {
            $_SESSION['loginMessage'] = new Message(true, "Błędny email lub hasło");
            return false;
        }
    }

    return true;
}

if(validateData()) {
    global $posts;

    $database = new Database('linguanow');
    $conn = $database->connection();

    if(!$conn) {
        header('Location: error.html');
    }

    $login = htmlentities($posts['login']);
    $password = htmlentities($posts['password']);

    $checkUser = "SELECT password FROM users WHERE email = '$login'";

    $result = $conn->query($checkUser);

    if($result->num_rows = 1) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if(password_verify($password, $row['password'])) {
            $getUserdata = "SELECT id, fname, lname, email, accessLevel FROM users WHERE email = '$login'";
            $result = $conn->query($getUserdata);
            require_once("./classes/User.php");
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION['user'] = new User($row['id'], $row['fname'], $row['lname'], $row['email'], $row['accessLevel']);
            }
            header("Location: ./Panel/");
        } else {
            $_SESSION['loginMessage'] = new Message(true, "Błędny email lub hasło");
            header("Location: ./Logowanie/");
        }
    } else {
        $_SESSION['loginMessage'] = new Message(true, "Błędny email lub hasło");
        header("Location: ./Logowanie/");
    }
} else {
    header("Location: ./Logowanie/");
}
