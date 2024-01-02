<?php

require('app/app.php');

$view_bag = [];
$view_bag['title'] = 'Glossary List';
$view_bag['heading'] = 'Glossary';

if (isset($_GET['search'])) {
    $items = search_terms($_GET['search']);
    $view_bag['heading'] = 'Searching terms for ' . $_GET['search'];
} else {
    $items = get_terms();
}

view('index', $items);
