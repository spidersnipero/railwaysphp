<?php
session_start();
include("head.php");

if (isset($_POST['submit'])) {
    $conn = mysqli_connect("localhost:3306", "root", "root", "railwaysystem");

    if (!$conn) {
        echo "<script type='text/javascript'>alert('Database failed');</script>";
        die('Could not connect: ' . mysqli_connect_error());
    }

    $name = $_POST['name'];
    $pw = $_POST['pw'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM passengers WHERE p_name = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $name, $pw);
    mysqli_stmt_execute($stmt);

    $sql_result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($sql_result);

    if (!empty($user)) {
        $_SESSION['user_info'] = $user['p_name'];
		$_SESSION['id'] = $user['passenger_id'];
        $message = 'Logged in successfully';
        header("location: userhome.php");
        exit();
    } else {
        $message = 'Wrong name or password.';
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    mysqli_close($conn);
}
?>




<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel = "stylesheet" href="styles/style.css"/> 
</head>
<script type="text/javascript">
	function validate()	{
		var EmailId=document.getElementById("name");
		var pw=document.getElementById("pw");
   		if(pw.value.length< 8)
		{
			alert("Password consists of atleast 8 characters");
			pw.focus();
			return false;
		}
		return true;
	}
</script>
<style type="text/css">
	#loginarea{
		background-color: rgba(0,0,0,0.2);
		width: 30%;
		margin: auto;
		border-radius: 25px;
		border: 2px grey;
		margin-top: 100px;
		background-color: rgba(0,0,0,0.3);
	    box-shadow: inset -2px -2px rgba(0,0,0,0.5);
	    padding: 50px;
	    font-family:sans-serif;
		font-size: 20px;
		color: black;
	}
	#submit	{
		border-radius: 5px;
		background-color: rgba(0,0,0,0);
		padding: 7px 7px 7px 7px;
		box-shadow: inset -1px -1px rgba(0,0,0,0.5);
		font-family:"Comic Sans MS", cursive, sans-serif;
		font-size: 17px;
		margin:auto;
		margin-top: 20px;
  		display:block;
  		color: rgba(0,0,0,1.4);
	}
	#logintext	{
		text-align: center;
	}
	.data	{
		color: white;
	}
</style>
<body>
	<?php 
     ?>
	<div id="loginarea">
	<form id="login" action="userlogin.php" onsubmit="return validate()" method="post" name="login">
		<h2 id="logintext">User Login!</h2><br/><br/>
		<div style='display:flex; margin:20px;'>
			<h4 class="data">Enter name ID:</h4>
			<input type="text" id="name" size="30" maxlength="30" name="name"/>
		</div>
		<div style='display:flex; margin:20px;'>
			<h4 class="data">Enter Password:</h4>
			<input type="password" id="pw" size="30" maxlength="30" name="pw"/>
		</div>
		
		<INPUT TYPE="Submit" value="Submit" name="submit" id="submit" class="button"><br>
    <center>
    <a href=userregister.php>Signup!</a>
    </center>
	</form></div>
</body>
</html>