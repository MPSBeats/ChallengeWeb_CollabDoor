<?php

require_once 'Database.php';
class ProductSheet {
    
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
    public function fetchCollaborationById($id)
    {
        $sql = "SELECT * FROM collaborations WHERE id_collaborations = :id";
        $result = $this->pdo->prepare($sql);
        $result->execute([':id' => $id]);
        $collaborations = $result->fetchAll(PDO::FETCH_ASSOC);

        return $collaborations;
    }

    /**
     * Fetch the users associated with a specific collaboration
     *
     * @param int $id The ID of the collaboration
     * @return array List of users associated with the collaboration
     */
    public function fetchUsersByCollaborationId($id)
    {
        $sql = "SELECT u.pseudo, u.id_user
                FROM Users u
                JOIN UserCollaborations uc ON u.id_user = uc.id_user
                JOIN Collaborations c ON uc.id_collaborations = c.id_collaborations
                WHERE c.id_collaborations = :id";

        $result = $this->pdo->prepare($sql);
        $result->execute([':id' => $id]);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    


};
