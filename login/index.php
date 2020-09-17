<?php
require("server.php");

if (isset($_SESSION['login_success'])) {
    header('location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../css/main.css">
</head>

<main id="main">
    <header id="header" class="w3-card-4 w3-green">
        <h3>Login</h3>
    </header>

    <div id="contents" class="content">

        <?php include('errors.php')?>

        <form class="w3-panel w3-container" method="post">
            <label for="edt_password">
                <input id="edt_password" class="w3-input" type="password" name="password" placeholder="password"/>
            </label>

            <div class="w3-center w3-margin-top">
                <button class="w3-button w3-green w3-mobile w3-round-large" type="submit" name="login_user">Login
                </button>
            </div>

        </form>
    </div>
</main>
</html>