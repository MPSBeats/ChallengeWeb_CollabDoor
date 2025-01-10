<?php

require_once 'Database.php';
class Discover {
    
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    public function getAllCollaborations() {
        $sql = "SELECT * FROM collaborations";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUserCollaborations() {
        $sql = "SELECT * FROM usercollaborations";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



};
