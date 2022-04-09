<?php

include 'setup.php';
include 'app/Models/Shop.php';


$schemaID = $_POST['schemaID'];

setupSchema($schemaID);

function getGoods($connection, $filters)
{
    $query = "SELECT * FROM __catalog46 ORDER BY ID DESC LIMIT 9";
    $result = mysqli_query($connection, $query)
    or die(mysqli_error($connection));

    while ($row = mysqli_fetch_array($result)) {
        $shopID = $row["Shop"];
        $shopName = Shop::getShopName($connection, $shopID);
        $shopPhone = Shop::getShopPhone($connection, $shopID);
        $row["ShopName"] = $shopName;
        $row["ShopPhone"] = $shopPhone;
        $goods[] = $row;
    }

    return $goods;
}

$goods = getGoods($connection, $filters);

echo ('{"goods":' . json_encode($goods, true) . '}');
