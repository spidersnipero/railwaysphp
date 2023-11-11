<?php
session_start();
include("head.php");

if (isset($_POST['submit'])) {
  $conn = mysqli_connect("localhost:3306", "root", "root", "railwaysystem");

  if (!$conn) {
    echo "<script type='text/javascript'>alert('Database failed');</script>";
    die('Could not connect: ' . mysqli_connect_error());
  }

  $stloc = $_POST['starttrains'];
  $edloc = $_POST['endtrains'];
  $seats = $_POST['seats'];

  $sql = "SELECT * FROM trains WHERE s_location = ? AND e_location = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "ss", $stloc, $edloc);
  mysqli_stmt_execute($stmt);

  $sql_result = mysqli_stmt_get_result($stmt);

  echo '<center style="margin:40px;">';
  echo '<h2> Start location: '.$stloc.' ------------ End location : '.$edloc.'</h2>';
  
  if (mysqli_num_rows($sql_result) > 0) {
    echo '<style>
    .trains-table {
      border-collapse: collapse;
      width: 100%;
    }

    .trains-table th, .trains-table td {
      border: 1px solid black;
      padding: 8px;
    }

    .trains-table th {
      background-color: #ccc;
    }
    </style>';

    echo '<div class="trains-table">';
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Train Name</th>";
    echo "<th>Starting Time</th>";
    echo "<th>Ending Time</th>";
    echo "<th>Price</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($sql_result)) {
      echo "<tr>";
      echo "<td>" . $row['t_name'] . "</td>";
      echo "<td>" . $row['s_time'] . "</td>";
      echo "<td>" . $row['e_time'] . "</td>";
      echo "<td>" . $row['price'] . "</td>";
      echo "<td><form method='post' action='book_ticket.php' style='display: inline-block;'><input type='hidden' name='t_id' value='" . $row['id'] . "'><input type='hidden' name='seats' value='" . $seats . "'><input type='submit' name='book' value='Book Now'></form></td>";
      echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
  } else {
    echo '<h2>No available trains </h2>';
  }

  echo '</center>';
  mysqli_close($conn);
}
?>
