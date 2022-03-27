<?php

require_once "app/Models/Shop.php";
require_once "setup.php";

$schemaID = $_POST['schemaID'];
$shopJSON  = $_POST['shop'];

setupSchema($schemaID);
global $connection;

$shopData = json_decode($shopJSON, true);
$shopID = $shopData["ID"];

$shopNameUnfixed = $shopData["Name"];
$shopAddressUnfixed = $shopData["Address"];

$shopName = mysqli_escape_string($connection, $shopNameUnfixed);
$shopAddress = mysqli_escape_string($connection, $shopAddressUnfixed);

$shopData["Name"] = $shopName;
$shopData["Address"] = $shopAddress;

if(Shop::hasDupShopName($connection, $shopID, $shopName))
{
    http_response_code(404);
    echo json_encode(["message" => "Магазин с такми именем уже существует!"]);
} else 
{ 
    $shop = new Shop($connection, $shopID);
    $shop->update($shopData);
    
    echo json_encode(["status" => "ok"]);
}

