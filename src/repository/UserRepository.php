<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['login'],
            RoleEnum::from($user['role']),
            $user['id']
        );
    }
    public function addUser(User $userToAdd)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, login, role)
VALUES (?, ?, ?,?)'
        );
        $stmt->execute([
            $userToAdd->getEmail(),
            $userToAdd->getPassword(),
            $userToAdd->getLogin(),
            $userToAdd->getRole()->value
        ]);
    }

    public function getUserBySessionGuid(): ?User {
        if (!isset($_COOKIE['session'])) return null;

        $sessionGuid = $_COOKIE['session'];
        $stmt = $this->database->connect()->prepare('
            SELECT users.* FROM sessions JOIN users ON sessions."userId" = users.id WHERE sessions."sessionGuid" = :sessionGuid
        ');
        $stmt->bindParam(':sessionGuid', $sessionGuid, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }
        return new User(
            $user['email'],
            $user['password'],
            $user['login'],
            RoleEnum::from($user['role']),
            $user['id']
        );
    }
}