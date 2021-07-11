<?php

include('setup.php');

include_once "lib/swift_required.php";

$calcTime = $_POST['calcTime'];
$schemaID = $_POST['schemaID'];

$email  = $_POST['email']; //name or email
$name = $email;

setupSchema($schemaID);

$error = "";
$userExists = doesUserExist($email, $connection);
$emailExists = doesEmailExist($email, $connection);
$passwordCanBeRestored = $userExists || $emailExists;

$emailFixed = "";
$nameFixed = "";
$pass = "";

if($userExists) {
    //get email for a given user
    $emailFixed = getLookupValue("__catalog43", "Email", "Name", $name, $connection);
    $nameFixed = $name;
} else if($emailExists){
    $emailFixed = $email;
    $nameFixed = getLookupValue("__catalog43", "Name", "Email", $email, $connection);
} else {
    $error = "Пользователя с таким именем или Email не существует";
}

$pass = "";
if($passwordCanBeRestored) {
    $pass = getLookupValue("__catalog43", "PAssword", "Name", $nameFixed, $connection);
}

echo ('{"calcTime":' . json_encode($calcTime) . ',');
echo ('"status":' . json_encode($passwordCanBeRestored) . ',');
echo ('"name":' . json_encode($nameFixed) . ',');
echo ('"email":' . json_encode($emailFixed) . ',');
echo ('"pass":' . json_encode($pass) . ',');
echo ('"error":' . json_encode($error) . '}');
