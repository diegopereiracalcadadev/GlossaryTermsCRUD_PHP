<?php

require('functions.php');

$title = "new structure index page with model";

$view_bag = [];
$view_bag['title'] = 'View bag title';


view('index', $title);
