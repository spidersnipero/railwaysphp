<?php
session_start();
include("head.php");

$conn = mysqli_connect("localhost:3306", "root", "root", "railwaysystem");

if (!$conn) {
  echo "<script type='text/javascript'>alert('Database failed');</script>";
  die('Could not connect: ' . mysqli_connect_error());
}

$u_id = $_SESSION['id'];

$sql = "SELECT * FROM bookings WHERE id = $u_id";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$sql_result = mysqli_stmt_get_result($stmt);

echo '<table class="booked-tickets-table">';
echo '<thead>';
echo '<tr>';
echo '<th>Train Name</th>';
echo '<th>From</th>';
echo '<th>To</th>';
echo '<th>Status</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

while ($row = mysqli_fetch_assoc($sql_result)) {
  $t_id = $row['t_id'];
  $seats = $row['seats'];
  $stat = $row['stat'];

  $sql = "SELECT * FROM trains WHERE id = $t_id ";
  $res = mysqli_query($conn, $sql);
  $train = mysqli_fetch_assoc($res);

  echo "<tr>";
  echo "<td>" . $train['t_name'] . "</td>";
  echo "<td>" . $train['s_location'] . "</td>";
  echo "<td>" . $train['e_location'] . "</td>";
  echo "<td>" . ($stat == 0 ? "Pending" : "Confirmed") . "</td>";
  echo "</tr>";
}

echo '</tbody>';
echo '</table>';

mysqli_close($conn);

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
