<?php

namespace App\Controllers;

use App\Models\DbConnect;

class Migrate
{
    public function __construct()
    {
        $connect = DbConnect::getInstance();
    }

    public function create()
    {
        echo 'migration create';
    }

    public function remove()
    {
        echo 'migration remove';
    }
}
