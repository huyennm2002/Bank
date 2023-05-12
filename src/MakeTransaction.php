  <?php
    session_start();
    include 'Connection.php';
    $note = $_POST['Note'];
    $amount = $_POST['Amount'];
    $sender_AId = $_POST['sender-id'];
    $transactiondate = $_POST['Date'];
    $sender_id = $_SESSION['id'];
    $receiver_id = $_POST['Receiver-id'];
      
    //SELECT A.ID FROM Customers C INNER JOIN Accounts A ON C.ID=A.CustomerID  WHERE C.ID = 2 order by A.AccountType LIMIT 1
    if($receiver_id == '' || $amount == '') {
      error("Please enter all required fields");
    } else {
      //need to add check if balance > amount
      $query = "SELECT A.ID FROM Customers C INNER JOIN Accounts A ON C.ID=A.CustomerID  WHERE C.ID = '$receiver_id' order by A.AccountType LIMIT 1";
      if ($result = $mysqli->query($query)) {
        $accountType = $result->fetch_assoc();
        $receiver_AId = $accountType['ID'];
      } else {
        echo "<p>Error, cannot make transaction</p>";
      }
      //echo "receiver_id ".$receiver_id." sender_id ".$sender_id." sender_AId ".$sender_AId." receiver_AId ".$receiver_AId."<br>";

      //remove amount from sender
      $query = "UPDATE Accounts SET balance = balance - $amount WHERE ID = '$sender_AId'";
      if ($mysqli->query($query) != TRUE) {
        echo "<p>Error, cannot make transaction</p>";
      }
      //add amount to receiver
      $query = "UPDATE Accounts SET balance = balance + $amount WHERE ID = '$receiver_AId'";
      if ($mysqli->query($query) != TRUE) {
        echo "<p>Error, cannot make transaction</p>";
      }
      //$query = "UPDATE Accounts SET balance = balance - $amount WHERE CustomerID = '$sender_id'";
      $create_query = "INSERT INTO Transactions (SenderID, ReceiverID, Amount, Note, TransactionDate) values ('$sender_id','$receiver_id', '$amount', '$note', NOW())";
      if ($mysqli->query($create_query)) {
        echo "<p>The amount has been transfered successfully</p>";
      } else {
        echo "<p>Error, cannot make transaction</p>";
      }
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



