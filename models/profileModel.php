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
                Collaborations.id_collaborations,
                Collaborations.title,
                Collaborations.thumbnail
            FROM 
                Users
            JOIN 
                UserCollaborations ON Users.id_user = UserCollaborations.id_user
            JOIN 
                Collaborations ON UserCollaborations.id_collaborations = Collaborations.id_collaborations
            WHERE 
                Users.pseudo = :pseudo;

        ');
        $stmt->execute(['pseudo' => $pseudo]);
        return $stmt->fetchAll(); // Use fetchAll to retrieve all records
    }

    // Get all masterclasses for the user
    public function getAllMasterclass($pseudo)
    {
        $stmt = $this->pdo->prepare('
                SELECT 
                    Learnings.id_learning,
                    Learnings.title,
                    Learnings.thumbnail,
                    Learnings.description,
                    Learnings.price,
                    Learnings.date,
                    Learnings.rate
                FROM 
                    Users
                JOIN 
                    UserLearnings ON Users.id_user = UserLearnings.id_user
                JOIN 
                    Learnings ON UserLearnings.id_learning = Learnings.id_learning
                WHERE 
                    Users.pseudo = :pseudo;

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
