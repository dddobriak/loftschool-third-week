<?php

namespace App\Models;

use PDO;

class User
{
    public static function db()
    {
        return DbConnect::getInstance();
    }

    public static function create($user)
    {
        $prepare = self::db()->dbh()
            ->prepare("
                insert into users (`name`, `email`, `password`)
                values (:name, :email, :password)
            ");

        $prepare->execute($user);
        $insertId = self::db()->dbh()->lastInsertId();
        $userData = implode(' ', self::getById($insertId));

        return setMessage("user: {$userData} created");
    }

    public static function getById($id)
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from users where id = ?");
        $prepare->execute([$id]);

        return $prepare->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByEmail($email)
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from users where email = ?");
        $prepare->execute([$email]);

        return $prepare->fetch(PDO::FETCH_ASSOC);
    }

    public static function delete($id)
    {
        $userData = self::getById($id) ? $id : 'not found';

        $prepare = self::db()->dbh()
            ->prepare("delete from users where id = ?");
        $prepare->execute([$id]);

        return setMessage("user {$userData} deleted");
    }

    public static function canLogin($user)
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from users where email = :email and password = :password");
        $prepare->execute($user);

        return $prepare->fetch(PDO::FETCH_ASSOC);
    }

    public static function isAdmin()
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from users where email = ? and is_admin = 1");
        $prepare->execute([$_SESSION['email']]);

        return $prepare->fetch(PDO::FETCH_ASSOC)['is_admin'];
    }
}
