<?php

session_start();
require('../app/app.php');

ensure_user_is_authenticated();


$view_bag['title'] = 'Admin';
$view_bag['heading'] = 'Delete Term';

if (is_get()) {
    $id = sanitize($_REQUEST['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($id)) {
        view("not_found");
        die();
    }

    $term = Data::get_term($id);

    if (empty($term)) {
        view("not_found");
        die();
    }

    view("admin/delete", $term);
}

if (is_post()) {

    $term = sanitize($_REQUEST['term']);

    if (empty($term)) {
        echo 'empty term';
    } else {
        Data::delete_term($term);
        redirect("index.php");
    }
}
