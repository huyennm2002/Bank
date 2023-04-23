<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All accounts</title>
</head>

<body>
  <?php
    ini_ set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "mae9AhH3", "m449n496");
    if ( mysqli_connect_errno() ) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
    }
    $uid = $_SESSION['id'];

    $query = "SELECT * FROM Accounts WHERE CustomerID = '$uid' ORDER by ID ASC";
    if ($result = $mysqli->query($query)) {
      echo "<div class='container'>";
      while ($account = $result->fetch_assoc()) {
        echo "<p> Account Type: " . $account["AccountType"] . "</p>";
        echo "<p> Balance: " . $account["Balance"] . "</p>";
      }
      echo "</div>";
      $result->free();
    } else {
      echo "No result";
    }
    $mysqli->close();
  ?>
</body>

</html>