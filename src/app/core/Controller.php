<?php

class Controller
{
    public function view($folder, $view, $data = [])
    {
        require_once __DIR__ . '/../views/' . $folder . '/' . $view . '.php';
        return new $view($data);
    }

    public function model($model)
    {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }

    public function middleware($middleware)
    {
        require_once __DIR__ . '/../middlewares/' . $middleware . '.php';
        return new $middleware();
    }
}
