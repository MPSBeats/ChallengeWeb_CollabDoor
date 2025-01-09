<?php
class Database
{
    private $host = "localhost";
    private $port = "5432";
    private $db_name = "collabdoor";
    private $username = "postgres";
    private $password = "109024";
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('pgsql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name, $this->username, $this->password);
        } catch (ErrorException $e) {
            die('Erreur : ' . $e->getMessage());
        }

        return $this->conn;
    }
}
