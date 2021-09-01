<?php


error_reporting(E_ERROR | E_PARSE);

//include_once('error_reporting.php');

//require_once('fpdf/fpdf.php');
//require_once('fpdi/fpdi.php');
//require_once('PDF_MC_Table.php');

$connection = null;

/////////////////////////////////////////////////////////////////////////////////////
function setupSchema($schemaID) {
    global $connection;

    $username="root";
    $password="DellGL#5100";

    $server="localhost";
    
    $connection = mysqli_connect($server, $username, $password, $schemaID);
    if (!$connection) {
        die('Can\'t connect');
    }

}

function logMessage($logfile, $msg) {
    if (!$f = @fopen($logfile, 'a+'))
        return false;
    //fwrite($f, $msg['date'] . '#' . str_replace("\n", '##N##', serialize($msg)));
    fwrite($f, $msg . "\r\n");
    fclose($f);
    return true;
}

function getLookupValue($lookupTable, $lookupField, $field, $value, $connection) {
    $query = "SELECT $lookupField FROM $lookupTable WHERE $field = '$value'";

    $result = mysqli_query($connection, $query)
            or die(mysqli_error($connection) . " query: " . $query);
    if ($row = mysqli_fetch_array($result)) {
        return $row[$lookupField];
    } else
        return '';
}

function HTML2text($html, $crlf) {
    $text = preg_replace("/<\/p>/iU", $crlf, $html);
    $text = preg_replace("/<br.*>/iU", $crlf, $text);
    $text = str_replace(" ", " ", $text);
    $text = htmlspecialchars_decode($text);
    $text = strip_tags($text);
    if ($text == "")
        $text = " ";
    return $text;
}

function getParams($connection) {
    $query = "SELECT ID, Name, Value FROM __catalog44";
    $result = mysqli_query($connection, $query)
        or die(mysqli_error($connection));
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $params[$row['Name']] = trim($row['Value']);

        $i++;
    }
    return $params;
}

function doesUserExist($userName, $connection) {
    $query = "SELECT COUNT(*) AS num FROM `__catalog43` 
              WHERE LOWER(Name) = LOWER('$userName')";

    $result = mysqli_query($connection, $query)
        or die(mysqli_error($connection));

    if ($row = mysqli_fetch_array($result)) {
        return $row["num"] > 0;
    } else {
        return false;
    }
}

function doesEmailExist($email, $connection) {
    $query = "SELECT COUNT(*) AS num FROM `__catalog43` 
              WHERE LOWER(Email) = LOWER('$email')";

    $result = mysqli_query($connection, $query)
        or die(mysqli_error($connection));

    if ($row = mysqli_fetch_array($result)) {
        return $row["num"] > 0;
    } else {
        return false;
    }
}

