<?php

namespace app\models;


class Users extends DBModel
{
    protected $id;
    protected $lastname;
    protected $firstname;
    protected $middlename;
    protected $phone_number;
    protected $email;


    protected $props = [
        'lastname' => false,
        'firstname' => false,
        'middlename' => false,
        'phone_number' => false,
        'email' => false,
    ];

    public function __construct(
        $lastname = null,
        $firstname = null,
        $middlename = null,
        $phone_number = '+70000000000',
        $email = null
    ) {
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->middlename = $middlename;
        $this->phone_number = $phone_number;
        $this->email = $email;
    }


    public static function getTableName()
    {
        return 'Users';
    }
}
