<?php

// namespace App\Models;

// use PDO;
// use PDOException;

class Database
{
    private $host = HOST_NAME;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PSWD;
    private $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
