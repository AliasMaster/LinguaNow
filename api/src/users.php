<?php

class Users
{
    private PDO $conn;

    public function __construct(Database $database, $method, $id)
    {

        $tokenClass = new Token();
        $token = $tokenClass->get_bearer_token();

        $this->conn = $database->getConnection();

        if (!$id) {
            if ($method == "GET") {
                $this->getAll($token->userId);
                exit;
            }
        } else {
            if ($method == "DELETE" && $token->token == 1) {
                $this->deleteUser($id);
            } else {
                http_response_code(401);
                echo json_encode([
                    'message' => 'Access denied'
                ]);
                exit;
            }
        }
    }

    public function getAll($userId)
    {
        $sql = "SELECT CONCAT(fname, ' ', lname) as name, password, email, id, accessLevel FROM users WHERE id <> :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $userId, PDO::PARAM_INT);
        $stmt->execute();

        function getRole($accessLevel)
        {
            $role = null;
            switch ($accessLevel) {
                case '1':
                    $role = 'dyrektor';
                    break;
                case '2':
                    $role = 'nauczyciel';
                    break;
                case '3':
                    $role = "uczeń";
                    break;
                default:
                    http_response_code(500);
                    echo json_encode(["message" => "unhandle query"]);
                    break;
            }

            return $role;
        }

        $user = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($user, [
                "id" => $row['id'],
                "name" => $row['name'],
                "role" => getRole($row['accessLevel']),
                "email" => $row['email'],
                "password" => $row['password'],
                "hashPassword" => password_hash($row['password'], PASSWORD_ARGON2I)
            ]);
        }

        echo json_encode([ "users" => $user ]);
    }

    public function deleteUser($id)
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

        $deleteSql = "DELETE FROM users WHERE id=:id";
        $stmt = $this->conn->prepare($deleteSql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode([
            "message" => "delete user successed",
            "userId" => $id
        ]);
    }
}
