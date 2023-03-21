<?php

class Controller
{
    public function __construct(Database $database, String $method, string $path, $id)
    {
        switch ($path) {
            case 'login':
                new Login($database, $method);
                break;
            case "nav":
                new Nav($method);
                break;
            case "messages":
                new Messages($database, $method);
                break;
            case "users":
                new Users($database, $method, $id);
                break;
            case "teachers":
                new Teachers($database, $method);
                break;
            case "students":
                new Students($database, $method);
                break;
            case "courses":
                new Courses($database, $method);
                break;
            case "signIn":
                new signIn($database, $method);
                break;
            case "admissions":
                new Admissions($database, $method, $id);
                break;
            case "groups":
                new Groups($database, $method, $id);
                break;
            case 'marks':
                new Marks($database, $method, $id);
                break;
            default:
                http_response_code(404);
                echo json_encode([
                    "message" => "path not found",
                ]);
                break;
        }
    }
}
