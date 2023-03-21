<?php

class Admissions
{
    private PDO $conn;

    public function __construct(Database $database, $method, $id)
    {

        $tokenClass = new Token();
        $token = $tokenClass->get_bearer_token()->token;

        $this->conn = $database->getConnection();

        if (!$id) {
            if ($method == "GET" && $token == 1) {
                $this->getAll($token);
                exit;
            } else {
                http_response_code(401);
                echo json_encode([
                    'message' => 'Access denied'
                ]);
                exit;
            }
        } else {
            if ($method == "DELETE" && $token == 1) {
                $this->delete($id);
            } else {
                http_response_code(401);
                echo json_encode([
                    'message' => 'Access denied'
                ]);
                exit;
            }
        }
    }

    public function getAll()
    {
        $sql = "SELECT admissions.id, CONCAT(fname, ' ', lname) as name, email, phone, courses.name as course, date FROM `admissions` INNER JOIN courses ON courses.id = admissions.coursesId WHERE status='undone' ORDER BY date DESC";

        $result = $this->conn->query($sql);

        $user = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            array_push($user, [
                "id" => $row['id'],
                "name" => $row['name'],
                "email" => $row['email'],
                "phone" => $row['phone'],
                "course" => $row['course'],
                "date" => $row['date']
            ]);
        }

        echo json_encode($user);
    }

    public function delete($id)
    {
        $findSql = "SELECT * FROM admissions WHERE id=:id";
        $findStmt = $this->conn->prepare($findSql);
        $findStmt->bindValue(":id", $id, PDO::PARAM_INT);
        $findStmt->execute();

        if ($findStmt->rowCount() != 1) {
            http_response_code(404);
            echo json_encode(["message" => "user not found"]);
            exit;
        }

        $deleteSql = "DELETE FROM admissions WHERE id=:id";
        $stmt = $this->conn->prepare($deleteSql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode([
            "message" => "Usunięto pomyślnie",
            "userId" => $id
        ]);
    }
}
