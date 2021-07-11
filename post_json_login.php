<?php

include('setup.php');

$calcTime = $_POST['calcTime'];
$schemaID = $_POST['schemaID'];

$name  = $_POST['name'];
$pass  = $_POST['pass'];

setupSchema($schemaID);

function login($name, $pass, $connection, &$error) {
    $query = "SELECT COUNT(*) AS numUsers FROM __catalog43 WHERE Name='$name' AND Password='$pass'";

    $result = mysqli_query($connection, $query)
        or die(mysqli_error($connection));

    $credentialsOK = false;

    if ($row = mysqli_fetch_array($result)) {
        $credentialsOK = $row["numUsers"] > 0;
    }

    return $credentialsOK;
}

$error = "";
$credentialsOK = login($name, $pass, $connection, $error);
$photoURL = getLookupValue("__catalog43", "Photo", "Name", $name, $connection);

echo ('{"calcTime":' . json_encode($calcTime) . ',');
echo ('"credentialsOK":' . json_encode($credentialsOK) . ',');
echo ('"photo":' . json_encode($photoURL) . '}');
