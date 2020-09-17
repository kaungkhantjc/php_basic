<?php

session_start();

$errors = array(); // to collect errors
$panel_login_password = "admin123";

// check login
if (isset($_POST['login_user'])) {

    if (!isset($_POST['password'])) {
        array_push($errors, "Password is required to login.");
    }

    if (count($errors) == 0) {
        $password = $_POST['password'];
        if ($password === $panel_login_password) {
            $_SESSION['login_success'] = "You are now logged in";
            header('location: ../');
        } else {
            array_push($errors, "Wrong password");
        }
    }
}

