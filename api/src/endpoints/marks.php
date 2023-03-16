<?php 

class Marks {
    private PDO $conn;

    public function __construct(Database $database, string $method, $id) {
        $this->conn = $database->getConnection();

        $tokenClass = new Token();
        $token = $tokenClass->get_bearer_token();

        switch ($token->userId) {
            case '3': // users
                $this->getUserMarks($userId);
                break;
            case '2': // teacher
                if(!$id) {
                    http_response_code(401);
                    json_encode(["message" => "access denied"]);
                    exit;
                }

                $this->getGroupMarks($id);
                break;
            default:
                http_response_code(401);
                json_encode(["message" => "access denied"]);
                exit;
                break;
        }
    }

    public function getUserMarks($userId)
    {
        // $sql = "SELECT * FROM marks WHERE";
    }
}