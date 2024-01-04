<?php

session_start();
require('../app/app.php');

ensure_user_is_authenticated();


$view_bag['title'] = 'Admin';
$view_bag['heading'] = 'Edit Term';

if (is_get()) {
    $key = sanitize($_REQUEST['key'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($key)) {
        view("not_found");
        die();
    }

    $term = get_term($key);

    if (empty($term)) {
        view("not_found");
        die();
    }

    view("admin/edit", $term);
}

if (is_post()) {

    $term = sanitize($_POST['term']);
    $definition = sanitize($_POST['definition']);
    $original_term = sanitize(($_POST['original-term']));

    if (empty($term) || empty($definition) || empty($original_term)) {
        echo 'ALL FIELS ARE REQUIRED';
    } else {
        update_term($original_term, $term, $definition);
        redirect("index.php");
    }
}

// view('admin/create', get_terms());
