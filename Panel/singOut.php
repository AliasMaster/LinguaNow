<?php

require_once('../classes/Message.php');

session_start();

$_SESSION['loginMessage'] = new Message(false, "Wylogowano pomyślnie");

header('Location: ../Logowanie/');