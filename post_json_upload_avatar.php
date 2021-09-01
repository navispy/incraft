<?php

require_once "setup.php";

$query = $_SERVER['PHP_SELF'];
$serverName = $_SERVER['SERVER_NAME'];

$path = pathinfo($query);
$uploadFolder = $path['dirname'];

setupSchema("incraft");

if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {

    ############ Edit settings ##############
    $UploadDirectory = 'files/'; //specify upload directory ends with / (slash)
    ##########################################
    //    $UploadDirectory = '';


    /*
      Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini".
      Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit
      and set them adequately, also check "post_max_size".
     */

    //check if this is an ajax request


//    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
//        die();
//    }

    //Is file size is less than allowed size.
    //if ($_FILES["FileInput"]["size"] > 5242880) {
    //	die("File size is too big!");
    //}
    //allowed file type Server side check
    /* switch(strtolower($_FILES['FileInput']['type']))
      {
      //allowed file types
      case 'image/png':
      case 'image/gif':
      case 'image/jpeg':
      case 'image/pjpeg':
      case 'text/plain':
      case 'text/html': //html file
      case 'application/x-zip-compressed':
      case 'application/pdf':
      case 'application/msword':
      case 'application/vnd.ms-excel':
      case 'video/mp4':
      break;
      default:
      die('Unsupported File!'); //output error
      } */

    $File_Name = $_FILES['file']['name'];
    $File_Ext = substr($File_Name, strrpos($File_Name, '.')); //get file extention
    $Random_Number = rand(0, 9999999999); //Random number to be added to name.
    $NewFileName = $File_Name; //$_POST['submittalSrc'].$File_Ext;//$File_Name;//$Random_Number.$File_Ext; //new file name

    //unlink($UploadDirectory . $NewFileName);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $UploadDirectory . $NewFileName)) {

        
        //add database link to the uploaded file 
        /* $logoClientID = $_POST['logoClientID'];
          $logoNum = $_POST['logoNum'];

          $sql=mysqli_query($connection, "UPDATE Dim_Clients
          SET Logo$logoNum = 'uploads/$NewFileName' WHERE ID = '$logoClientID'")
          or die(mysqli_error($connection)); */
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
