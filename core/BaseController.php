<?php

namespace Core;

abstract class BaseController
{
    /**
     * Если true то контроллер доступен только авторизованным пользователям
     *
     * @var bool
     */
    protected $onlyLogin = false;

    /**
     * @var \Core\View
     */
    protected $viev;

    public function __construct()
    {
        $this->viev = new View(__DIR__.'/..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR);
    }

    /**
     * Перенаправить на другой адрес
     *
     * @param string $uri
     */
    public function redirect(string $uri)
    {
        header("Location: $uri", true, 302);
    }

    /**
     * Проверка безопасности доступа к контроллеру
     *
     * @return bool
     */
    public function isSecure()
    {
        if ($this->onlyLogin == true && !Auth::isLogin()) {
            $this->redirect('/login');
            return false;
        }

        return true;
    }
}