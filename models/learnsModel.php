<?php

require_once 'Database.php';

class Learn
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    // Get user profile by pseudo
    public function getLearningById($title)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM learnings WHERE title = :title');
        $stmt->execute(['title' => $title]);
        return $stmt->fetch(); // Fetches one record (assumes only one user per pseudo)
    }

    public function getPseudoByLearning($id_learning)
    {
        $sqlPseudo = "SELECT u.pseudo
                      FROM Users u
                      JOIN userlearnings uc ON u.id_user = uc.id_user
                      JOIN learnings c ON uc.id_learning = c.id_learning
                      WHERE c.id_learning = ?";
        $stmt = $this->pdo->prepare($sqlPseudo);
        $stmt->execute([$id_learning]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les résultats sous forme de tableau associatif
    }

    // Get all masterclasses for the user
    public function getAllLearnings()
    {
        $stmt = $this->pdo->prepare('
                SELECT * from learnings;

        ');
        $stmt->execute();
        return $stmt->fetchAll(); // Use fetchAll to retrieve all records
    }


    public function insertUserLearning($id_user, $id_learning)
{
    // Check if the user is already enrolled in the course
    $checkStmt = $this->pdo->prepare('
        SELECT COUNT(*) FROM userLearnings 
        WHERE id_user = :id_user AND id_learning = :id_learning
    ');
    $checkStmt->execute([
        'id_user' => $id_user,
        'id_learning' => $id_learning,
    ]);

    $isEnrolled = $checkStmt->fetchColumn();

    if ($isEnrolled > 0) {
        // User is already enrolled
        return false;
    }

    // Proceed with inserting the enrollment
    $stmt = $this->pdo->prepare('
        INSERT INTO userLearnings (id_user, id_learning)
        VALUES (:id_user, :id_learning)
    ');

    return $stmt->execute([
        'id_user' => $id_user,
        'id_learning' => $id_learning,
    ]);
}
}
