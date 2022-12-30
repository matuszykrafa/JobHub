<?php

class User {
    private $email;
    private $password;
    private $login;
    private $company;

    public function __construct(
        string $email,
        string $password,
        string $login,
        string $company
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->login = $login;
        $this->company = $company;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
}