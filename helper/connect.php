<?php

$host="localhost";
$user="root";
$pass="";
$db="bk";
$connect=new mysqli($host,$user,$pass,$db);
if($connect->connect_error){
    echo "Failed to connect DB".$connect->connect_error;
}
?>