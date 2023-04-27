<?php
  session_start();
  include 'Connection.php';
  if(isset($_SESSION['loginSuccessful'])){
    $loginSuccessful = $_SESSION['loginSuccessful']; 
    if ($loginSuccessful == False){
      header('Location: SignIn.html');
      exit();
    }
  } else{
    header('Location: SignIn.html');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show Transaction</title>
  <style>
    .input {
      padding: 16px;
    }
    input {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    body {
      font-family: Verdana, sans-serif;
      font-size: 14px;
      align-items: center;
    }
    .form {
      align-items: center;
      background-color: #ffffff;
      color: black;
      line-height: 24px;
      width: 50%;
      margin: 90px auto;
      border-radius: 10px;
      padding: 15px;
      text-align: center;
    }
    button {
      background-color: #7B68EE;
      border-color: #4B0082;
      border-radius: 20px;
      border-style: solid;
      border-width: 1px;
      color: #ffffff;
      font-family: -apple-system;
      font-size: 20px;
      line-height: 30px;
      padding: 8px 16px;
      text-align: right;
    }
    button:hover {
      opacity: 0.8;
    }
    .backbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #87CEFA;
      color: #7B68EE;
    }
    .item {
        border-color: black;
        margin-top: 10px;
    }
    .container {
        margin: 'auto';
    }
  </style>
</head>
<body>
  <h1><center>Your Transactions</center></h1>
    <div class="form">
        <?php
        $uid = $_SESSION['id'];
        $query = "SELECT Transactions.* FROM Transactions, Accounts WHERE Accounts.ID = Transactions.SenderID OR Accounts.ID = Transactions.ReceiverID AND Accounts.ID = '$uid'";
        if ($result = $mysqli->query($query)) {
          echo "<div class='container'>";
          while ($transaction = $result->fetch_assoc()) {
            echo "<div class='item'>";
            echo "<p> SenderID: " . $transaction["SenderID"] . "</p>";
            echo "<p> ReceiverID: " . $transaction["ReceiverID"] . "</p>";
            echo "<p> Note: " . $transaction["Note"] . "</p>";
            echo "<p> Amount: " . $transaction["Amount"] . "</p>";
            echo "<p> TransactionDate: " . $transaction["TransactionDate"] . "</p>";
            echo "<br> <br";
            echo "</div>";
          }
          echo "</div>";
          $result->free();
        } else {
          echo "No result";
        }
        $mysqli->close();
    ?>
    </div>
</body>
</html>