<?php

class Students
{
    private PDO $conn;

    public function __construct(Database $database, $method)
    {

        $tokenClass = new Token();
        $token = $tokenClass->get_bearer_token()->token;

        $this->conn = $database->getConnection();

        if ($method == "GET" && $token == 1) {
            $this->getAll($token);
            exit;
        }else {
            http_response_code(401);
            echo json_encode([
                'message' => 'Access denied'
            ]);
            exit;
        }
    }

    public function getAll()
    {
        $sql = "SELECT CONCAT(fname, ' ', lname) as name, id, email, city, address, phone FROM users WHERE accessLevel = 3";

        $result = $this->conn->query($sql);

        $user = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            array_push($user, [
                "id" => $row['id'],
                "name" => $row['name'],
                "email" => $row['email'],
                "city" => $row['city'],
                "address" => $row['address'],
                "phone" => $row['phone']
            ]);
        }

        echo json_encode($user);
    }
}
