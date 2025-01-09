<?php

require_once 'Database.php';
class Collaborate {
    
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    


};
