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
            $user['company'],
            $user['id']
        );
    }
    public function addUser(User $userToAdd)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, login, company)
VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([
            $userToAdd->getEmail(),
            $userToAdd->getPassword(),
            $userToAdd->getLogin(),
            $userToAdd->getCompany()
        ]);
    }
}