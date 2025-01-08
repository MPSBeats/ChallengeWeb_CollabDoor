<?php
class Database
{
    private $host = "localhost";
    private $port = "5432";
    private $db_name = "collabdoor";
    private $username = "postgres";
<<<<<<< HEAD
    private $password = "Dorian93120";
=======
    private $password = "109024";
>>>>>>> a2dd9707c542394e15bc1e8db3125466e20aa4ff
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
