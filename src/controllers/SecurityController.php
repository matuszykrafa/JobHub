<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/SessionRepository.php';

class SecurityController extends AppController {

    private UserRepository $userRepository;
    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }
    public function login()
    {
        if ($this->isAuthenticated())
            $this->moveToLocation("home");

        if (!$this->isPost())
            return $this->render('login');

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUser($email);

        if (!$user)
            return $this->render('login', ['messages' => ['User not found!']]);

        if ($user->getEmail() !== $email)
            return $this->render('login', ['messages' => ['User with this email not exist!']]);

        if (!password_verify($password, $user->getPassword()))
            return $this->render('login', ['messages' => ['Wrong password!']]);


        $this->createLoginCookies($user);

        $this->moveToLocation("home");
    }
    public function register()
    {
        if ($this->isAuthenticated())
            $this->moveToLocation("home");

        if (!$this->isPost())
            return $this->render('register');


        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat_password'];
        $login = $_POST['login'];

        if (strlen($email) == 0 || strlen($password) == 0 || strlen($login) == 0)
            return $this->render('register', ['messages' => ['Please provide full data.']]);



        $user = $this->userRepository->getUser($email);

        if ($user)
            return $this->render('register', ['messages' => ['User exists!']]);

        if ($password != $repeat_password)
            return $this->render('register', ['messages' => ['Passwords are not identical.']]);


        $user = new User($email, password_hash($password, PASSWORD_BCRYPT), $login);

        $this->userRepository->addUser($user);

        $this->moveToLocation("login");
    }

    public function logout() {
        if (!isset($_COOKIE['session']))
            $this->moveToLocation("home");
        
        $sessionRepository = new SessionRepository();
        $sessionGuid = $_COOKIE['session'];
        $sessionRepository->deleteSession($sessionGuid);


        $this->clearCookies();

        $sessionRepository->deleteOldSessions();

        $this->moveToLocation("home");
    }

    private function createLoginCookies(User $user) {
        $sessionRepository = new SessionRepository();

        $guid = $sessionRepository->createSession($user->getId());
        $time = time() + (86400 * 30);

        $cookie_name = "session";
        $cookie_value = $guid;
        setcookie($cookie_name, $cookie_value, $time, "/");

        $cookie_name = "user";
        $cookie_value = $user->getLogin();
        setcookie($cookie_name, $cookie_value, $time, "/");

        if ($user->getRole() == RoleEnum::Admin)
        $cookie_name = "role";
        $cookie_value = $user->getRole()->name;
        setcookie($cookie_name, $cookie_value, $time, "/");
    }
}