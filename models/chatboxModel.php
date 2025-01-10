<?php

require_once 'Database.php';
class Chatbox
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    public function fetchMessageUsers($pseudo)
    {
        $sql = "SELECT DISTINCT u2.pseudo 
                FROM Users u1
                JOIN Chats c ON u1.id_user = c.sender OR u1.id_user = c.receiver
                JOIN Users u2 ON (c.sender = u2.id_user OR c.receiver = u2.id_user)
                WHERE u1.pseudo = :pseudo AND u1.id_user <> u2.id_user";

        $result = $this->pdo->prepare($sql);

        if ($result->execute([':pseudo' => $pseudo])) {
            $users = $result->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        }

        return [];
    }
}
