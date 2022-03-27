<?php

require_once "setup.php";

$query = $_SERVER['PHP_SELF'];
$serverName = $_SERVER['SERVER_NAME'];

$path = pathinfo($query);
$uploadFolder = $path['dirname'];

$connection = setupSchema("incraft");

if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {

  ############ Edit settings ##############
  $UploadDirectory = 'files/'; //specify upload directory ends with / (slash)
  ##########################################
  //    $UploadDirectory = '';

  $File_Name = $_FILES['file']['name'];
  $File_Ext = substr($File_Name, strrpos($File_Name, '.')); //get file extention
  $Random_Number = rand(0, 9999999999); //Random number to be added to name.
  $NewFileName = $File_Name; //$_POST['submittalSrc'].$File_Ext;//$File_Name;//$Random_Number.$File_Ext; //new file name

  //unlink($UploadDirectory . $NewFileName);

  if (move_uploaded_file($_FILES['file']['tmp_name'], $UploadDirectory . $NewFileName)) {

    $json = array();
    $urlUnfixed = "http://" . $serverName . $uploadFolder . "/files/" . $File_Name;

    $url = mysqli_real_escape_string($connection, $urlUnfixed);
    $url_short = mysqli_real_escape_string($connection, "files/" . $File_Name);

    $json["url"] = $url;
    $json["url_short"] = $url_short;
    $json["file"] = $File_Name;

    list($width, $height, $type, $attr) = getimagesize($url_short);

    $json["width"] = $width;
    $json["height"] = $height;

    exit(json_encode($json));
    //die('Success! File Uploaded.');
  } else {
    die("error uploading File!" . $_FILES["file"]["error"]);
  }
} else {
  die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
}
