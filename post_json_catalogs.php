<?php

include('setup.php');

$calcTime = $_POST['calcTime'];
$schemaID = $_POST['schemaID'];

setupSchema($schemaID);

function getRegions($connection){
    
    $regions = [];
    $query = "SELECT * FROM __catalog1 ORDER BY region ASC";
    $result = mysqli_query($connection, $query)
              or die(mysqli_error($connection));

    while($row = mysqli_fetch_array($result)){
        $regions[] = $row;
    } 

    return $regions;
}

function getDistricts($regions, $connection) {
    $districts = [];
    foreach($regions as $region){
        $key = $region["region"];
        $districts[$key] = getRegionDistricts($region["region"], $connection);
    }
    return $districts;
}

function getRegionDistricts($region, $connection){
    $districts = [];
    $query = "SELECT * FROM __catalog2 WHERE region ='$region' ORDER BY district";


    $result = mysqli_query($connection, $query)
              or die(mysqli_error($connection));

    while($row = mysqli_fetch_array($result)){
        $districts[] = $row;
    } 

    return $districts;
}

function getCatalogValues($connection, $catalogTable, $orderField){
    $recs = [];
    $query = "SELECT * FROM $catalogTable ORDER BY $orderField ASC";
    $result = mysqli_query($connection, $query)
              or die(mysqli_error($connection));

    while($row = mysqli_fetch_array($result)){
        $recs[] = $row;
    } 

    return $recs;
}


$regions = getCatalogValues($connection, "__catalog1", "region");
$districts = getDistricts($regions, $connection);
$materials = getCatalogValues($connection, "__catalog41", "Name");
$scope = getCatalogValues($connection, "__catalog42", "Name");

echo('{"calcTime":' . json_encode($calcTime) . ',');
echo('"regions":' . json_encode($regions, true) . ',');
echo('"districts":' . json_encode($districts, true) . ',');
echo('"materials":' . json_encode($materials, true) . ',');
echo('"scope":' . json_encode($scope, true) . '}');
