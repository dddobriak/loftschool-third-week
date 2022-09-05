<?php

namespace App\Controllers;

use App\Models\Auth;

class AuthController
{
    public static function create()
    {
        if (!Auth::check($_SESSION)) {
            return view('auth');
        }

        return header('Location: /');
    }

    public static function login()
    {
        if (Auth::check($_POST) && Auth::loginUser($_POST)) {
            setMessage('Welcome!');

            return header('Location: /');
        }

        setMessage('User not found or wrong password');

        return header('Location: /auth');
    }

    public static function register()
    {
        if (Auth::check($_POST)) {
            setMessage('User already exists');

            return header('Location: /auth');
        }

        if (Auth::createUser($_POST)) {
            return header('Location: /');
        }

        setMessage('Some fields are empty');

        return header('Location: /auth');
    }

    public static function logout()
    {
        echo 'logout';
    }
}
