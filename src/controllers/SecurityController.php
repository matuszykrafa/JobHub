<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/SessionRepository.php';

class SecurityController extends AppController {

    public function login()
    {
        if ($this->isAuthenticated()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }

        $userRepository = new UserRepository();
        $sessionRepository = new SessionRepository();


        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }
        $guid = $sessionRepository->createSession($user->getId());
        $time = time() + (86400 * 30);
        $cookie_name = "session";
        $cookie_value = $guid;
        setcookie($cookie_name, $cookie_value, $time, "/");
        $cookie_name = "user";
        $cookie_value = $user->getLogin();
        setcookie($cookie_name, $cookie_value, $time, "/");

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }
    public function register()
    {
        if ($this->isAuthenticated()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }

        $userRepository = new UserRepository();

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


        $user = $userRepository->getUser($email);

        if ($user) {
            return $this->render('login', ['messages' => ['User exists!']]);
        }

        if ($password != $repeat_password) {
            return $this->render('register', ['messages' => ['Passwords are not identical.']]);
        }

        $user = new User($email, password_hash($password, PASSWORD_BCRYPT), $login, $company);
        $userRepository->addUser($user);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }
}