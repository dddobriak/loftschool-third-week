<?php

namespace App\Controllers;

use App\Models\Migrate;
use App\Models\DbConnect;

class MigrateController
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance();
    }

    public function create()
    {
        Migrate::createUsersTable($this->db);
        Migrate::createPostsTable($this->db);

        return view('index');
    }

    public function remove()
    {
        Migrate::dropUsersTable($this->db);
        Migrate::dropPostsTable($this->db);

        return view('index');
    }
}
