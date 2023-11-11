<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>

<?php
session_start();
include("head.php"); // Assuming head.php contains your header content

if (isset($_SESSION['user_info'])) {
    $username = $_SESSION['user_info'];

    // Establish database connection
    $conn = mysqli_connect("localhost:3306", "root", "root", "railwaysystem");

    if (!$conn) {
        die('Could not connect: ' . mysqli_connect_error());
    }

    // Fetch user details from the database based on the username
    $sql = "SELECT * FROM passengers WHERE p_name = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        // Retrieve user details
        $userName = $user['p_name'];
        $userPhoneNumber = $user['p_contact'];
        $userEmail = $user['email'];
        // Password retrieval is avoided for security reasons

        // Close the database connection
        mysqli_close($conn);
?>

<h1>User Profile</h1>

<div>
    <p><strong>Name:</strong> <?php echo $userName; ?></p>
    <p><strong>Phone Number:</strong> <?php echo $userPhoneNumber; ?></p>
    <p><strong>Email:</strong> <?php echo $userEmail; ?></p>
    <a href="updateprofile.php">Edit Profile</a> <!-- This link will direct to the edit profile page -->
</div>

</body>
</html>

<?php
    } else {
        echo "Error fetching user information";
    }
} else {
    header("Location: userlogin.php"); // Redirect to login if user is not logged in
    exit();
}
?>
