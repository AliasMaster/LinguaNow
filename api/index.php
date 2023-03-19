<?php

declare(strict_types=1);

require_once('./src/Database.php');
require_once('./src/ErrorHandler.php');

require_once('./src/endpoints/login.php');
require_once('./src/endpoints/nav.php');
require_once('./src/endpoints/users.php');
require_once('./src/endpoints/messages.php');
require_once('./src/endpoints/courses.php');
require_once('./src/endpoints/teachers.php');
require_once('./src/endpoints/students.php');
require_once('./src/endpoints/signIn.php');
require_once('./src/endpoints/admisions.php');
require_once('./src/endpoints/groups.php');

require_once('./src/Controller.php');
require_once('./src/Token.php');

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");

header("Content-type: application/json; charset=UTF-8");

$parts = $_SERVER['REQUEST_URI'];

$parts = explode('/', $_SERVER['REQUEST_URI']);

$indexOfApi = array_search('api', $parts);

$path = $parts[$indexOfApi + 1] ?? null;
$id = $parts[$indexOfApi + 2] ?? null;

$database = new Database;

new Controller($database, $_SERVER['REQUEST_METHOD'], $path, $id);
