  <?php
    session_start();
    include 'Connection.php';
    $note = $_POST['Note'];
    $amount = $_POST['Amount'];
    $transactiondate = $_POST['Date'];
    $sender_id = $_SESSION['id'];
    $receiver_id = $_POST['Receiver-id'];
   

    if($receiver_id == '' || $amount == '') {
      error("Please enter all required fields");
    } else {
      //need to add check if balance > amount
      $get_balance = "SELECT Balance FROM Customers WHERE ID = '$sender_id'";
      $query = "UPDATE Accounts SET balance = balance - $amount WHERE CustomerID = '$sender_id'";
      $create_query = "INSERT INTO Transactions (SenderID, ReceiverID, Amount, Note, TransactionDate) values ('$sender_id','$receiver_id', '$amount', '$note', NOW())";
      if ($mysqli->query($sql) && $mysqli->query($create_query)) {
        echo "<p>The amount has been transfered successfully</p>";
      } else {
        echo "<p>Error, cannot make transaction</p>";
      }
      $query = "UPDATE Accounts SET balance = balance + $amount WHERE CustomerID = '$receiver_id'"; 
      $mysqli->close();
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



