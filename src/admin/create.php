<?php

session_start();
require('../app/app.php');

ensure_user_is_authenticated();

if (is_post()) {

    $term = sanitize($_REQUEST['term']);
    $definition = sanitize($_REQUEST['definition']);

    if (empty($term) || empty($definition)) {
        echo 'ALL FIELS ARE REQUIRED';
    } else {
        add_term($term, $definition);
        redirect("index.php");
    }
}

$view_bag['title'] = 'Admin';
$view_bag['heading'] = 'Create Term';

view('admin/create', Data::get_terms());
