<?php

namespace app\engine;

use app\interfaces\IRenderer;

class Render implements IRenderer
{
    public function renderTemplate($template, $params = [])
    {
        $templatePath = ROOT . '/views/'  . $template . ".php";
        ob_start();
        extract($params);

        if (file_exists($templatePath)) {

            include $templatePath;
            return ob_get_clean();
        } else {
            return '<h1 style="text-align:center">Страница не найдена или находится в разработке</h1>';
        }
    }
}
