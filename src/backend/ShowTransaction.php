<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show Transaction</title>
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
      $query = "SELECT SenderID, ReceiverID, Note, Amount, TransactionDate from Customers WHERE ID = '$tid'";
      if ($result = $mysqli->query($query)) {
        while ($transaction = $result->fetch_assoc()) {
          echo "<p> SenderID: " . $transaction["SenderID"] . "</p>"; 
          echo "<p> ReceiverID: " . $transaction["ReceiverID"] . "</p>";
          echo "<p> Note: " . $transaction["Note"] . "</p>";
          echo "<p> Amount:  " . $transaction["Amount"] . "</p>";
          echo "<p> TransactionDate: " . $transaction["Transaction date"] . "</p>";
        }
        $result->free();
      }
    }
    $mysqli->close();
  ?>
</body>

</html>