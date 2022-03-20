<?php

//use App\Models\User2;
require_once "app/Models/Shop.php";
require_once "app/Models/User.php";
require_once "setup.php";

setupSchema("incraft");

$userID = $_GET["userID"];

if($userID !== "") {
    $user = new User($connection, $userID);
    echo $user;
} else {
    http_response_code(404);
    echo json_encode(["message" => "no user profile found"]);
}  
