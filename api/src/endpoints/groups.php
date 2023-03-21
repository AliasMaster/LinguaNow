<?php

class Groups
{
    private PDO $conn;

    public function __construct(Database $database, string $method, $id)
    {
        $tokenClass = new Token();
        $token = $tokenClass->get_bearer_token();
        $this->conn = $database->getConnection();

        if (isset($token->token) && $token->token == 1)
            switch ($method) {
                case 'GET':
                    $this->getAll();
                    break;

                default:
                    http_response_code(401);
                    echo json_encode([
                        'message' => 'access denied'
                    ]);
                    exit;
                    break;
            }
        else {
            http_response_code(401);
            echo json_encode([
                'message' => 'access denied'
            ]);
            exit;
        }
    }

    public function getAll()
    {
        $getGroups = "SELECT CONCAT(fname, ' ', lname) as teacher, teachers.groupId FROM users INNER JOIN teachers ON teachers.userId = users.id ORDER BY teachers.groupId";

        $groupsStmt = $this->conn->prepare($getGroups);

        $groupsStmt->execute();

        $getStudents = "SELECT CONCAT(fname, ' ', lname) as student FROM users INNER JOIN students ON students.userId = users.id WHERE students.groupId = :group";

        $studentsStmt = $this->conn->prepare($getStudents);

        $groups = [];

        while ($groupRow = $groupsStmt->fetch(PDO::FETCH_ASSOC)) {
            $studentsStmt->bindValue(":group", $groupRow['groupId'], PDO::PARAM_INT);
            $studentsStmt->execute();

            $students = [];

            while ($studentRow = $studentsStmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($students, $studentRow['student']);
            }

            array_push($groups, [
                "group" => $groupRow['groupId'],
                "teacher" => $groupRow['teacher'],
                "students" => $students
            ]);
        }

        echo json_encode($groups);
    }
}
