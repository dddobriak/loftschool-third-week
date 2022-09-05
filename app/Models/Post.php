<?php

namespace App\Models;

use PDO;

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
                insert into posts (`title`, `text`, `user_id`)
                values (:title, :text, :user_id)
            ");

        $post['user_id'] = Auth::check($_SESSION)['id'];
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

        return $prepare->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByUser($id)
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from posts where user_id = ?");
        $prepare->execute([$id]);

        return $prepare->fetchAll(PDO::FETCH_ASSOC);
    }
}
