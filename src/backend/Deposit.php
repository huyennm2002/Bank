<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deposit</title>
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
    $amount= $_POST ['amount'];
    $type = $_POST['type'];
    $uid = $_SESSION['id'];
    $acc_id = $_POST['account-id'];

    $query = "UPDATE Accounts SET balance = balance + $amount WHERE ID = '$acc_id'";
    $create_query = "INSERT INTO Actions (AccountID, Amount, ActionType, ActionDate) values ('$acc_id', '$amount', 'Deposit', NOW())";
    if ($mysqli->query($sql) === TRUE && $mysqli->query($create_query)) {
      echo "<p>Your account was updated!</p>";
    } else {
      echo "<p>Error, cannot make deposit</p>";
    }
    $mysqli->close();
  ?>

</body>

</html>