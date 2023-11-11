<?php 
session_start();
$conn = mysqli_connect("localhost:3306","root","root","railwaysystem");
if(!$conn){  
	echo "<script type='text/javascript'>alert('Database failed');</script>";
  	die('Could not connect: '.mysqli_connect_error());  
}
if (isset($_POST['submit']))
{
$trains=$_POST['trains'];
$name=$_post['name'];
$sql = "SELECT t_no FROM trains WHERE t_name = '$trains'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$name=$_SESSION['user_info'];
$query="UPDATE passengers SET t_no='$row[t_no]' WHERE p_name='$name';";
	if(mysqli_query($conn, $query))
{  
	$message = "Ticket booked successfully";
}
	else {
		$message="Transaction failed";
	}
	echo "<script type='text/javascript'>alert('$message');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Book a ticket</title>
	<LINK REL="STYLESHEET" HREF="STYLE.CSS">
	<style type="text/css">
		#booktkt	{
			margin:auto;
			margin-top: 50px;
			width: 40%;
			height: 60%;
			padding: auto;
			padding-top: 50px;
			padding-left: 50px;
			background-color: rgba(0,0,0,0.3);
			border-radius: 25px;
		}
		html { 
		  background: url(img/bg7.jpg) no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		}
		#journeytext	{
			color: white;
			font-size: 28px;
			font-family:"Comic Sans MS", cursive, sans-serif;
		}
		#trains	{
			margin-left: 90px;
			font-size: 15px;
		}
		#submit	{
			margin-left: 150px;
			margin-bottom: 40px;
			margin-top: 30px
		}
body{
			background-image: url(https://c0.wallpaperflare.com/preview/94/952/914/india-pollachi-background-nature.jpg);
			background-size: cover;
		}		
	</style>
	<script type="text/javascript">
		function validate()	{
			var trains=document.getElementById("trains");
			if(trains.selectedIndex==0)
			{
				alert("Please select your train");
				trains.focus();
				return false;		
			}
		}
	</script>
</head>
<body>
	<?php
		include ('head.php');
	?>
	<div id="booktkt">
	<h1 align="center" id="journeytext">Choose your journey</h1><br/><br/>
	<form method="post" name="journeyform" onsubmit="return validate()">
	Enter UserName:<input type="text" name="name" value="name" required><br/><br/>
		<select id="trains" name="trains" required>
			<option selected disabled>-------------------Select trains here----------------------</option>
			<option value="macherlaMEMU" >Guntur - Macherla--> MEMU</option>
			<option value="LTT" >Mumbai Centeral -  Chennai--> Express</option>
			<option value="Vandebharat">Vizag - Secundrabad--> SuperFast</option>
			<option value="rajdhani" >Mumbai - Delhi--> SuperFast</option>
			<option value="palnadu" >Secundrabad - Guntur--> Express</option>
		</select>
		<br/><br/>
		<input type="submit" name="submit" id="submit" class="button" />
	</form>
	</div>
	</body>
	</html>