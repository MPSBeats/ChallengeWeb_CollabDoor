<?php

require_once 'Database.php';
class SearchSheet {
    
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }
    /**
     * Fetch a specific collaboration by its ID
     *
     * @param int $id The ID of the collaboration
     * @return array|null The collaboration data or null if not found
     */
    public function fetchSearchById($id)
    {
        $sql = "SELECT * FROM searchcollaborations WHERE id_searchcollaborations = :id";
        $result = $this->pdo->prepare($sql);
        $result->execute([':id' => $id]);
        $Search = $result->fetchAll(PDO::FETCH_ASSOC);

        return $Search;
    }



    public function fetchUsersBySearchCollaborationsId($id)
    {
        $sql = "SELECT u.pseudo, u.id_user
                FROM Users u
                JOIN UserssearchCollaborations usc ON u.id_user = usc.id_user
                JOIN searchCollaborations sc ON usc.id_searchCollaborations = sc.id_searchCollaborations
                WHERE sc.id_searchcollaborations = :id";

        $result = $this->pdo->prepare($sql);
        $result->execute([':id' => $id]);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
};
