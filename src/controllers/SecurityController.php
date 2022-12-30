<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';

class SecurityController extends AppController {

    public function login()
    {
        $encrypted = password_hash('admin', PASSWORD_BCRYPT);
        $user = new User('jsnow@pk.edu.pl', $encrypted, 'Johnny', 'Snow');

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }
    public function register()
    {
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat_password'];
        $login = $_POST['login'];
        $company = $_POST['company'];

        if (strlen($email) == 0 || strlen($password) == 0 || strlen($login) == 0 || strlen($company) == 0) {
            return $this->render('register', ['messages' => ['Please provide full data.']]);
        }

        if ($password != $repeat_password) {
            return $this->render('register', ['messages' => ['Passwords are not identical.']]);
        }

        $user = new User($email, password_hash($password, PASSWORD_BCRYPT), $login, $company);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }
}