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

    public function getUserPseudosByCollaborationId($collaborationId)
    {
        $sql = "SELECT u.pseudo
                FROM Users u
                JOIN UserCollaborations uc ON u.id_user = uc.id_user
                JOIN Collaborations c ON uc.id_collaborations = c.id_collaborations
                WHERE c.id_collaborations = :collaborationId";

        $result = $this->pdo->prepare($sql);
        $result->execute([':collaborationId' => $collaborationId]);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRandomUser()
    {
        $sql = "SELECT * FROM Users ORDER BY RANDOM() LIMIT 1";
        $result = $this->pdo->prepare($sql);
        $result->execute();

        return $result->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getCollaborationsByRandomUserId($userId)
    {
        $sql = "SELECT c.*
                FROM collaborations c
                JOIN usercollaborations uc ON c.id_collaborations = uc.id_collaborations
                WHERE uc.id_user = :id_user";

        $result = $this->pdo->prepare($sql);
        $result->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }


};
