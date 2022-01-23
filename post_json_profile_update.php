<?php

require_once "app/Models/User.php";
require_once "setup.php";

$schemaID = $_POST['schemaID'];
$profileJSON  = $_POST['profile'];

setupSchema($schemaID);

$profile = json_decode($profileJSON, true);
$userID = $profile["ID"];
$userName = $profile["Name"];
$userEmail = $profile["Email"];

if (User::hasDupUserName($connection, $userID, $userName)) {
    http_response_code(404);
    echo json_encode(["message" => "Пользователь с такми именем уже существует!"]);
} else if (User::hasDupUserEmail($connection, $userID, $userEmail)) {
    http_response_code(404);
    echo json_encode(["message" => "Пользователь с такми  email уже существует!"]);
} else {
    $user = new User($connection, $userID);
    $user->update($profile);

    echo json_encode(["status" => "ok"]);
}
