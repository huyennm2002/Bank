<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Make Transaction</title>
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
    $note = $_POST['Note'];
    $amount = $_POST['Amount'];
    $transactiondate = $_POST['Date'];
    $sender_id = $_SESSION['Sender-id'];
    $receiver_id = $_SESSION['Receiver-id']; 
    $acc_id = $_POST['account-id'];
   

    if($note == '' || $amount == ''|| $transactiondate == '') {
      error("Please enter all required fields");
    } else{
      if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
      } else{
      $query = $mysqli -> prepare("SELECT amount(*) FROM Users WHERE id = '$acc_id'");
      $query = "UPDATE Accounts SET balance = balance - $amount WHERE ID = '$sender_id'";
      $create_query = "INSERT INTO Actions (AccountID, Amount, Note, TransactionDate) values ('$sender_id', '$amount', '$note', '$transactiondate','Transaction', NOW())";
      if ($mysqli->query($sql) === TRUE && $mysqli->query($create_query)) {
        echo "<p>The amount has been transfered successfully</p>";
      } else {
        echo "<p>Error, cannot make transaction</p>";
      }
      $query = "UPDATE Accounts SET balance = balance + $amount WHERE ID = '$receiver_id'"; 
      $create_query = "INSERT INTO Actions (AccountID, Amount, Note, TransactionDate) values ('$receiver_id', '$amount', '$note', '$transactiondate','Transaction', NOW())";
      $mysqli->close();
    }
  }

  function error($msg) {
  ?>
        <form method="GET" action="/src/frontend/Transaction.html">
          <div class="container">
            <span>Error: <?= $msg ?></span>
            <button class="backbtn" type="submits">Try again!</button>
          </div>
        </form>
      <?php
    } 
  ?>

<?php

?>

</body>

</html>


