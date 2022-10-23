<?php

class App
{
    protected $controller;
    protected $method;
    protected $params;

    public function __construct()
    {
        $url = $this->parseURL();

        $controllerPart = $url[0] ?? null;
        if (isset($controllerPart) && file_exists(__DIR__ . '/../controllers/' . $controllerPart . '.php')) {
            require_once __DIR__ . '/../controllers/' . $controllerPart . '.php';
            $this->controller = new $controllerPart();
        } else {
            require_once __DIR__ . '/../controllers/NotFound.php';
            $this->controller = new NotFound();
        }
        unset($url[0]);

        $methodPart = $url[1] ?? null;
        if (isset($methodPart) && method_exists($this->controller, $methodPart)) {
            $this->method = $methodPart;
        } else {
            require_once __DIR__ . '/../controllers/NotFound.php';
            $this->controller = new NotFound();
            $this->method = 'index';
        }
        unset($url[1]);

        if (!empty($url)) {
            $this->params = array_values($url);
        } else {
            $this->params = [];
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseURL()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            $url = trim($_SERVER['PATH_INFO'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}
