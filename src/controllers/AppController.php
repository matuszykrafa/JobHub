<?php

require_once __DIR__.'/../repository/SessionRepository.php';
class AppController {
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
        if (!$this->isAuthenticated())
            $this->clearCookies();
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function isAuthenticated(): bool
    {
        if (!isset($_COOKIE['session'])) {
            return false;
        }
        $sessionGuid = $_COOKIE['session'];
        $sessionRepository = new SessionRepository();
        return $sessionRepository->sessionExists($sessionGuid);
    }

    protected function moveToLocation(string $location) {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/".$location);
    }

    protected function render(string $template = null, array $variables = []) {
        $templatePath = 'public/views/'.$template.'.php';

        $output = "Not found";

        if (file_exists($templatePath)) {
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }
    protected function clearCookies() {
        $time = time() - 30;

        $cookie_name = "session";
        $cookie_value = '';
        setcookie($cookie_name, $cookie_value, $time, "/");

        $cookie_name = "user";
        $cookie_value = 0;
        setcookie($cookie_name, $cookie_value, $time, "/");

        $cookie_name = "role";
        $cookie_value = 'role';
        setcookie($cookie_name, $cookie_value, $time, "/");
    }
}
