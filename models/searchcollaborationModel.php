<?php

require_once 'Database.php';
class SearchCollaboration
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
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
}
