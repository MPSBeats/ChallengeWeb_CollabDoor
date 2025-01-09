<?php

require_once 'Database.php';

class Profile
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    // Get user profile by pseudo
    public function getProfile($pseudo)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
        $stmt->execute(['pseudo' => $pseudo]);
        return $stmt->fetch(); // Fetches one record (assumes only one user per pseudo)
    }

    // Get all collaborations for the user
    public function getAllCollabs($pseudo)
    {
        $stmt = $this->pdo->prepare('
            SELECT 
                Collaboration.id_collaboration,
                Collaboration.title,
                Collaboration.thumbnail
            FROM 
                Users
            JOIN 
                UsersCollaborations ON Users.id_user = UsersCollaborations.id_user
            JOIN 
                Collaboration ON UsersCollaborations.id_collaboration = Collaboration.id_collaboration
            WHERE 
                Users.pseudo = :pseudo
        ');
        $stmt->execute(['pseudo' => $pseudo]);
        return $stmt->fetchAll(); // Use fetchAll to retrieve all records
    }

    // Get all masterclasses for the user
    public function getAllMasterclass($pseudo)
    {
        $stmt = $this->pdo->prepare('
            SELECT 
                Learnings.title,
                Learnings.thumbnail
            FROM 
                Users
            JOIN 
                UsersLearnings ON Users.id_user = UsersLearnings.id_user
            JOIN 
                Learnings ON UsersLearnings.id_learning = Learnings.id_learning
            WHERE 
                Users.pseudo = :pseudo
        ');
        $stmt->execute(['pseudo' => $pseudo]);
        return $stmt->fetchAll(); // Use fetchAll to retrieve all records
    }

    public function getPicture($pseudo)
    {
        $stmt = $this->pdo->prepare('SELECT picture FROM users WHERE pseudo = :pseudo');
        $stmt->execute(['pseudo' => $pseudo]);
        return $stmt->fetch(); // Fetches one record (assumes only one user per pseudo)
    }
}
