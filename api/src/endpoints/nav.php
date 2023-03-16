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
        $navListItmes = [];
        switch ($token) {
            case '1':
                $navListItmes = ['uczniowie', 'nauczyciele', 'zgłoszenia', 'grupy', 'wiadomości'];
                break;
            case '2':
                $navListItmes = ['grupa', 'oceny', 'wiadomości'];
                break;
            case '3':
                $navListItmes = ['oceny', 'wiadomości'];
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
            "items" => $navListItmes
        ]);
    }
}
