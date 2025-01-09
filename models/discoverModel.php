<?php

require_once 'Database.php';
class Discover {
    
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    


};
