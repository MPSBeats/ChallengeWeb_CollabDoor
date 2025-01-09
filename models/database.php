<?php
class Database
{
    private $host = "localhost";
    private $port = "5432";
    private $db_name = "collabdoor";
    private $username = "postgres";

    private $password = "Mapaaskla1";
    private $conn;

    public function connect()
    {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO(
                    'pgsql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name,
                    $this->username,
                    $this->password
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return $this->conn;
    }

    public function query($sql)
    {
        $this->connect(); // S'assure que la connexion est établie
        return $this->conn->query($sql);
    }
}

