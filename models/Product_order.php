<?php

namespace app\models;


class Product_order extends DBModel
{

    protected $product_id;
    protected $order_id;

    protected $props = [
        'product_id' => false,
        'order_id' => false,
    ];

    public function __construct(
        $product_id = 0,
        $order_id = 0
    ) {
        $this->product_id = $product_id;
        $this->order_id = $order_id;
    }


    public static function getTableName()
    {
        return 'Product_order';
    }
}
