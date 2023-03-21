<?php

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
                    $data = json_decode(file_get_contents("php://input"));
                    if (isset($data->mark) && isset($data->description) && !empty(trim($data->mark)) && !empty(trim($data->description))) {
                        $this->put($id, $token->userId, $data);
                    } else {
                        http_response_code(401);
                        echo json_encode([
                            'message' => 'Nie poprawne dane'
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

        $sql = "SELECT * FROM marks WHERE studentId = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $marks = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($marks, [
                "mark" => $row['mark'],
                "description" => $row['description']
            ]);
        }

        echo json_encode([
            "marks" => $marks,
            "id" => $id
        ]);
    }

    public function getStudentsMarks($teacherId)
    {
        $sql = "SELECT users.id, CONCAT(users.fname, ' ', users.lname) as name, marks.mark, marks.description FROM marks INNER JOIN students ON marks.studentId = students.userId INNER JOIN groups ON students.groupId = groups.id INNER JOIN teachers ON teachers.groupId = groups.id INNER JOIN users ON users.id = marks.studentId WHERE teachers.userId = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $teacherId, PDO::PARAM_INT);
        $stmt->execute();

        $marks = [];

        $buffer = (object)[
            "id" => 0,
            "name" => ''
        ];

        $i = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            if ($buffer->id == 0) {
                $buffer = (object) [
                    "id" => $row['id'],
                    "name" => $row['name']
                ];
            }

            if ($buffer->id != $row['id']) {
                $i++;
            }

            $marks[$i] = [
                "id" => $row['id'],
                "name" => $row['name'],
                "marks" => []
            ];

            array_push($marks[$i]['marks'], [
                "mark" => $row['mark'],
                "description" => $row['description']
            ]);
        }

        echo json_encode([
            "users" => $marks
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
                'message' => 'access denied'
            ]);
            exit;
        }

        $insertSql = "INSERT INTO marks VALUES(NULL, :mark, :studentId, :description)";
        $stmt = $this->conn->prepare($insertSql);
        $stmt->bindValue(":mark", $data->mark, PDO::PARAM_INT);
        $stmt->bindValue(":studentId", $id, PDO::PARAM_INT);
        $stmt->bindValue(":description", $data->description, PDO::PARAM_STR);

        $stmt->execute();

        echo json_encode([
            "message" => "Dodano pomyślnie",
            "id" => $id,
            "mark" => $data->mark,
            "description" => $data->description
        ]);
    }
}
