<?php

require_once "app/Models/Shop.php";
require_once "setup.php";

$schemaID = $_POST['schemaID'];
$shopJSON  = $_POST['shop'];

setupSchema($schemaID);

$shopData = json_decode($shopJSON, true);
$shopName = $shop["Name"];
$userID = $shop["UserID"];
$shopID = -1;

if(Shop::hasDupShopName($connection, $shopID, $shopName))
{
    http_response_code(404);
    echo json_encode(["message" => "Магазин с такми именем уже существует!"]);
} else 
{ 
    $shop = new Shop($connection);
    $shop->create($shopData);
    
    echo json_encode(["status" => "ok"]);
}

