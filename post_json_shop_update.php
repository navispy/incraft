<?php

require_once "app/Models/Shop.php";
require_once "setup.php";

$schemaID = $_POST['schemaID'];
$shopJSON  = $_POST['shop'];

setupSchema($schemaID);

$shopData = json_decode($shopJSON, true);
$shopID = $shop["ID"];
$shopName = $shop["Name"];

if(Shop::hasDupShopName($connection, $ahopID, $ahopName))
{
    http_response_code(404);
    echo json_encode(["message" => "Магазин с такми именем уже существует!"]);
} else 
{ 
    $shop = new Shop($connection, $shopID);
    $shop->update($shopData);
    
    echo json_encode(["status" => "ok"]);
}

