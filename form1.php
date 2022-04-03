<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php';
require 'vendor/autoload.php';
require 'config.php';

//$target_dir="Images/";
   
        $file_name = basename($_FILES["file"]["name"]);
        // $target_file_path = $target_dir. $file_name;
        // move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_path);

        //$cloudinary->uploadApi()->text($file_name);

        $arr= \Cloudinary\Uploader::upload($_FILES["file"]["tmp_name"], array("public_id" => $file_name ));
        
        print_r($arr['url']);

        $item_name = $_POST['item_name'];
        $location = $_POST['location'];
        $date =$_POST['date'];
        $email= $_POST['email'];
        $phone_no = $_POST['phone_no'];
        
        $query = "INSERT INTO Images (Item_Name,Place,Found_on,Image_Name,Email,Phone_No) VALUES ('$item_name', '$location','$date','$arr[url]','$email','$phone_no')";
        $result=pg_query($con, $query);
        
        //XML File creation
        $xml = new DOMDocument("1.0","UTF-8");
        $xml->load("details.xml");

        $rootTag = $xml->getElementsByTagName("Details")->item(0);

        $dataTag = $xml->createElement("data");

        $itemTag = $xml->createElement("Item",$_REQUEST['item_name']);
        $locTag = $xml->createElement("Location",$_REQUEST['location']);
        $dateTag = $xml->createElement("Date",$_REQUEST['date']);
        $emailTag = $xml->createElement("Email",$_REQUEST['email']);
        $mobTag = $xml->createElement("Phone_no",$_REQUEST['phone_no']);

        $dataTag->appendChild($itemTag);
        $dataTag->appendChild($locTag);
        $dataTag->appendChild($dateTag);
        $dataTag->appendChild($emailTag);
        $dataTag->appendChild($mobTag);

        $rootTag->appendChild($dataTag);

        $xml->save("details.xml");

        echo "<script type='text/javascript'>document.location.href='index1.php';</script>";
    
pg_close($con);
?>
