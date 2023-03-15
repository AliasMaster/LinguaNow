<?php
class Database
{
    private $dbHost = 'localhost';
    private $dbUser = 'root';
    private $dbPassword = '';
    private $dbName;
    private $conn = null;

    public function __construct(String $dbName)
    {
        $this->dbName = $dbName;
    }

    public function connection()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUser, $this->dbPassword);
        } catch (PDOException $error) {
            echo "Nie udało się nawiązać połączenia z bazą danych";
        } finally {
            return $this->conn;
        }
    }
}
