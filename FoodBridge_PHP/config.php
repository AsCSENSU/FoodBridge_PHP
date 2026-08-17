<?php
date_default_timezone_set("Asia/Dhaka");

$host = "localhost";
$username = "root";
$password = "";
$database = "foodbridge_database";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>