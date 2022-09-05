<?php

namespace App\Models;

use PDO;
use App\Models\DbConnect;

class Post
{
    public static function db()
    {
        return DbConnect::getInstance();
    }

    public static function create($post)
    {
        $prepare = self::db()->dbh()
            ->prepare("
                insert into posts (`title`, `text`)
                values (:title, :text)
            ");

        $prepare->execute($post);

        $insertId = self::db()->dbh()->lastInsertId();

        return setMessage("post: {$insertId} created");
    }

    public static function read()
    {
        $query = self::db()->dbh()
            ->query("select * from posts");

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete($id)
    {
        $postData = self::getById($id) ? $id : 'not found';

        $prepare = self::db()->dbh()
            ->prepare("delete from posts where id = ?");

        $prepare->execute([$id]);

        return setMessage("post {$postData} deleted");
    }

    public static function getById($id)
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from posts where id = ?");

        $prepare->execute([$id]);

        return $prepare->fetch(PDO::FETCH_ASSOC);
    }
}