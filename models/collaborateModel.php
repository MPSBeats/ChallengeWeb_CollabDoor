<?php

require_once 'Database.php';
class Collaborate {
    
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    
    public function getAllCollaborations()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM collaborations');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les résultats sous forme de tableau associatif
    }

    public function getPseudoCollaboration($idCollaboration) {
        $sqlPseudo = "SELECT u.pseudo
                      FROM Users u
                      JOIN usercollaborations uc ON u.id_user = uc.id_user
                      JOIN collaborations c ON uc.id_collaborations = c.id_collaborations
                      WHERE c.id_collaborations = ?";
        $stmt = $this->pdo->prepare($sqlPseudo);
        $stmt->execute([$idCollaboration]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les résultats sous forme de tableau associatif
    }

    public function getThumbnailsByUserId($userId) {
        $sql = "SELECT sc.thumbnail
                FROM searchcollaborations sc
                JOIN userssearchcollaborations usc ON sc.id_searchcollaborations = usc.id_searchcollaborations
                JOIN Users u ON usc.id_user = u.id_user
                WHERE u.id_user = :user_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':user_id' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
};
