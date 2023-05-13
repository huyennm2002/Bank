<?php
    session_start();
    include 'Connection.php';
    $note = $_POST['Note'];
    $amount = $_POST['Amount'];
    $sender_id = $_POST['sender-id'];
    $receiver_id = $_POST['Receiver-id'];
   
    if($receiver_id == '' || $amount == '') {
      echo "Please enter all required fields";
    } else {
      //remove amount from sender
      $query = "UPDATE Accounts SET balance = balance - $amount WHERE ID = '$sender_id'";
      if ($mysqli->query($query) != TRUE) {
        echo "<p>Error, cannot make transaction</p>";
      }
      //add amount to receiver
      $query = "UPDATE Accounts SET balance = balance + $amount WHERE ID = '$sender_id'";
      if ($mysqli->query($query) != TRUE) {
        echo "<p>Error, cannot make transaction</p>";
      }
      $create_query = "INSERT INTO Transactions (SenderID, ReceiverID, Amount, Note, TransactionDate) values ('$sender_id','$receiver_id', '$amount', '$note', NOW())";
      if ($mysqli->query($create_query)) {
        echo "<p>The amount has been transfered successfully</p>";
        echo "<a href='./Show-Transaction.php'>See all transactions</a>";
      } else {
        echo "<p>Error, cannot make transaction</p>";
      }
      $mysqli->close();
    }
?>