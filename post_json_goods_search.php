<?php

include 'setup.php';

$filtersJSON = $_POST['filters'];
$filters = json_decode($filtersJSON, true);

$schemaID = $_POST['schemaID'];

logMessage("log/debug-1.txt", json_encode($filetrs));

setupSchema($schemaID);

function getGoods($connection, $filters)
{

    $filter = "";
    $delim = "";

    foreach ($filters as $field => $data) {
        $value1 = $data["value1"];
        $value2 = $data["value2"];
        $operator = $data["operator"];

        if($operator == "BETWEEN") {
            $filter .= "$delim $field BETWEEN $value1 AND $value2";
        } else if ($operator == "EQUAL") {
            $filter .= "$delim $field = '$value1'";
        }

        $delim = " AND ";
    }

    $goods = [];

    $filterFixed = trim($filter) == "" ? "" : "WHERE $filter"; 
    $query = "SELECT * FROM __catalog46 $filterFixed";
    $result = mysqli_query($connection, $query)
    or die(mysqli_error($connection));

    while ($row = mysqli_fetch_array($result)) {
        $goods[] = $row;
    }

    return $goods;
}

$goods = getGoods($connection, $filters);

echo ('{"goods":' . json_encode($goods, true) . '}');
