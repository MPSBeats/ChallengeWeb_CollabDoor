<?php

require_once 'Database.php';
class User
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    public function register($firstname, $pseudo, $lastname, $birth, $mail, $country, $phone, $password, $picture)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO users (firstname, pseudo, lastname, birth, mail, country, phone, password, picture) VALUES (:firstname, :pseudo, :lastname, :birth, :mail, :country, :phone, :password, :picture)');

        return $stmt->execute([
            'firstname' => $firstname,
            'pseudo' => $pseudo,
            'lastname' => $lastname,
            'birth' => $birth,
            'mail' => $mail,
            'country' => $country,
            'phone' => $phone,
            'password' => $hashed_password,
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
}
