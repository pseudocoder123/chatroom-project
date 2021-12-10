<?php

// Getting the values from the post parameters
$room = $_POST['room'];

// Checking for the string size
if(strlen($room)>=10 or strlen($room)<=2){
    $message = "Please enter the room name between 2 to 10 characters";
    echo '<script language = "javascript">';
    echo 'alert(" '.$message.' ");';
    echo 'window.location = "http://localhost/chatroom_2";';
    echo '</script>';
}
// Checking if the room name is alphanumeric
else if(!ctype_alnum($room)){
    $message = "Please ensure that room name has alphanumeric characters only";
    echo '<script language = "javascript">';
    echo 'alert(" '.$message.' ");';
    echo 'window.location = "http://localhost/chatroom_2";';
    echo '</script>';
}
// Connecting to the database
else{
    include 'connect_database.php';
}

// Check if such roomname already exists or not
$sql = "SELECT * FROM `rooms` WHERE roomname = '$room'";

$result = mysqli_query($connec,$sql);

if($result)
{
    if(mysqli_num_rows($result) > 0){
        $message = "Please enter a different roomname. This room exists already";
        echo '<script language = "javascript">';
        echo 'alert(" '.$message.' " );';
        echo 'window.location = "http://localhost/chatroom_2";';
        echo '</script>';
    }
    else{
        // We should insert the roomname into our database
        $date = date_default_timezone_set('Asia/Kolkata');
        $today = date("Y-m-d  H:i:s");

        $sql = "INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room', '$today');";
        // After inserting the room, let the user know
        $result = mysqli_query($connec,$sql);
        if($result){
            $message = "Your room is ready. You can chat now";
            echo '<script language = "javascript">';
            echo 'alert(" '.$message.' ");';
            echo 'window.location = "http://localhost/chatroom_2/rooms.php?roomname='.$room.'";';
            // The site is now redirected to the above link !!
            // We have to create a new php : rooms.php
            echo '</script>';
        }
    }
}
else{
    echo "Error : " . mysqli_error($connec);
}

?>