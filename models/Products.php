<?php

namespace app\models;


class Products extends DBModel
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;

    protected $props = [
        'name' => false,
        'description' => false,
        'price' => false,
    ];

    public function __construct(
        $name = 'product',
        $description = '',
        $price = 0,
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }


    public static function getTableName()
    {
        return 'Products';
    }
}
