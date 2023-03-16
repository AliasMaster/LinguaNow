<?php

class Token
{
    private function get_authorization_header()
    {
        $headers = null;

        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } else if (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }

        return $headers;
    }

    public function get_bearer_token(): object | null
    {
        $headers = $this->get_authorization_header();

        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {

                $code = explode('.', $matches[1]);

                if (!(count($code) == 2)) {
                    http_response_code(401);
                    echo json_encode([
                        'message' => 'invalid token'
                    ]);
                    exit;
                }

                $userId = $code[1];
                $token = $code[0];

                if (!in_array($token, [1, 2, 3]) || empty($userId) || !$userId) {
                    http_response_code(401);
                    echo json_encode([
                        "message" => "invalid token",
                    ]);
                    exit;
                }


                $data = [
                    "token" => $token,
                    "userId" => $userId,
                ];

                return (object) $data;
            } else {
                http_response_code(401);
                echo json_encode([
                    'message' => 'access denied'
                ]);
                exit;
            }
        }

        return null;
    }
}
