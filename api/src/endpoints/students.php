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
        $sql = "SELECT CONCAT(fname, ' ', lname) as name, users.id, email, city, address, phone, students.groupId FROM users INNER JOIN students ON students.userId = users.id";

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
