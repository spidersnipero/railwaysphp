<!DOCTYPE html>


<html>
<head>
<title></title>
<link rel="stylesheet" href="headstyle.css" type="text/css">
<style type="text/css">
	li {
		font-family: sans-serif;
		font-size:18px;
	}
</style>
<script src="jquery.js"></script>
        <script>
            $(document).ready(function(){
              $("#Logout").hide();
            });
            $(document).ready(function(){
                $("#user").hover(function(){
                    $("#Logout").toggle("slow");
                });
            });
        </script>
</head>
<body link="white" alink="white" vlink="white">
     <div class="container dark">
        <div class="wrapper">
          <div class="Menu">
            <ul id="navmenu">
            <li><?php  
            if(!isset($_SESSION['user_info'])){
              echo '<a HREF="index.php">Home</a>';
            }
            
            else{
              echo '<a HREF="userhome.php">Home</a>';
            }
            
            ?> 
            
            <li>
                <?php  
                if(isset($_SESSION['user_info'])){
                    echo '<a HREF="mybookings.php">My Bookings</a>';
                }
                ?>
            </li>
            <li>
                <?php  
                if(isset($_SESSION['user_info'])){
                    echo '<form method="post" action="logout.php"><button type="submit" name="logout">Logout</button></form>';
                }
                ?>
            </li>
            </ul>
          </div>
        </div>
      </div>
</body>
</html>