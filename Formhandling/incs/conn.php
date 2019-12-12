<?php
$server ="localhost";
$DBUsername = "root";
$DBPassword = "";
$DBName = "form";

$conn = mysqli_connect($server, $DBUsername, $DBPassword,$DBName);
if(!$conn){
    die("connection failed". mysqli_connect_error());
}