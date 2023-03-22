<?php

use function PHPSTORM_META\type;

class Marks
{
    private PDO $conn;

    public function __construct(Database $database, string $method, $id)
    {
        $this->conn = $database->getConnection();

        $tokenClass = new Token();
        $token = $tokenClass->get_bearer_token();

        switch ($method) {
            case 'GET':
                if ($token->token == 2) {
                    $this->getStudentsMarks($token->userId);
                } else if ($token->token == 3) {
                    $this->getUserMarks($id);
                } else {
                    http_response_code(401);
                    echo json_encode([
                        'message' => 'access denied'
                    ]);
                    exit;
                }
                break;
            case "PUT":
                if ($token->token == 2) {
                    $data = (object)json_decode(file_get_contents('php://input'), true);
                    if (isset($data->mark) && isset($data->description) && !empty(trim($data->mark)) && !empty(trim($data->description))) {
                        $this->put($id, $token->userId, $data);
                    } else {
                        http_response_code(401);
                        echo json_encode([
                            'message' => "Nie poprawne dane"
                        ]);
                        exit;
                    }
                } else {
                    http_response_code(401);
                    echo json_encode([
                        'message' => 'access denied'
                    ]);
                    exit;
                }
                break;
            default:
                header("Allow: GET, PUT");
                http_response_code(403);
                break;
        }
    }

    public function getUserMarks($id)
    {

        $findSql = "SELECT * FROM users WHERE id=:id";
        $findStmt = $this->conn->prepare($findSql);
        $findStmt->bindValue(":id", $id, PDO::PARAM_INT);
        $findStmt->execute();

        if ($findStmt->rowCount() != 1) {
            http_response_code(404);
            echo json_encode(["message" => "user not found"]);
            exit;
        }

        $sql = "SELECT * FROM marks WHERE studentId = :id ORDER BY date ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $marks = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($marks, [
                "mark" => $row['mark'],
                "description" => $row['description'],
                "date" => $row['date']
            ]);
        }

        echo json_encode([
            "marks" => $marks,
            "id" => $id
        ]);
    }

    public function getStudentsMarks($teacherId)
    {
        $selectStudents = "SELECT users.id, CONCAT(users.fname, ' ', users.lname) as name FROM users INNER JOIN students ON users.id = students.userId INNER JOIN groups ON groups.id = students.groupId INNER JOIN teachers ON teachers.groupId = groups.id WHERE teachers.userId = :id ORDER BY id ASC;";

        $stmt = $this->conn->prepare($selectStudents);
        $stmt->bindValue(":id", $teacherId, PDO::PARAM_INT);
        $stmt->execute();

        $selectStudentMarks = "SELECT * FROM marks WHERE studentId = :id ORDER BY date ASC";
        $stmtMarks = $this->conn->prepare($selectStudentMarks);

        $users = [];
        while ($studnets = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stmtMarks->bindValue(':id', $studnets['id'], PDO::PARAM_INT);
            $stmtMarks->execute();

            $marks = [];
            while ($mark = $stmtMarks->fetch(PDO::FETCH_ASSOC)) {
                array_push($marks, [
                    "mark" => $mark['mark'],
                    "description" => $mark['description'],
                    "date" => $mark['date']
                ]);
            }

            array_push($users, [
                "id" => $studnets['id'],
                "name" => $studnets['name'],
                "marks" => $marks
            ]);
        }

        echo json_encode([
            "users" => $users
        ]);
    }

    public function put($id, $teacherId, $data)
    {
        $sql = "SELECT groups.id FROM students INNER JOIN groups ON groups.id = students.groupId INNER JOIN teachers ON teachers.groupId = groups.id WHERE teachers.userId = :teacherId AND students.userId = :studentId;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":teacherId", $teacherId, PDO::PARAM_INT);
        $stmt->bindValue(":studentId", $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            http_response_code(401);
            echo json_encode([
                'message' => 'Nie znaleziono takiego ucznia'
            ]);
            exit;
        }

        $date = date('Y-m-d');

        $insertSql = "INSERT INTO marks VALUES(NULL, :mark, :studentId, :description, :date)";
        $stmt = $this->conn->prepare($insertSql);
        $stmt->bindValue(":mark", $data->mark, PDO::PARAM_INT);
        $stmt->bindValue(":studentId", $id, PDO::PARAM_INT);
        $stmt->bindValue(":description", $data->description, PDO::PARAM_STR);
        $stmt->bindValue(":date", $date, PDO::PARAM_STR);

        $stmt->execute();

        echo json_encode([
            "message" => "Dodano pomyślnie",
            "id" => $id,
            "mark" => $data->mark,
            "description" => $data->description,
            "date" => $date
        ]);
    }
}
