<?php

include('setup.php');

//include_once "../lib/swift_required.php";

$calcTime = $_POST['calcTime'];
$schemaID = $_POST['schemaID'];

$userName  = $_POST['userName'];
$userEmail = $_POST['userEmail'];
$userPhone = $_POST['userPhone'];
$userPass  = $_POST['userPass'];

setupSchema($schemaID);

$error = "";

function doesUserExist($userName, $connection) {
    $query = "SELECT COUNT(*) AS num FROM `crop`.`__catalog43` 
              WHERE Name = '$userName'";

    $result = mysqli_query($connection, $query)
        or die(mysqli_error($connection));

    if ($row = mysqli_fetch_array($result)) {
        return $row["num"] > 0;
    } else {
        return false;
    }
}

function signup($userName, $userEmail, $userPhone, $userPass, $connection, &$error) {
    if (!doesUserExist($userName, $connection)) {
        $currentDate = date("Y-m-d");
        $query = "INSERT INTO `__catalog43` (`Name`, `Email`, `Phone`, `Password`, `DateRegistered`)
                  VALUES  ('$userName', '$userEmail', '$userPhone', '$userPass', '$currentDate')";

        $result = mysqli_query($connection, $query)
            or die(mysqli_error($connection));
        $status = "OK";
    } else {
        $status = "NOT OK";
        $error = "Пользователь с таким именем уже существует!";
    }

    return $status;
}

$status = signup($userName, $userEmail, $userPhone, $userPass, $connection, $error) ;

echo ('{"status":' . json_encode($status) . ',');
echo ('"error":' . json_encode($error) . ',');
echo ('"calcTime":' . json_encode($calcTime) . '}');
