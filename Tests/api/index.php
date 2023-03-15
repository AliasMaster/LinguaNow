<?php

declare(strict_types=1);

require_once('./src/Database.php');
require_once('./src/ErrorHandler.php');

require_once('./src/login.php');
require_once('./src/nav.php');
require_once('./src/users.php');
require_once('./src/messages.php');

require_once('./src/Controller.php');
require_once('./src/Token.php');

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");

header("Content-type: application/json; charset=UTF-8");

$parts = explode('/', $_SERVER['REQUEST_URI']);

$path = $parts[3] ?? null;
$id = $parts[4] ?? null;

$database = new Database;

new Controller($database, $_SERVER['REQUEST_METHOD'], $path, $id);
