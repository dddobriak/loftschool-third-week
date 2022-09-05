<?php

function view($view)
{
    require_once ROOT . '/app/Views/' . $view . '.php';
}

function setMessage($text)
{
    $_SESSION['message'] .= $text . '<br>';
}

function getMessage()
{
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

function setAuthSession($email)
{
    $_SESSION['email'] = $email;
}
