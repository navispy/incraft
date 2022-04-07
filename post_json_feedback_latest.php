<?php

include 'setup.php';
include 'app/Models/Good.php';

$schemaID = $_POST['schemaID'];

setupSchema($schemaID);

function getFeedback($connection, $filters)
{
    $query = "SELECT * FROM __catalog46_feedback ORDER BY Date DESC LIMIT 10";
    $result = mysqli_query($connection, $query)
        or die(mysqli_error($connection));

    $feedback = [];
    $goods = [];
    while ($row = mysqli_fetch_array($result)) {
        $goodID = $row["__catalog46ID"];
        $good = new Good($connection, $goodID);

        $feedback[] = $row;
        $goods[] = $good->getFixedObj();
    }

    return [$feedback, $goods];
}

[$feedback, $goods] = getFeedback($connection, $filters);

echo ('{"feedback":' . json_encode($feedback, true) . ',
        "goods":' . json_encode($goods, true) . '}');
