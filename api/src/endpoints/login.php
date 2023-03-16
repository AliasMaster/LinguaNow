<?php

class Login
{
    private PDO $conn;
    private $data;

    public function __construct(Database $database, string $method)
    {
        $this->conn = $database->getConnection();

        if ($method == "POST") {
            $data = json_decode(file_get_contents("php://input"));
            $this->data = $data;

            $this->checkData();
        } else {
            http_response_code(404);
            header("Allow: POST");
            echo json_encode(['message' => 'Invalid method!']);
            exit;
        }
    }

    public function checkData()
    {

        if (
            !isset($this->data->email)
            || !isset($this->data->password)
            || empty(trim($this->data->email))
            || empty(trim($this->data->password))
        ) {
            http_response_code(404);
            echo json_encode(['message' => 'Incorrect inputs!']);
        } else {
            $email = $this->data->email;
            $password = $this->data->password;

            $getUserByEmail = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($getUserByEmail);
            $stmt->bindValue(":email", $email, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $check_password = password_verify($password, $row['password']);

                if ($check_password) {

                    $token = $row['accessLevel'] . '.' . $row['id'];

                    echo json_encode([
                        "success" => 1,
                        "message" => "You have successfully logged in.",
                        "userData" => [
                            "lname" => $row['lname'],
                            "email" => $row['email'],
                            "fname" => $row['fname'],
                            "id" => $row['id'],
                            "phone" => $row['phone'],
                            "address" => $row['address'],
                            "city" => $row['city']
                        ],
                        "token" => $token
                    ]);
                } else {
                    http_response_code(422);
                    echo json_encode(['message' => 'Nie poprawny E-mail lub hasło']);
                }
            } else {
                http_response_code(422);
                echo json_encode(['message' => 'Nie poprawny E-mail lub hasło']);
            }
        }
    }
}
