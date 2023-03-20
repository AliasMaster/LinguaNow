<?php

class Messages
{
    private PDO $conn;

    public function __construct(Database $database, $method)
    {
        // Token -> Bearer :token:userId
        $tokenClass = new Token;
        $token = $tokenClass->get_bearer_token();

        $this->conn = $database->getConnection();

        if ($token->userId) {
            $this->handleAllRequest($method, $token->userId);
        } else {
        }
    }

    public function handleAllRequest($method, $userId)
    {
        switch ($method) {
            case 'GET':
                $this->getAll($userId);
                break;
            case "POST":
                $data = json_decode(file_get_contents("php://input"));
                if (
                    !isset($data->subject)
                    || !isset($data->message)
                    || !isset($data->recipient)
                    || empty($data->subject)
                    || empty($data->message)
                    || empty($data->recipient)
                ) {
                    http_response_code(401);
                    echo json_encode([
                        'message' => 'invalid inputs'
                    ]);
                    exit;
                } else {
                    $this->post($userId, $data->recipient, $data->subject, $data->message);
                }
                break;
            default:
                http_response_code(405);
                header('Allow: GET, POST');
                exit;
                break;
                break;
        }
    }

    public function getAll($userId)
    {
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

        $sendedSql = "SELECT messages.id, subject, message, CONCAT(fname, ' ', lname) as name, accessLevel, date FROM messages INNER JOIN users ON messages.toId = users.id WHERE fromId = :id ORDER BY date DESC";

        $stmt = $this->conn->prepare($sendedSql);
        $stmt->bindValue(":id", $userId, PDO::PARAM_INT);

        $stmt->execute();


        $sendedMessages = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($sendedMessages, [
                "to" => $row['name'],
                "role" => getRole($row['accessLevel']),
                "subject" => $row['subject'],
                "message" => $row['message'],
                "date" => $row['date']
            ]);
        }

        $givenSql = "SELECT messages.id, subject, message, CONCAT(fname, ' ', lname) as name, accessLevel, date FROM messages INNER JOIN users ON messages.fromId = users.id WHERE toId = :id ORDER BY date DESC";

        $stmt = $this->conn->prepare($givenSql);
        $stmt->bindValue(":id", $userId, PDO::PARAM_INT);

        $stmt->execute();


        $givenMessages = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($givenMessages, [
                "from" => $row['name'],
                "role" => getRole($row['accessLevel']),
                "subject" => $row['subject'],
                "message" => $row['message'],
                "date" => $row['date']
            ]);
        }

        echo json_encode([
            "given" => $givenMessages,
            "sended" => $sendedMessages
        ]);
    }

    public function post($senderId, $recipientId, $subject, $message)
    {
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO messages VALUES(NULL, :fromId, :toId, :subject, :message, :date);";

        $stmt = $this->conn->prepare($sql);


        $stmt->bindValue(':fromId', $senderId, PDO::PARAM_INT);
        $stmt->bindValue(':toId', $recipientId, PDO::PARAM_INT);
        $stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
        $stmt->bindValue(':message', $message, PDO::PARAM_STR);
        $stmt->bindValue(':date', $date, PDO::PARAM_STR);

        $stmt->execute();

        $lastId = $this->conn->lastInsertId();

        $selectSql = "SELECT users.accessLevel, CONCAT(users.fname, ' ', users.lname) as name FROM users INNER JOIN messages ON toId = users.id WHERE messages.id = $lastId";
        $result = $this->conn->query($selectSql);
        $row = $result->fetch(PDO::FETCH_ASSOC);

        function getRoleFromSelect($accessLevel)
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

        echo json_encode([
            "message" => "Wysłano pomyślnie",
            "data" => [
                "date" => $date,
                "to" => $row['name'],
                "subject" => $subject,
                "message" => $message,
                "role" => getRoleFromSelect($row['accessLevel'])
            ]
        ]);
    }
}
