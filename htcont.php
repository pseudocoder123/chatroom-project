<?php

// Displaying the messages

$room = $_POST['room'];

// Connecting to the db
include 'connect_database.php';

$sql = "SELECT msg , stime , ip FROM msgs WHERE room = '$room' " ;

$res = "";
$result = mysqli_query($connec,$sql);

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))  // We will fetch the data from the corresponding room from the db
    {
        $res = $res . '<div class= "container">';
        $res = $res . $row['ip'];
        $res = $res . " says <p>". $row['msg'];
        $res = $res . '</p> <span class="time-right">' . $row['stime'] . '</span></div>';
    }
}

echo $res;

?>