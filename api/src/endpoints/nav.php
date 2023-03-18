<?php

class Nav
{

    public function __construct($method)
    {
        $tokenClass = new Token;
        $token = $tokenClass->get_bearer_token()->token;

        switch ($method) {
            case 'GET':
                $this->getNavItems($token);
                break;

            default:
                http_response_code(405);
                header('Allow: GET');
                exit;
                break;
        }
    }

    public function getNavItems($token)
    {
        $navListItmes = [
            "home" => ['name' => 'home', "functionName" => "home", "icon" => "home"],
            "students" => ['name' => 'uczniowie', "functionName" => "students", "icon" => "group"],
            "teachers" => ['name' => 'nauczyciele', "functionName" => "teachers", "icon" => "group_work"],
            "admissions" => ['name' => 'zgłoszenia', "functionName" => "admissions", "icon" => "other_admission"],
            "groups" => ['name' => 'grupy', "functionName" => "groups", "icon" => "groups"],
            "messages" => ['name' => 'wiadomości', "functionName" => "messages", "icon" => "chat"],
            "marks" => ['name' => 'oceny', "functionName" => "marks", "icon" => "grade"],
            "logOut" => ['name' => 'wyloguj się', "functionName" => "logOut", "icon" => "logout"]
        ];

        $navUserItems = [];

        switch ($token) {
            case '1':
                $navUserItems = [
                    $navListItmes['home'],
                    $navListItmes['students'],
                    $navListItmes['teachers'],
                    $navListItmes['admissions'],
                    $navListItmes['groups'],
                    $navListItmes['messages'],
                    $navListItmes['logOut'],
                ];
                break;
            case '2':
                $navUserItems = [
                    $navListItmes['home'],
                    $navListItmes['groups'],
                    $navListItmes['messages'],
                    $navListItmes['logOut']
                ];
                break;
            case '3':
                $navUserItems = [
                    $navListItmes['home'],
                    $navListItmes['marks'],
                    $navListItmes['messages'],
                    $navListItmes['logOut']
                ];
                break;
            default:
                http_response_code(401);
                echo json_encode([
                    "message" => "Unable to access"
                ]);
                exit;
                break;
        }

        echo json_encode([
            "items" => $navUserItems
        ]);
    }
}
