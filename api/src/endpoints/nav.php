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
            "students" => ['name' => 'uczniowie', "functionName" => "students"], 
            "teachers" => ['name' => 'nauczyciele', "functionName" => "teachers"],
            "admissions" => ['name' => 'zgłoszenia', "functionName" => "admissions"],
            "groups" => ['name' => 'grupy', "functionName" => "groups"],
            "messages" => ['name' => 'wiadomości', "functionName" => "messages"],
            "marks" => ['name' => 'oceny', "functionName" => "marks"],
            "logOut" => ['name' => 'wyloguj się', "functionName" => "logOut"]
        ];

        $navUserItems = [];

        switch ($token) {
            case '1':
                $navUserItems = [
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
                    $navListItmes['groups'],
                    $navListItmes['messages'],
                    $navListItmes['logOut']
                ];
                break;
            case '3':
                $navUserItems = [
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
