<?php

require_once "app/Models/Shop.php";
require_once "setup.php";

$schemaID = $_POST['schemaID'];
$shopJSON  = $_POST['shop'];

setupSchema($schemaID);
global $connection;

$shopData = json_decode($shopJSON, true);
$shopName = $shopData["Name"];
$userID = $shopData["UserID"];

$shopNameUnfixed = $shopData["Name"];
$deliveryOption_04_AddressUnfixed = $shopData["DeliveryOption_04_Address"];


$shopName = mysqli_escape_string($connection, $shopNameUnfixed);
$deliveryOption_04_Address = mysqli_escape_string($connection, $deliveryOption_04_AddressUnfixed);

$shopData["Name"] = $shopName;
$shopData["DeliveryOption_04_Address"] = $deliveryOption_04_Address;

if (Shop::hasUserDupShopName($connection, $userID, $shopName)) {
    http_response_code(404);
    echo json_encode(["message" => "Магазин с такми именем уже существует!"]);
} else {
    $shop = new Shop($connection);
    $shop->create($shopData);    
    echo json_encode(["status" => "ok", "shop" => $shop->expose()]);
}
