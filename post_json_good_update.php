<?php

require_once "app/Models/Good.php";
require_once "setup.php";

$schemaID = $_POST['schemaID'];
$shopID  = $_POST['shop'];
$goodJSON  = $_POST['good'];

setupSchema($schemaID);
global $connection;

$goodData = json_decode($goodJSON, true);

$good = new Good($connection);
//$goodData["Shop"] = $shopID;
$good->update($goodData);

echo json_encode(["status" => "ok", "good" => $good->expose()]);

