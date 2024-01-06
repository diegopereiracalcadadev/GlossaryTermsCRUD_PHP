<?php

require('app/app.php');

if (!isset($_GET['id'])) {
    redirect("index.php");
    die();
}


$data = Data::get_term($_GET['id']);

if ($data == false) {
    view("not_found");
    die();
}

$term = $data->term;

$view_bag = [];
$view_bag['title'] = "Detail for $term";

view('detail', $data);
