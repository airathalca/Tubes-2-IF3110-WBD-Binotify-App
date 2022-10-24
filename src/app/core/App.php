<?php

class App
{
    // Ketiga atribut ini untuk menjelaskan suatu URL:
    // public/<controller_name>/<method_name>/:<parameters_list>
    protected $controller;
    protected $method;
    protected $params;

    public function __construct()
    {
        //  By default, controller yang digunakan adalah NotFoundController - menyatakan page tidak ditemukan
        require_once __DIR__ . '/../controllers/NotFoundController.php';
        $this->controller = new NotFoundController();
        $this->method = 'index';

        // 'Explode' URL yang didapatkan, [0] adalah bagian controller, [1] adalah bagian method dari controller, selebihnya adalah params
        $url = $this->parseURL();

        // Cek bagian controller: jika filenya ada, gunakan controller tersebut; jika tidak, pakai yang default (NotFoundController)
        $controllerPart = $url[0] ?? null;
        if (isset($controllerPart) && file_exists(__DIR__ . '/../controllers/' . $controllerPart . 'Controller.php')) {
            require_once __DIR__ . '/../controllers/' . $controllerPart . 'Controller.php';
            $controllerClass = $controllerPart . 'Controller';
            $this->controller = new $controllerClass();
        }
        unset($url[0]);

        // Cek bagian method: jika filenya ada, gunakan method tersebut; jika tidak, pakai yang default (index)
        $methodPart = $url[1] ?? null;
        if (isset($methodPart) && method_exists($this->controller, $methodPart)) {
            $this->method = $methodPart;
        }
        unset($url[1]);

        // Cek bagian parameter
        if (!empty($url)) {
            $this->params = array_values($url);
        } else {
            $this->params = [];
        }

        // Panggil method dari kelas controller, dengan parameter params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseURL()
    {
        // 'Explode' URL agar bisa digunakan untuk keperluan routing
        if (isset($_SERVER['PATH_INFO'])) {
            $url = trim($_SERVER['PATH_INFO'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}
