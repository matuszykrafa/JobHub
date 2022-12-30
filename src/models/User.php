<?php

class User {
    private $id;
    private $email;
    private $password;
    private $login;
    private $company;

    public function __construct(
        string $email,
        string $password,
        string $login,
        string $company,
        int $id = 0
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->login = $login;
        $this->company = $company;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getCompany()
    {
        return $this->company;
    }
}