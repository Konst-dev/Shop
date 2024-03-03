<?php

namespace app\engine;

use app\traits\TSingleton;

class Db
{
    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'shop_test',
        'charset' => 'utf8'
    ];

    use TSingleton;

    private $connection = null;

    private function getConnection()
    {
        if (is_null($this->connection)) {
            $this->connection = new \PDO($this->prepareDsnString(), $this->config['login'], $this->config['password']);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    private function prepareDsnString()
    {
        global $config;
        return sprintf(
            "%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }


    private function query($sql, $params)
    {
        //var_dump($sql, $params);
        $STH = $this->getConnection()->prepare($sql);
        $STH->execute($params);
        return $STH;
    }


    public function queryOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }


    public function queryWhereAssoc($sql, $params)
    {
        $STH = $this->query($sql, $params);
        $STH->setFetchMode(\PDO::FETCH_ASSOC);
        return $STH->fetchAll();
    }

    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function execute($sql, $params)
    {
        return $this->query($sql, $params)->rowCount();
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }
}
