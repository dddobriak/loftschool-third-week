<?php

use Bramus\Router\Router;

// Create Router instance
$router = new Router();

// Define routes
$router->get('/', 'App\Controllers\Blog@create');
$router->get('/auth', 'App\Controllers\Auth@create');
$router->post('/login', 'App\Controllers\Auth@login');
$router->post('/register', 'App\Controllers\Auth@register');
$router->post('/logout', 'App\Controllers\Auth@logout');

// Define 404
$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
    echo 'Хоба!';
});

// Run it!
$router->run();
