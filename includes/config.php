<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "dbkittens";

// Create database connection
$link = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($link === false) {
    die("Connection failed: " . mysqli_connect_error());
}
?>