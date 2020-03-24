<?php

namespace Core;

class Router
{
    /**
     * Массив с маршрутами
     *
     * @var array
     */
    protected $routes;

    /**
     * Пространство имен контроллеров
     *
     * @var string
     */
    protected $controllerNamespace = 'App\Controllers';

    /**
     * Конструктор
     *
     * @param array $routes Массив с маршрутами
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Получить путь
     *
     * @return string
     */
    protected function getPath()
    {
        $path  = rawurldecode($_SERVER['REQUEST_URI']);

        if ($pos = strpos($path, '?')) {
            $path = substr($path, 0, $pos);
        }

        $path = trim($path, '/');

        if ($path == '') {
            $path = '/';
        }

        return $path;
    }

    /**
     * Выполнить метод контроллера
     *
     * @param $nameController string Имя контроллера
     * @param $method string Имя метода
     *
     * @return mixed
     */
    protected function runControllerMethod(string $nameController, string $method)
    {
        $fullNameController = '\\'.$this->controllerNamespace.'\\'.$nameController;
        $controller = new $fullNameController();
        if (!$controller->isSecure()) {
            return;
        }
        return call_user_func([$controller, $method]);
    }

     /**
     * Выполнить действие согласно маршруту
     *
     * @return mixed
     */
    public function exeRoute()
    {
        $path = $this->getPath();

        foreach ($this->routes as $route) {
            if (preg_match($route[0], $path)) {
                return $this->runControllerMethod($route[1], $route[2]);
            }
        }

        header("HTTP/1.0 404 Not Found");
    }
}
