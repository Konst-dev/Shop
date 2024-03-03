<?php

namespace app\models;

use app\engine\Db;

abstract class DBModel extends Model
{
    abstract public static function getTableName();

    public static function clearTable()
    {
        $tablename = static::getTableName();
        $sql = "DELETE FROM {$tablename}";
        return Db::getInstance()->queryClear($sql, []);
    }
    // public static function getWhere($name, $value)
    // {
    //     $tablename = static::getTableName();
    //     $sql = "SELECT * FROM {$tablename} WHERE {$name}=:{$name}";
    //     return Db::getInstance()->queryWhere($sql, [$name => $value], static::class);
    // }

    public static function getWhereAssoc($name, $value)
    {
        $tablename = static::getTableName();
        $sql = "SELECT * FROM {$tablename} WHERE {$name}=:{$name}";
        return Db::getInstance()->queryWhereAssoc($sql, [$name => $value]);
    }

    /**
     * 
     */
    public static function getWhereAssocJoin($table, $name, $value, $table2_name, $key1, $key2)
    {
        $tablename = static::getTableName();
        $sql = "SELECT * FROM {$tablename} INNER JOIN {$table2_name} ON {$tablename}.{$key1}={$table2_name}.{$key2} WHERE {$table}.{$name}=:{$name}";
        return Db::getInstance()->queryWhereAssoc($sql, [$name => $value]);
    }

    // public static function getWhereCmpAssoc($name, $sign, $value)
    // {
    //     $tablename = static::getTableName();
    //     if ($sign == '>')
    //         $sql = "SELECT * FROM {$tablename} WHERE {$name}>:{$name}";
    //     else if ($sign == '<')
    //         $sql = "SELECT * FROM {$tablename} WHERE {$name}<:{$name}";
    //     else $sql = "SELECT * FROM {$tablename} WHERE {$name}=:{$name}";
    //     return Db::getInstance()->queryWhereAssoc($sql, [$name => $value]);
    // }

    public static function getOne($id)
    {
        $tablename = static::getTableName();
        $sql = "SELECT * FROM {$tablename} WHERE id=:id";
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], static::class);
    }

    public static function getAll()
    {
        $tablename = static::getTableName();
        $sql = "SELECT * FROM {$tablename}";
        return Db::getInstance()->queryAll($sql);
    }

    /**
     * 
     */
    public static function getAllJoin($table2_name, $key1, $key2)
    {
        $tablename = static::getTableName();
        $sql = "SELECT *, {$tablename}.id AS {$tablename}_id FROM {$tablename} INNER JOIN {$table2_name} ON {$tablename}.{$key1}={$table2_name}.{$key2}";
        return Db::getInstance()->queryAll($sql);
    }

    // public static function getAllClass()
    // {
    //     $tablename = static::getTableName();
    //     $sql = "SELECT * FROM {$tablename}";
    //     return Db::getInstance()->queryAllClass($sql, static::class, []);
    // }

    protected function insert()
    {
        $columns = [];
        $params = [];
        $tablename = $this->getTableName();

        foreach ($this->props as $key => $value) {
            $params[':' . $key] = $this->$key;
            $columns[] = $key;
        }
        $columns = implode(',', $columns);
        $values = implode(',', array_keys($params));
        $sql = "INSERT INTO {$tablename} ({$columns}) VALUES ({$values})";
        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();
        return $this;
    }

    protected function update()
    {
        $columns = [];
        $params = [];
        $tablename = $this->getTableName();

        foreach ($this->props as $key => $value) {
            if (!$value) continue;
            $params[':' . $key] = $this->$key;
            $columns[] = $key;
        }
        $params[':id'] = $this->id;
        if (!empty($columns)) {
            $par_str = '';
            foreach ($columns as $value) {
                $par_str .= " " . $value . "=:" . $value . ", ";
            }
            $par_str = substr($par_str, 0, -2) . " ";
        }

        $sql = "UPDATE {$tablename} SET $par_str WHERE `id`=:id";
        Db::getInstance()->execute($sql, $params);
        foreach ($columns as $value) $this->props[$value] = false;
        return $this;
    }

    public function delete()
    {
        $tablename = $this->getTableName();
        $sql = "DELETE FROM {$tablename} WHERE id=:id";
        Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    public function save()
    {
        if ($this->id == null)
            return $this->insert();
        else
            return $this->update();
    }
}
