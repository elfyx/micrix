<?php

namespace Core;

class Application
{
    /**
     * @var \Core\Router
     */
    protected $router;

    public function __construct()
    {
        $this->router = new Router(include __DIR__ . '/../config/route.php');
    }

    /**
     * Запуск приложения
     */
    public function run()
    {
        $result = $this->router->exeRoute();
        echo $result;
    }
}
