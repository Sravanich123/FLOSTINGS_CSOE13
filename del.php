<?php

 include 'db.php';
$ID= $_POST['id'];
 $query="DELETE FROM Images WHERE Item_Id=$ID";
 $result = pg_query($con, $query); 
 header('Location:index1.php');

 ?>
