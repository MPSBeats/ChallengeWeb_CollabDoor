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
        $stmt = $this->pdo->prepare('INSERT INTO searchcollaborations (title, thumbnail, published_at ) VALUES (:title, :thumbnail, :published_at)');
        return $stmt->execute([
            'title' => $title,
            'thumbnail' => $thumbnail,
            'published_at' => $published_at
        ]);
    }
}
