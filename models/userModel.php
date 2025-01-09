<?php

require_once 'Database.php';
class User
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    public function register($pseudo, $password, $firstname, $lastname, $birth, $country, $mail, $phone, $picture)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO users ( pseudo, password, firstname, lastname, birth, country,  mail, phone, picture) VALUES  (:pseudo, :password,:firstname,:lastname, :birth, :country, :mail,:phone,  :picture)');

        return $stmt->execute([
            'pseudo' => $pseudo,
            'password' => $hashed_password,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'birth' => $birth,
            'country' => $country,
            'mail' => $mail,
            'phone' => $phone,
            'picture' => $picture
        ]);
    }

    public function login($pseudo, $password)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE pseudo= :pseudo');
        $stmt->execute(['pseudo' => $pseudo]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getUserId($pseudo)
    {
        $stmt = $this->pdo->prepare('SELECT id_user FROM users WHERE pseudo= :pseudo');
        $stmt->execute(['pseudo' => $pseudo]);
        return $stmt->fetchColumn();
    }
}
