<?php
  session_start();
  include 'Connection.php';
  $type = $_POST['accountType'];
  $uid = isset($_SESSION['id']) ? $_SESSION['id'] : null;
  if($type == '') {
    echo "Please enter all required fields";
  } else {
      $sql = "INSERT INTO Accounts (CustomerID, AccountType, Balance) VALUES ('$uid', '$type', '0');";
      if ($mysqli->query($sql) === TRUE) {
        header("Location: Dashboard.php");
        exit();
      }
    $mysqli->close();
  }
?>