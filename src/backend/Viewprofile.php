<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile</title>
</head>

<body>
  <?php
    ini_ set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $uid = $_SESSION['id'];
    $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "mae9AhH3", "m449n496");
    if($mysqli -> connect_errno){
      printf("Connection failed: %s\n", $mysqli->connect_error);
      exit();
    } else {
      session_start();
      $query = "SELECT Name, Email, Phone, Address from Customers WHERE ID = '$uid'";
      if ($result = $mysqli->query($query)) {
        while ($customer = $result->fetch_assoc()) {
          echo "<p> Name: " . $customer["Name"] . "</p>";
          echo "<p> Email:  " . $customer["Email"] . "</p>";
          echo "<p> Phone Number: " . $customer["Phone"] . "</p>";
          echo "<p> Address: " . $customer["Address"] . "</p>";
        }
      }
      $result->free();
    }
    $mysqli->close();
  ?>
</body>

</html>