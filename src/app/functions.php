<?php

function redirect($url)
{
    header("Location: $url");
}

function view($name, $model = '')
{
    global $view_bag;
    require(APP_PATH . "views/layout.view.php");
}

function is_get()
{
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

function is_post()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function sanitize($value)
{
    $result = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($result === false) {
        return '';
    }

    return $result;
}
