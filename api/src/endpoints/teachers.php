<?php

class Teachers
{
    private PDO $conn;

    public function __construct($database, $method)
    {
        $this->conn = $database->getConnection();

        switch ($method) {
            case 'GET':
                $this->get();
                break;

            default:
                http_response_code(405);
                header("Allow: GET");
                break;
        }
    }

    public function get()
    {
        $sql = "SELECT CONCAT(fname, ' ', lname) as name, description, img FROM teachers INNER JOIN users ON users.id = teachers.userId;";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $teachers = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($teachers, [
                "name" => $row['name'],
                "description" => $row['description'],
                "img" => $row['img']
            ]);
        }

        echo json_encode(["teachers" => $teachers]);
    }
}
