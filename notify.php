<!DOCTYPE html>
<html>
<head>
    <title>Registration Status</title>
    <link rel="stylesheet" href="style/notifystyle.css">
</head>
<body>
  <div id="modal" style="display: none;">
    <div class="modal-content">
      <h2>Registration Successful</h2>
      <p>You have been successfully registered. Please click "OK" to proceed to login.</p>
      <button onclick="window.location.href='userlogin.php';">OK</button>
    </div>
  </div>

  <script>
    document.getElementById('modal').style.display = 'block';
  </script>
</body>
</html>