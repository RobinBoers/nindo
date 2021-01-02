<?php

$dbServerName = "localhost"; //servername here
$dbUserName = "root"; // user to use for login
$dbPassword = ""; // password to use (leave empty for no password)
$dbName = "users"; // database name
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

// Debug messages
if($conn->connect_error) {
    die("Connection failed " . $conn->connect_error);
} 
else {
    echo("<script>console.log('Connected.');</script>");
    mysqli_select_db ($conn,$dbName);
}
?>
