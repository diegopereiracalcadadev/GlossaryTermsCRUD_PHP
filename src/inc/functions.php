<?php

function output()
{
    global $guitars;
    echo '<pre>';
    print_r(pluck($guitars, 'manufacturer'));
    echo '</pre>';
}

function pluck($arr, $key)
{
    $result = array_map(function ($item) use ($key) {
        return $item[$key];
    }, $arr);

    return $result;
}

function autenticate_user($username, $pwd)
{
    return $username == USER_NAME && $pwd == PASSWORD;
}

function redirect($url)
{
    header("Location: $url");
}
