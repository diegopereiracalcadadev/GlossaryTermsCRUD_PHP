<?php

function redirect($url)
{
    header("Location: $url");
    die();
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

function authenticate_user($email, $password)
{
    $users = CONFIG['users'];

    if (!isset($users[$email])) {
        return false;
    }

    $user_password = $users[$email];

    return $password == $user_password;
}

function is_user_authenticated()
{
    return isset($_SESSION['email']);
}

function ensure_user_is_authenticated()
{
    if (!is_user_authenticated()) {
        redirect('../login.php');
    }
}
