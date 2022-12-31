<?php

require_once __DIR__.'/../enums/RoleEnum.php';
class User {
    private $id;
    private $email;
    private $password;
    private $login;
    private RoleEnum $role;

    public function __construct(
        string $email,
        string $password,
        string $login,
        RoleEnum $role = RoleEnum::User,
        int $id = 0
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->login = $login;
        $this->role = $role;
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
    public function getRole(): RoleEnum {
        return $this->role;
    }

}