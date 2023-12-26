<?php

$title = 'PHP App';

session_start();


require_once('inc/config.php');
require_once('inc/functions.php');



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $pwd = $_POST['password'];

    if ($email == false) {
        $status = 'Please enter a valid email';
    } else {
        if (autenticate_user($email, $pwd)) {
            $_SESSION['email'] = $email;
            redirect("inc/admin.php");
            die();
        } else {
            $status = 'Email or password is wrong';
        }
    }
}

include('inc/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5"></h1>
        </div>
    </div>
    <div class="row" style="margin-top: 20px">

        <form action="" method="post">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input class="form-control" type="text" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="email">Pwd</label>
                <input class="form-control" type="text" name="password" id="password">
            </div>
            <div class="form-group">
                <input type="submit" name="login-form" value="Enviar">
            </div>
        </form>

        <div class="row">
            <?php
            if (isset($status)) {
                echo $status;
            }
            ?>
        </div>
    </div>
</div>

<?php
include('inc/footer.php');
?>