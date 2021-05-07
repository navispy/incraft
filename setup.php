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
    
    //$username="wordpress_user";
    //$password="51v0Eipt37609138vU843S85n";

    //$server="localhost";

    $username="root";
    $password="DellOptiplexGL5100";

    $server="localhost";
    
    $connection = mysqli_connect($server, $username, $password, $schemaID);
    if (!$connection) {
        die('Can\'t connect : ' . mysqli_error($connection));
    }

//mysqli_set_charset($connection, 'utf8');
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


function getSystemRating($userID){
    global $connection;

    $query = "SELECT Guest, avg(RatingOwner) AS rating 
              FROM crop.__catalog41_feedbacks 
              WHERE Guest=$userID
              GROUP BY Guest";

    $result = mysqli_query($connection, $query)
              or die(mysqli_error($connection));

    if($row = mysqli_fetch_array($result)){
        return $row["rating"];
    } else {
        return 0;
    }    

    return 0;
}




