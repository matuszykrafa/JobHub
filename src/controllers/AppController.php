<?php

require_once __DIR__.'/../repository/SessionRepository.php';
class AppController {
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
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
}
