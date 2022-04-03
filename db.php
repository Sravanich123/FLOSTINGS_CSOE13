<?php

$host = "ec2-18-215-96-22.compute-1.amazonaws.com";
$user = "sqykyqtzlbwqmq";
$pass = "1937619ec5940b615a2629b7dd0be21e977c75ad8e20077f2cbeae4feeab58ee";
$db = "dthb1gu3gbqsi";

$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to Server\n");

if(!$con) {
echo "Error: Unable to open database\n"; 
}
?>
