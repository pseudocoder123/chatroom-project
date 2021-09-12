<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "chat_room";

// Creating the database connection
$connec = mysqli_connect($servername,$username,$password,$database);

// Checking for the connection success
if(!$connec){
    die("Failed to connect to the database due to " . mysqli_connect_error());
}

//echo "Successfully connected to the database

?>