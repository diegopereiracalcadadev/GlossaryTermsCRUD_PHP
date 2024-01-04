<?php

session_start();
require('../app/app.php');

ensure_user_is_authenticated();


$view_bag['title'] = 'Admin';
$view_bag['heading'] = 'Admin List';

view('admin/index', get_terms());
