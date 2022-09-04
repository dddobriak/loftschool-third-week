<?php

namespace App\Models;

class Migrate
{
    public static function createUsersTable($db)
    {
        $db->dbh()
            ->query(
                "CREATE TABLE IF NOT EXISTS `users` (
                `id` bigint(20) NOT NULL AUTO_INCREMENT,
                `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `is_admin` tinyint DEFAULT NULL,
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
            );

        return message('users table created');
    }

    public static function createPostsTable($db)
    {
        $db->dbh()
            ->query(
                "CREATE TABLE IF NOT EXISTS `posts` (
                    `id` bigint(20) NOT NULL AUTO_INCREMENT,
                    `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                    `text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
            );

        return message('posts table created');
    }

    public static function dropUsersTable($db)
    {
        $db->dbh()
            ->query(
                "DROP TABLE IF EXISTS `users`"
            );

        return message('users table removed');
    }

    public static function dropPostsTable($db)
    {
        $db->dbh()
            ->query(
                "DROP TABLE IF EXISTS `posts`"
            );

        return message('posts table removed');
    }
}
