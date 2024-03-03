<?php

namespace app\engine;

class Request
{
    protected $requestString;
    protected $controllerName;
    protected $actionName;
    protected $method;
    protected $params = [];

    public function __construct()
    {
        $this->parseRequest();
    }

    protected function parseRequest()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $url = explode('/', $this->requestString);
        $this->params = $_REQUEST;

        if (count($url) == 4 || (count($url) == 3/* && $_REQUEST == null*/)) {
            $this->controllerName = $url[1];
            $this->actionName = $url[2];
            $this->params['par_4'] = $url[3];
        } else {
            $this->controllerName = null;
            $this->actionName = null;
        }


        $data = json_decode(file_get_contents('php://input'));
        if (!is_null($data))
            foreach ($data as $key => $value)
                $this->params[$key] = $value;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getParams()
    {
        return $this->params;
    }
}
