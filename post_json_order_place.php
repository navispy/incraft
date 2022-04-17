<?php

require_once "app/Models/Order.php";
require_once "setup.php";

$schemaID = $_POST['schemaID'];
$orderJSON  = $_POST['order'];

setupSchema($schemaID);
global $connection;

$orderData = json_decode($orderJSON, true);

$order = new Order($connection);
$order->create($orderData);    
echo json_encode(["status" => "ok", "order" => $order->expose()]);