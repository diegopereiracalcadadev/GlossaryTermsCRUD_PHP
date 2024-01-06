<?php

session_start();
require('../app/app.php');

ensure_user_is_authenticated();


$view_bag['title'] = 'Admin';
$view_bag['heading'] = 'Edit Term';

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

    view("admin/edit", $term);
}

if (is_post()) {

    $id = sanitize(($_POST['id']));
    $term = sanitize($_POST['term']);
    $definition = sanitize($_POST['definition']);

    if (empty($term) || empty($definition) || empty($id)) {
        echo 'ALL FIELS ARE REQUIRED';
    } else {
        Data::update_term($id, $term, $definition);
        redirect("index.php");
    }
}

// view('admin/create', get_terms());
