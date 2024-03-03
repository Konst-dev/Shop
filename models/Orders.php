<?php

namespace app\models;


class Orders extends DBModel
{
    protected $id;
    protected $date_time;
    protected $is_paid;
    protected $description;
    protected $user_id;

    protected $props = [
        'date_time' => false,
        'is_paid' => false,
        'description' => false,
        'user_id' => false,
    ];

    public function __construct(
        $date_time = '2024-01-01 12:00:00',
        $is_paid = false,
        $description = '',
        $user_id = 0,
    ) {
        $this->date_time = $date_time;
        $this->is_paid = $is_paid;
        $this->description = $description;
        $this->user_id = $user_id;
    }


    public static function getTableName()
    {
        return 'Orders';
    }
}
