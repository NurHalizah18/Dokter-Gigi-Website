<?php
$host       = "localhost";
$username   = "root";
$password   = "";
$database   = "db_pasien";

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
    die("<script> alert('Connection failed')</script>");
}

?>