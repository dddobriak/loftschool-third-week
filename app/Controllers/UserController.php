<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function create()
    {
        User::create($_POST);

        return view('index');
    }

    public function delete()
    {
        $userId = $_GET['user_id'];

        User::delete($userId);

        return view('index');
    }
}
