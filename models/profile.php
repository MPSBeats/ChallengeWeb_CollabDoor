<?php

require_once 'Database.php';
class Profile
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }


    public function getProfile($pseudo)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
        $stmt->execute(['pseudo' => $pseudo]);
        return $stmt->fetch();
    }

    public function getCollabs($pseudo)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM collaborations WHERE pseudo = :pseudo');
        $stmt->execute(['pseudo' => $pseudo]);
        return $stmt->fetch();
    }

    public function getMasterclass($pseudo)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM formations WHERE pseudo = :pseudo');
        $stmt->execute(['pseudo' => $pseudo]);
        return $stmt->fetch();
    }
}
