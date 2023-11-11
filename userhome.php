
<!DOCTYPE html>
<html>
<head>
	<title>Book a ticket</title>
    <link rel = "stylesheet" href="styles/userhome.css">
</head>
<body>
<?php 
session_start();
include("head.php");
?>
	<div id="booktkt">
	
	<form class = 'jform' method="post" action='mytrains.php' name="journeyform">
    
    <div><h1 align="center" id="journeytext">Choose your journey</h1><br/>
        <div>
        <h4> Start Location :</h4>
       <select id="starttrains" class = 'jinput'  name="starttrains" required>
                <option selected disabled>Select location </option>
                <option value="Ongole" >Ongole</option>
                <option value="Guntur" >Guntur</option>
                <option value="Vijayawada">Vijayawada</option>
                <option value="Tirupati" >Tirupati</option>
            </select>
        </div>
        <div>
        <h4>End Location :</h4>
        <select id="endtrains" class = 'jinput'  name="endtrains" required>
                <option selected disabled>Select location </option>
                <option value="Ongole" >Ongole</option>
                <option value="Guntur" >Guntur</option>
                <option value="Vijayawada">Vijayawada</option>
                <option value="Tirupati" >Tirupati</option>
            </select>
        </div>

        <div>
            No of seats :<input type='number'  class = 'jinput' id='seats' name='seats' />
        </div>

		<input type="submit" name="submit" id="submit" class="button" />
        </div>
	</form>
	</div>
	</body>
	</html>