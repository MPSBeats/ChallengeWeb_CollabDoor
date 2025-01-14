<?php

require_once 'Database.php';
class SearchCollaboration
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    public function getAllSearchCollaborations()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM searchcollaborations');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les résultats sous forme de tableau associatif
    }
    
    
    public function createSearchCollaboration($title, $thumbnail)
    {
        $published_at = date('Y-m-d H:i:s');

        $thumbnail2 = 'assets/media/collaboration/thumbnail/' . $thumbnail;
        $stmt = $this->pdo->prepare('INSERT INTO searchcollaborations (title, thumbnail, published_at ) VALUES (:title, :thumbnail, :published_at)');
        $stmt->execute([
            'title' => $title,
            'thumbnail' => $thumbnail2,
            'published_at' => $published_at
        ]);
        $id = $this->pdo->lastInsertId();
        return $id;
    }



    public function createUserSearchCollaboration($userId, $collaborationId)
    {
        $stmt = $this->pdo->prepare('INSERT INTO usersSearchCollaborations (id_user, id_searchcollaborations) VALUES (:id_user, :id_searchcollaborations)');
        return $stmt->execute([
            'id_user' => $userId,
            'id_searchcollaborations' => $collaborationId
        ]);
    }

    
    public function getPseudoSearchCollaboration($idSearchCollaboration) {
        $sqlPseudo = "SELECT u.pseudo, u.id_user
                      FROM Users u
                      JOIN userssearchcollaborations uc ON u.id_user = uc.id_user
                      JOIN SearchCollaborations c ON uc.id_searchcollaborations = c.id_searchcollaborations
                      WHERE c.id_searchcollaborations = ?";
        $stmt = $this->pdo->prepare($sqlPseudo);
        $stmt->execute([$idSearchCollaboration]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les résultats sous forme de tableau associatif
    }
    
    public function getSearchThumbnail($userId){
        $sqlThumbnail = "SELECT sc.thumbnail, sc.id_searchcollaborations
                        FROM searchcollaborations sc
                        JOIN userssearchcollaborations usc ON sc.id_searchcollaborations = usc.id_searchcollaborations
                        JOIN Users u ON usc.id_user = u.id_user
                        WHERE u.id_user = $userId;
                        ";
        $resultThumbnail = $this->pdo->prepare($sqlThumbnail);
        $resultThumbnail->execute();
        return $resultThumbnail->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getIdForCollab(){
        $sqlId = "SELECT id_user FROM Users";
        $resultId = $this->pdo->prepare($sqlId);
        $resultId->execute();
        return $resultId->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
