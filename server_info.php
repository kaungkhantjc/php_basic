<?php

$errors = array();

function createDatabaseConnection()
{
    return new mysqli('localhost', 'root', '', 'self_update');
}


function saveInfo() {
    global $errors;
    $conn = createDatabaseConnection();

    if ($conn->connect_error) {
        array_push($errors, "database connection failed : " . $conn->connect_error);
    }

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $shouldShowInfo = mysqli_real_escape_string($conn, $_POST['shouldShowInfo']);
    $maintenanceMode = mysqli_real_escape_string($conn, $_POST['maintenanceMode']);

    if (!isset($title)) {
        array_push($errors, "Title is required");
    }
    if (!isset($message)) {
        array_push($errors, "Message is required");
    }
    if (!isset($shouldShowInfo)) {
        array_push($errors, "Show Info option is required");
    }
    if (!isset($maintenanceMode)) {
        array_push($errors, "Maintenance Mode option is required");
    }

    if (count($errors) == 0) {
        $shouldShowInfo = boolval($shouldShowInfo) ? 1 : 0;
        $maintenanceMode = boolval($maintenanceMode) ? 1 : 0;

        $sqlQuery = "UPDATE info SET title='$title', message='$message', should_show_info=$shouldShowInfo, maintenance_mode=$maintenanceMode, updated_at=current_timestamp() WHERE id=1";

        if ($conn->query($sqlQuery) === FALSE) {

            array_push($errors, $sqlQuery);
            array_push($errors, "insert data failed : " . $conn->error);
        }
        $conn->close();
    }
}

function readInfo()
{
    global $errors;
    $conn = createDatabaseConnection();

    if ($conn->connect_error) {
        array_push($errors, "database connection failed : " . $conn->connect_error);
    } else {
        $sql = "SELECT title, message, should_show_info, maintenance_mode FROM info WHERE id=1 LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row_info = $result->fetch_assoc();
            $conn->close();
            return $row_info;
        }
    }
    return false;
}

