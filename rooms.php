<?php

// Get the parameter
$roomname = $_GET['roomname'];

// Now connect to the database
include 'connect_database.php';

$sql = "SELECT * FROM `rooms` WHERE roomname = '$roomname'";
$result = mysqli_query($connec,$sql);

if($result)
{
    if(mysqli_num_rows($result) == 0){
        $message = "This room doesn't exist. Try creating a new room";
        echo '<script language = "javascript">';
        echo 'alert(" '.$message.' ");';
        echo 'window.location = "http://localhost/chatroom_2";';
        echo '</script>';
    }
}
else{
    echo "Error : " . mysqli_error();
}

?>

 <!-- Else we create the chat environment -->

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
<style>
html{
    background-color : #f1f1f1;
}
html,body{
    height : 100%;
}
html{
  background-color : grey;
  background-image : url("https://newmediaservices.com.au/wp-content/uploads/2019/03/Chat.png");
  /* background-repeat : no-repeat; */
  background-size: 55% 100%;
}
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 8px;
  margin: 8px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}
.time-right {
  float: right;
  color: #aaa;
}

h2{
    font-size : 24px;
}

.time-left {
  float: left;
  color: #999;
}

.anyClass{
  height : 500px;
  overflow-y : auto;
}
</style>
</head>

<body>
<header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">MyChat&nbsp;&nbsp;</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link active" aria-current="page" href="http://localhost/chatroom_2">Home</a>
      </nav>
    </div>
  </header>
<h2><?php echo ": " . $roomname; ?></h2>

<div class="container">
  <div class="anyClass">
  </div>
</div>

<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add the message"><br>
<button class="btn btn-default" name="submitmsg" id="submitmsg">Send</button>


<!-- Placed at the end so that pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<!-- Linking the jQuery from jquery cdn (minified 3.3.1 version) -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<!-- Any msg sent should be stored inside the msgs table of chatroom db  -->
<script type="text/javascript">

// check for new messages every 1 sec
setInterval(runFunction, 1000);
	function runFunction()
	{
		$.post("htcont.php", {room: '<?php echo $roomname; ?>'},
			function(data, status)
			{
				document.getElementsByClassName('anyClass')[0].innerHTML = data;  
			}
		)
  }

	// Enter key for submit
  var input = document.getElementById("usermsg");
  input.addEventListener("keyup", function(event) {
  event.preventDefault();
  if (event.keyCode === 13) {
    document.getElementById("submitmsg").click();
  }

  $('.anyClass').animate({scrollTop:2000000},"slow");

});

  //If user submit the form
	$("#submitmsg").click(function(){
		var clientmsg = $("#usermsg").val();
    if(/\S/.test(clientmsg)){
    $.post("postmsg.php", {text: clientmsg, room:'<?php echo $roomname; ?>', ip: '<?php echo $_SERVER['REMOTE_ADDR']; ?>'},
		function(data, status){
		document.getElementsByClassName('anyClass')[0].innerHTML = data;});
    $("#usermsg").val("");  // makes the message to disappear after sent
		return false;
    }
  }); 
  
</script>

</body>
</html>