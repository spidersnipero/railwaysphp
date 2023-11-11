<?php
session_start();
include("head.php");
$conn = mysqli_connect("localhost:3306","root","root","railwaysystem");
if(!$conn){  
	echo "<script type='text/javascript'>alert('Database failed');</script>";
  	die('Could not connect: '.mysqli_connect_error());  
}
if (isset($_POST['submit']))
{
$name=$_POST['name'];
$mob=$_POST['mob'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$pw=$_POST['pw'];
$cpw=$_POST['cpw'];
$sql = "INSERT INTO passengers (p_name,p_contact, p_gender, email, password) VALUES ('$name', '$mob', '$gender', '$email', '$pw');";

if (mysqli_query($conn, $sql)) {
echo '<script type ="text/JavaScript">';  
echo 'alert(" Registered Successfully Proceed to Login ")';
header("location: userlogin.php");  
echo '</script>';  
//header("location: notify.php");
}



// if (mysqli_query($conn, $sql)) {
// 	$message = "You have been successfully registered";
// 	echo "<script>alert('$message');</script>";
// 	header("location: notify.php");
//   }  
else
{  
	$message = "Could not insert record"; 
}
	echo "<script type='text/javascript'>alert('$message');</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register on Indian Railways</title>
    <link rel="stylesheet" href="styles/registerstyle.css">
    <script src="validate.js"></script>
    <style type="text/css">
        /* Any additional styles can be placed here */
    </style>
</head>

<body>
    <div id="register_form" style="text-align: center; padding: 20px;">
        <h1>Enter your details:</h1>

        <form name="register" method="post" action="userregister.php" onsubmit="return validate()">
            <div>
                <label for="name" >First name:</label>
                <input name="name" type="text" placeholder="Enter your name" id="name" required><br>

                <label for="mob">Mobile Number:</label>
                <input type="text" name="mob" placeholder="Enter your mobile number" id="mob" required><br>

                <label>Gender:</label>
                <input type="radio" name="gender" value="Male" id="gender"> Male
                <input type="radio" name="gender" value="Female" id="gender"> Female<br>

                <label for="email">E-Mail ID:</label>
                <input name="email" type="text" id="email" placeholder="Enter your E-Mail ID" required><br>

                <label for="pw">Password:</label>
                <input type="password" name="pw" id="pw" required><br>

                <label for="cpw">Confirm Password:</label>
                <input type="password" name="cpw" id="cpw" required><br>

				<label class="checkbox-container">
				<input type="checkbox" name="tc" id="tc" required>
				<span>I agree to the terms</span>
				</label>
            
                <input type="submit" value="Submit" name="submit" class="button" onclick="if(!this.form.tc.checked){alert('You must agree to the terms first.');return false;}">
                <input type="reset" value="Reset" class="button">
            </div>
        </form>

       

        <p>Already have an account with us? <a href="userlogin.php">Click here to login</a></p>
    </div>
</body>

</html>




