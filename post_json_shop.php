<?php

include 'setup.php';
include 'app/Models/Shop.php';

$ID = $_POST['ID'];

$schemaID = $_POST['schemaID'];

setupSchema($schemaID);

global $connection;
$shop = new Shop($connection, $ID);

echo ('{"shop":' . $shop->__toString() . '}');
