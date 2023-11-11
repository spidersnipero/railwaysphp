<?php
session_start(); // Start the session

if(isset($_POST['book'])) {
    $conn = mysqli_connect("localhost:3306", "root", "root", "railwaysystem");

    if (!$conn) {
        echo "<script type='text/javascript'>alert('Database failed');</script>";
        die('Could not connect: ' . mysqli_connect_error());
    }

   

    $t_id = $_POST['t_id'];
    $seats = $_POST['seats'];
    $stat = 0;
    $u_id = $_SESSION['id'];
    $sql = "INSERT INTO bookings (id,t_id,seats,stat) VALUES ('$u_id', '$t_id', '$seats','$stat');";
    if(mysqli_query($conn, $sql))
    {  
        header("Location: mybookings.php"); // Redirect to the desired page after logout
    exit;
        
    }

}
?>