<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <style>
        /* Your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #0066cc;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0050aa;
        }
    </style>
</head>
<body>

<?php
session_start();
include("head.php"); // Assuming head.php contains your header content

if (isset($_SESSION['user_info'])) {
    $username = $_SESSION['user_info'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Fetch form data
        $newName = $_POST['name'];
        $newPhone = $_POST['phone'];
        $newEmail = $_POST['email'];

        // Establish database connection
        $conn = mysqli_connect("localhost:3306", "root", "root", "railwaysystem");

        if (!$conn) {
            die('Could not connect: ' . mysqli_connect_error());
        }

        // Update user information in the database
        $updateQuery = "UPDATE passengers SET p_name = '$newName', p_contact = '$newPhone', email = '$newEmail' WHERE p_name = '$username'";
        $result = mysqli_query($conn, $updateQuery);

        if ($result) {
            echo "Profile updated successfully.";
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
} else {
    header("Location: userlogin.php");
    exit();
}
?>

<form action="updateprofile.php" method="post">
    <h1>Edit Profile</h1>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $userName; ?>">

    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone" value="<?php echo $userPhoneNumber; ?>">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $userEmail; ?>">

    <input type="submit" value="Save Changes">
</form>

</body>
</html>
