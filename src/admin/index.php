<?php

require('../app/app.php');


$view_bag['title'] = 'Admin';
$view_bag['heading'] = 'Admin List';

view('admin/index', get_terms());
