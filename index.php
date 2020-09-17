<?php

require("server_info.php");
session_start();

if (!isset($_SESSION['login_success'])) {
    $_SESSION['message'] = "You must login first";
    header('location: login');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['login_success']);
    header("location: login");
}

if (isset($_POST['save_info'])) saveInfo();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/main.css">
</head>

<main id="main">
    <header id="header" class="w3-card-4 w3-green">
        <h3>Admin Panel</h3>
        <a class="w3-button w3-hover-opacity" href="?logout=1">
            <img style="padding: 4px" class="w3-display-right w3-margin-right w3-circle w3-pale-green"
                 src="https://img.icons8.com/android/24/000000/logout-rounded.png"
                 alt="logout" title="Logout"/>
        </a>
    </header>

    <div id="contents" class="content">
        <div class="w3-panel w3-container">

            <?php $info_row = readInfo() ?>
            <?php include('login/errors.php') ?>

            <form class="w3-panel w3-container" method="post">
                <label for="edt_title">
                    <input id="edt_title" class="w3-input" type="text" name="title" placeholder="Title"
                           value="<?php if($info_row) echo $info_row['title'] ?>"/>
                </label>

                <label for="edt_message">
                    <input id="edt_message" class="w3-input w3-section" type="text" name="message"
                           placeholder="Message"
                           value="<?php if($info_row) echo $info_row['message'] ?>"/>
                </label>

                <label for="show_info_switch">
                    <p>Show Info</p>
                    <select id="show_info_switch" class="w3-select" name="shouldShowInfo">
                        <?php if ($info_row && $info_row['should_show_info']) { ?>
                            <option value="1">On</option>
                            <option value="0">Off</option>
                        <?php } else { ?>
                            <option value="0">Off</option>
                            <option value="1">On</option>
                        <?php } ?>
                    </select>
                </label>

                <label for="maintenance_switch">
                    <p>Maintenance Mode</p>
                    <select id="maintenance_switch" class="w3-select" name="maintenanceMode">
                        <?php if ($info_row && $info_row['maintenance_mode']) { ?>
                            <option value="1">On</option>
                            <option value="0">Off</option>
                        <?php } else { ?>
                            <option value="0">Off</option>
                            <option value="1">On</option>
                        <?php } ?>
                    </select>
                </label>

                <div class="w3-center w3-margin-top">
                    <button class="w3-button w3-green w3-mobile w3-round-large" type="submit" name="save_info">
                        Save
                    </button>
                </div>
            </form>

        </div>
    </div>
</main>
</html>