<?php

class SignIn
{
    private PDO $conn;

    public function __construct($database, $method)
    {
        $this->conn = $database->getConnection();

        switch ($method) {
            case 'POST':
                $data = json_decode(file_get_contents("php://input"));
                $this->checkForm($data);
                break;

            default:
                http_response_code(405);
                header("Allow: GET");
                break;
        }
    }

    public function checkForm($data)
    {

        if (
            !isset($data->fname)
            || !isset($data->lname)
            || !isset($data->email)
            || !isset($data->tel)
            || !isset($data->level)
            || empty(trim($data->fname))
            || empty(trim($data->lname))
            || empty(trim($data->email))
            || empty(trim($data->tel))
            || empty(trim($data->level))
        ) {
            http_response_code(403);
            echo json_encode(["message" => "Nie wypełniono wszystkich pól"]);
            exit;
        }

        $patterns = [
            "phone" => "/^(?:(?:(?:\+|00)?48)|(?:\(\+?48\)))?[ -]*(\d[ -]*){9}$/",
            "email" => "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
            "names" => "/^[a-zA-Z\s]{3,}$/",
            "level" => "/^course-\d+$/"
        ];

        // check if phone numer is polish correct numer
        if (!preg_match($patterns['phone'], $data->tel)) {
            http_response_code(403);
            echo json_encode(["message" => "Niepoprawny numer telefonu"]);
            exit;
        }

        // check if email is correct
        if (!preg_match($patterns['email'], $data->email)) {
            http_response_code(403);
            echo json_encode(["message" => "Niepoprawny adres E-mail"]);
            exit;
        }

        if (!(preg_match($patterns['names'], $data->fname) && preg_match($patterns['names'], $data->lname))) {
            http_response_code(403);
            echo json_encode(["message" => "Niepoprawne imię lub nazwisko"]);
            exit;
        }

        // check if level is correct
        if (!preg_match($patterns['level'], $data->level)) {
            http_response_code(403);
            echo json_encode(["message" => "Niewybrano poziomu"]);
            exit;
        }

        // If all pass

        $fname = htmlspecialchars($data->fname);
        $lname = htmlspecialchars($data->lname);
        $email = htmlspecialchars($data->email);
        $phone = htmlspecialchars($data->tel);
        $level = htmlspecialchars($data->level);

        $courseId = substr($level, strpos($level, '-') + 1);
        $date = date('Y-m-d H:i:s');

        $insertQuery = "INSERT INTO `admissions`(`fname`, `lname`, `email`, `phone`, `coursesId`, `date`) VALUES (:fname,:lname,:email,:phone,:coursesId,:date)";

        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindValue(":fname", $fname, PDO::PARAM_STR);
        $stmt->bindValue(":lname", $lname, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":phone", $phone, PDO::PARAM_STR);
        $stmt->bindValue(":coursesId", $courseId, PDO::PARAM_STR);
        $stmt->bindValue(':date', $date, PDO::PARAM_STR);

        if ($stmt->execute()) {
            http_response_code(201);
            echo json_encode(['message' => "Wysłano pomyślnie"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Błąd wysłania formularza"]);
        }
    }
}
