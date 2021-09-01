<?php

require_once "app/Models/User.php";
require_once "setup.php";

$schemaID = $_POST['schemaID'];

$name  = $_POST['name'];
$pass  = $_POST['pass'];

setupSchema($schemaID);

$error = "";
$userID = -1;
$photo = "";

$status = User::getStatus($name, $pass, $connection);

$accountStatus = (int) $status["account"];

if($status["credentials"] && $accountStatus !== User::ACCOUNT_DELETED) 
{
    $photo = $status["photo"];
    $userID = $status["userID"];
    $data = ["userID" => $userID,
             "photo" => $photo];
    echo json_encode($data);  
} else if (!$status["credentials"])
{
    http_response_code(404);
    echo json_encode(["message" => "Неправильный логин/пароль"]);
} else if ($accountStatus === User::ACCOUNT_DELETED) 
{
    http_response_code(404);
    echo json_encode(["message" => "Ваш аккаунт удален. Обратитесь к администратору системы."]);
} 