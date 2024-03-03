<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class Model implements IModel
{

    protected $props = [];

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->props)) {
            $this->$name = $value;
            $this->props[$name] = true;
        }
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
