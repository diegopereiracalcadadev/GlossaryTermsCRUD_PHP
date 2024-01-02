<?php

require('../app/app.php');

error_log("testando log");


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

view('admin/create', get_terms());
