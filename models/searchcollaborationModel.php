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
        return $stmt->execute([
            'title' => $title,
            'thumbnail' => $thumbnail2,
            'published_at' => $published_at
        ]);
    }

    public function getCollaborationId($title)
    {
        $stmt = $this->pdo->prepare('SELECT id FROM searchcollaborations WHERE title = :title');
        $stmt->execute(['title' => $title]);
        return $stmt->fetchColumn();
    }

    public function createUserSearchCollaboration($userId, $collaborationId)
    {
        $stmt = $this->pdo->prepare('INSERT INTO usersSearchCollaborations (id_user, id_collaboration) VALUES (:id_user, :id_collaboration)');
        return $stmt->execute([
            'id_user' => $userId,
            'id_collaboration' => $collaborationId
        ]);
    }
}
