<?php 
session_start();
include("head.php");

$conn = mysqli_connect("localhost:3306", "root", "root", "railwaysystem");

if (!$conn) {
  echo "<script type='text/javascript'>alert('Database failed');</script>";
  die('Could not connect: ' . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (isset($_POST['accept'])) {
     // Handle the accept logic here
     $pid = $_POST['id'];
     $pt_id = $_POST['t_id'];
     // Update the status in the bookings table
     $update_sql = "UPDATE bookings SET stat = 1 WHERE id = $pid AND t_id=$pt_id";
     mysqli_query($conn, $update_sql);
   }
 }


$sql = "SELECT * FROM bookings";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$sql_result = mysqli_stmt_get_result($stmt);


echo '<center>
<h1>Admin Home</h1>
</center><br>';
echo '<table class="booked-tickets-table">';
echo '<thead>';
echo '<tr>';
echo '<th>User Id</th>';
echo '<th>Train Name</th>';
echo '<th>From</th>';
echo '<th>To</th>';
echo '<th>Status</th>';
echo '<th>Actions</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

while ($row = mysqli_fetch_assoc($sql_result)) {
  $t_id = $row['t_id'];
  $seats = $row['seats'];
  $stat = $row['stat'];
  $id = $row['id'];
  

  $sql = "SELECT * FROM trains WHERE id = $t_id ";
  $res = mysqli_query($conn, $sql);
  $train = mysqli_fetch_assoc($res);

  echo "<tr>";
  echo "<td>" . $id . "</td>";
  echo "<td>" . $train['t_name'] . "</td>";
  echo "<td>" . $train['s_location'] . "</td>";
  echo "<td>" . $train['e_location'] . "</td>";
  echo "<td>" . ($stat == 0 ? "Pending" : "Confirmed") . "</td>";
  echo '<td>';
  if ($stat == 0) {
    echo '<form method="post">';
    echo '<input type="hidden" name="id" value="' . $id . '">';
    echo '<input type="hidden" name="t_id" value="' . $t_id . '">';
    echo '<input type="submit" name="accept" value="Accept">';
    echo '</form>';
  }
  echo '</td>';
  echo "</tr>";
}

echo '</tbody>';
echo '</table>';


?>

<style>
.booked-tickets-table {
  border-collapse: collapse;
  width: 100%;
  margin: 0 auto;
}

.booked-tickets-table th, .booked-tickets-table td {
  border: 1px solid black;
  padding: 8px;
}

.booked-tickets-table th {
  background-color: #ccc;
}

.booked-tickets-table tr:nth-child(even) {
  background-color: #eee;
}
</style>
<html>
   <body>

</body>
</html>