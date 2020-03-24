<?php

namespace Core;

class View
{
    /**
     * Путь к видам
     *
     * @var string
     */
    protected $viewPath;

    /**
     * Конструктор
     *
     * @param string $viewPath
     */
    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
    }

    /**
     * Получить отображение
     *
     * @param string $view
     * @param array $data
     *
     * @return string
     */
    public function render(string $view, array $data = [])
    {
        $headerView = $this->viewPath.'layouts/headerView.php';
        $footerView = $this->viewPath.'layouts/footerView.php';
        $fullNameView = $this->viewPath.$view.'View.php';

        ob_start();
        extract($data);
        include $headerView;
        include $fullNameView;
        include $footerView;
        return ob_get_clean();
    }
}
