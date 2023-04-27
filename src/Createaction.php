<?php
    session_start();
    include 'Connection.php';
    $type = $_POST['typeAction'];
    $amount= $_POST ['amount'];
    $uid = $_SESSION['id'];
    $date = $_POST ['amount'];
    $acc_id = $_POST['account-id'];
    $query;
    if ($type === "deposit") {
        $query = "UPDATE Accounts SET balance = balance + $amount WHERE ID = '$acc_id'";    
    }
    else {
        $query = "UPDATE Accounts SET balance = balance - $amount WHERE ID = '$acc_id'";
    }
    
    $create_query = "INSERT INTO Actions (AccountID, Amount, ActionType, ActionDate) values ('$acc_id', '$amount', 'Withdraw', NOW())";
    if ($mysqli->query($query) === TRUE && $mysqli->query($create_query)) {
      header("Location: Dashboard.php");
      exit();
    } else {
      echo "<p>Error, cannot make deposit</p>";
    }
    $mysqli->close();
  ?>