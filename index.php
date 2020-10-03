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

    <style>
        .menu {
            cursor: pointer;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            margin-top: 3px;
            position: absolute;
        }

        .slideOutLeft {
            animation-name: slideOut;
            animation-duration: .5s;
        }

        @keyframes slideOut {
            0% {
                transform: translateX(0px);
            }
            100% {
                transform: translateX(-200px);
            }
        }


    </style>
</head>

<main id="main">

    <div class="w3-sidebar w3-bar-block w3-animate-left w3-card-4 w3-hide" id="drawer">
        <div style="background-image: url('https://i.pinimg.com/originals/c2/bd/3a/c2bd3ae483f9617e6f71bc2a74b60b5a.jpg'); background-size: cover;"
             class="w3-green w3-padding-large">
            <h5>Title</h5>
            <p>abcd@gmail.com</p>
        </div>
        <a onclick="w3_close()" class="w3-bar-item w3-button">Home</a>
        <a onclick="w3_close()" class="w3-bar-item w3-button">About</a>
        <a onclick="w3_close()" class="w3-bar-item w3-button">Privacy Policy</a>
    </div>

    <header id="header" class="w3-card-4 w3-green">
        <div class="menu w3-display-container" onclick="w3_open()">
            <div id="menuIcon" class="w3-display-middle w3-xlarge w3-animate-opacity">☰</div>
        </div>
        <h3 style="margin-left: 55px">Admin Panel</h3>

        <a class="w3-button w3-hover-opacity" href="?logout=1">
            <img style="padding: 4px" class="w3-display-right w3-margin-right w3-circle w3-pale-green"
                 src="https://img.icons8.com/android/24/000000/logout-rounded.png"
                 alt="logout" title="Logout"/>
        </a>
    </header>

    <div onclick="w3_close()" id="contents" class="content">
        <div class="w3-panel w3-container">

            <?php $info_row = readInfo() ?>
            <?php include('login/errors.php') ?>

            <form class="w3-panel w3-container" method="post">
                <label for="edt_title">
                    <input id="edt_title" class="w3-input" type="text" name="title" placeholder="Title"
                           value="<?php if ($info_row) echo $info_row['title'] ?>"/>
                </label>

                <label for="edt_message">
                    <input id="edt_message" class="w3-input w3-section" type="text" name="message"
                           placeholder="Message"
                           value="<?php if ($info_row) echo $info_row['message'] ?>"/>
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

<script src="https://hammerjs.github.io/dist/hammer.js"></script>
<script>

    let drawer = document.getElementById("drawer");
    let menuIcon = document.getElementById('menuIcon');

    function w3_open() {
        if (drawer.classList.contains("w3-hide")){
            drawer.classList.remove("w3-hide");
            menuIcon.innerText = "⬅";
        } else w3_close();
    }

    function w3_close() {
        menuIcon.innerText = "☰";
        drawer.classList.remove("w3-animate-left");
        drawer.classList.add("slideOutLeft");
        setTimeout(function () {
                drawer.classList.add("w3-hide");
                drawer.classList.add("w3-animate-left");
                drawer.classList.remove("slideOutLeft");
            }, 400);
    }

    let hammer = new Hammer(drawer);
    hammer.on("panleft", function () {
        w3_close();
    });


</script>
</html>
