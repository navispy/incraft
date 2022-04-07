<?php

include 'setup.php';
include 'app/Models/Shop.php';

$schemaID = $_POST['schemaID'];

setupSchema($schemaID);

function getShops($connection, $filters)
{
    $shops = [];

    $query = "SELECT * FROM __catalog45 LIMIT 10";
    $result = mysqli_query($connection, $query)
    or die(mysqli_error($connection));

    while ($row = mysqli_fetch_array($result)) {
        $shops[] = $row;
    }

    return $shops;
}

$shops = getShops($connection, $filters);

echo ('{"shops":' . json_encode($shops, true) . '}');
