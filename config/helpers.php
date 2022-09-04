<?php

function view($view)
{
    require_once ROOT . '/app/Views/' . $view . '.php';
}

function message($text)
{
    $_POST['message'] .= $text . '<br>';
}
