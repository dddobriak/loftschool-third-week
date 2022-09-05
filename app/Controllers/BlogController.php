<?php

namespace App\Controllers;

use App\Models\Auth;
use App\Models\Post;
use App\Models\User;

class BlogController
{
    public function create()
    {
        if (Auth::check($_SESSION)) {
            $posts = Post::read();
            $isAdmin = User::isAdmin();

            return view('index', compact('posts', 'isAdmin'));
        }

        return header('Location: /auth');
    }

    public function addPost()
    {
        if (!($_POST['title'] && $_POST['text'])) {
            setMessage('Some fields are empty');

            return header('Location: /');
        }

        Post::create($_POST);

        return header('Location: /');
    }

    public function delete()
    {
        Post::delete($_POST['post']);
        return header('Location: /');
    }
}
