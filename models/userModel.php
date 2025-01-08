<?php

class User
{
    private $id;
    private $firstname;
    private $lastname;
    private $pseudo;
    private $birth;
    private $email;
    private $country;
    private $phone;
    private $password;
    private $picture;


    public function __construct($id, $firstname, $lastname, $pseudo, $birth, $email, $country, $phone, $password, $picture)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->pseudo = $pseudo;
        $this->birth = $birth;
        $this->email = $email;
        $this->country = $country;
        $this->phone = $phone;
        $this->password = $password;
        $this->picture = $picture;
    }
}
