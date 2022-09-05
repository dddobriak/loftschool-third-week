<?php

namespace App\Models;

class Auth
{
    public static function db()
    {
        return DbConnect::getInstance();
    }

    public static function check($post)
    {
        return User::getByEmail($post['email']) ?? false;
    }

    public static function loginUser($post)
    {
        $post['password'] = sha1($post['password']);

        if (User::canLogin($post)) {
            setAuthSession($post['email']);

            return true;
        }
    }

    public static function createUser($post)
    {
        if ($post['name'] && $post['email'] && $post['password']) {
            $post['password'] = sha1($post['password']);
            User::create($post);
            setAuthSession($post['email']);

            return true;
        }
    }

    public static function logoutUser()
    {
        return setMessage('You are logged out');
    }
}
