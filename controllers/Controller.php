<?php

namespace app\controllers;

use app\interfaces\IRenderer;

class Controller
{
    private $action;
    private $defaultAction = 'index';
    protected $render;

    public function __construct(IRenderer $render)
    {
        $this->render = $render;
    }
    public function runAction($action)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else echo '<h1 style="text-align:center">ОШИБКА: Метод не найден!</h1>';
    }


    protected function render($template, $params = [])
    {

        return $this->renderTemplate('layouts/main', [
            'menu' => $this->renderTemplate('menu', []),
            'content' => $this->renderTemplate($template, $params),
        ]);
    }

    protected function renderTemplate($template, $params = [])
    {
        return $this->render->renderTemplate($template, $params);
    }
}
