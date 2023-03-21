<?php

class Teachers
{
    private PDO $conn;

    public function __construct(Database $database, $method)
    {

        $tokenClass = new Token();
        $token = $tokenClass->get_bearer_token();

        $this->conn = $database->getConnection();

        if ($method == "GET") {
            if (isset($token->token) && $token->token == 1) {
                $this->getByToken($token);
            } else {
                $this->getAll();
            }

            exit;
        } else {
            http_response_code(401);
            echo json_encode([
                'message' => 'Access denied'
            ]);
            exit;
        }
    }

    public function getAll()
    {
        // $sql = "SELECT CONCAT(fname, ' ', lname) as name, id, email, city, address, phone FROM users WHERE accessLevel = 2";

        $sql = "SELECT CONCAT(fname, ' ', fname) as name, description, img FROM teachers INNER JOIN users ON users.id = teachers.userId";

        $result = $this->conn->query($sql);

        $user = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            array_push($user, [
                // "id" => $row['id'],
                "name" => $row['name'],
                "description" => $row['description'],
                "img" => $row['img']
                // "email" => $row['email'],
                // "city" => $row['city'],
                // "address" => $row['address'],
                // "phone" => $row['phone']
            ]);
        }

        echo json_encode(["teachers" => $user]);
    }

    public function getByToken()
    {
        $sql = "SELECT CONCAT(fname, ' ', lname) as name, users.id, email, city, address, phone, groupId FROM users INNER JOIN teachers ON teachers.userId = users.id;";

        $result = $this->conn->query($sql);

        $user = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            array_push($user, [
                "id" => $row['id'],
                "name" => $row['name'],
                "email" => $row['email'],
                "city" => $row['city'],
                "address" => $row['address'],
                "phone" => $row['phone'],
                "group" => $row['groupId']
            ]);
        }

        echo json_encode($user);
    }
}
