<?php

require_once "app/Models/Shop.php";
require_once "setup.php";

$schemaID = $_POST['schemaID'];
$shopJSON  = $_POST['shop'];

setupSchema($schemaID);

$shop = json_decode($shopJSON, true);
$userID = $profile["ID"];
$userName = $profile["Name"];
$userEmail = $profile["Email"];

if(USER::hasDupUserName($connection, $userID, $userName))
{
    http_response_code(404);
    echo json_encode(["message" => "Пользователь с такми именем уже существует!"]);
} else if(USER::hasDupUserEmail($connection, $userID, $userEmail))
{
    http_response_code(404);
    echo json_encode(["message" => "Пользователь с такми  email уже существует!"]);
} else 
{ 
    $user = new User($connection, $userID);
    $user->update($profile);
    
    echo json_encode(["status" => "ok"]);
}

