<?php

// Connecting to the database
include 'connect_database.php';

$msg = $_POST['text'];
$room = $_POST['room'];
$ip = $_POST['ip'];

$date = date_default_timezone_set('Asia/Kolkata');
$today = date("Y-m-d  H:i:s");

$sql = "INSERT INTO `msgs`(`msg`,`room`,`ip`,`stime`) VALUES ('$msg','$room','$ip', '$today');";

mysqli_query($connec,$sql);

mysqli_close($connec);

?>