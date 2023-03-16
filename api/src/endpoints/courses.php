<?php

class Courses
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
        $sql = "SELECT * FROM courses";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $courses = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($courses, [
                "id" => $row['id'],
                "name" => $row['name'],
                "description" => $row['description'],
                "type" => $row['type'],
                "price" => $row['price']
            ]);
        }

        echo json_encode(["courses" => $courses]);
    }
}
