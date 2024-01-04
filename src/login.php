<?php

session_start();
require('app/app.php');

$view_bag['title'] = 'Login';

if (is_user_authenticated()) {
    redirect('admin/');
    die();
}

if (is_post()) {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = sanitize($_POST['password']); // TODO: validate this!

    if (authenticate_user($email, $password)) {
        $_SESSION['email'] = $email;
        redirect('admin/');
        die();
    } else {
        $view_bag['status'] = "The provided crendentials didn't not work";
    }

    if ($email == false) {
        $view_bag['status'] = 'Please enter a valid email address';
    }
}


view('login');
