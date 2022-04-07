<?php

include 'setup.php';
include 'app/Models/Shop.php';

$schemaID = $_POST['schemaID'];

setupSchema($schemaID);

function getGoods($connection, $filters)
{
    $goods = [];
    $query = "SELECT * FROM __catalog46 LIMIT 10";
    $result = mysqli_query($connection, $query)
    or die(mysqli_error($connection));

    while ($row = mysqli_fetch_array($result)) {
        $shopID = $row["Shop"];
        $shopName =Shop::getShopName($connection, $shopID);
        $row["ShopName"] = $shopName;
        $goods[] = $row;
    }

    return $goods;
}

$goods = getGoods($connection, $filters);

echo ('{"goods":' . json_encode($goods, true) . '}');
