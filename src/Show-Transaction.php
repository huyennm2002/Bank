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
    .main {
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
    .scroll-section {
      height: 200px;
      aoverflow: auto;
    }
    .column {
      float: left;
      width: 50%;
    }
    .avatar {
      vertical-align: middle;
      width: 50px;
      height: 50px;
      border-radius: 50%;
  }

  </style>
</head>
<body>
<div>
  <center>
  <div class="input">
    <a href="Dashboard.php" class="backbtn">Back to Dashboard</a>
  </center>
</div>

<?php
  if(isset($_SESSION['profileImage']) && isset($_SESSION['imageType'])){
    echo '<img align=right src = "data:'.$_SESSION['imageType'].';base64,'.($_SESSION['profileImage']) .'" id="profilePic" alt="Profile Picture D" class="avatar"/>';
  }
  else{
    echo '<img align=right src="profilePic.png" id="profilePic" alt="Profile Picture" class="avatar">';    
  }
?>
  <h1><center>Your Transactions</center></h1>
    <div class="main">
        <div class="row">
            <div class="column">
                <div class="scroll-section">
                    <h3> Recent Transfer Transactions </h3>
                        <?php
                          $uid = $_SESSION['id'];
                          $query = "SELECT * FROM Transactions INNER JOIN Accounts ON Accounts.ID = Transactions.SenderID INNER JOIN Customers ON Accounts.CustomerID = Customers.ID WHERE Customers.ID = '$uid' ORDER BY TransactionDate DESC LIMIT 10";
                          if ($result = $mysqli->query($query)) {
                            echo "<div class='container'>";
                            while ($transaction = $result->fetch_assoc()) {
                              echo "<div class='item'>";
                              echo "<p> Sender Account ID: " . $transaction["SenderID"] . "</p>";
                              echo "<p> Receiver Account ID: " . $transaction["ReceiverID"] . "</p>";
                              echo "<p> Account type: " . $transaction["AccountType"] . "</p>";
                              echo "<p> Note: " . $transaction["Note"] . "</p>";
                              echo "<p> Amount: $" . $transaction["Amount"] . "</p>";
                              echo "<p> Transaction Date: " . $transaction["TransactionDate"] . "</p>";
                              echo "<br>";
                              echo "</div>";
                            }
                            echo "</div>";
                            $result->free();
                          } else {
                            echo "No transactions";
                          }
                        ?>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="scroll-section">
                    <h3> Recent Received Payments </h3>
                        <?php
                          $uid = $_SESSION['id'];
                          $query = "SELECT * FROM Transactions INNER JOIN Accounts ON Accounts.ID = Transactions.ReceiverID INNER JOIN Customers ON Accounts.CustomerID = Customers.ID WHERE Customers.ID = '$uid' ORDER BY TransactionDate DESC LIMIT 10";
                          if ($result = $mysqli->query($query)) {
                            echo "<div class='container'>";
                            while ($transaction = $result->fetch_assoc()) {
                              echo "<div class='item'>";
                              echo "<p> Sender Account ID: " . $transaction["SenderID"] . "</p>";
                              echo "<p> Receiver Account ID: " . $transaction["ReceiverID"] . "</p>";
                              echo "<p> Account type: " . $transaction["AccountType"] . "</p>";
                              echo "<p> Note: " . $transaction["Note"] . "</p>";
                              echo "<p> Amount: $" . $transaction["Amount"] . "</p>";
                              echo "<p> Transaction Date: " . $transaction["TransactionDate"] . "</p>";
                              echo "<br>";
                              echo "</div>";
                            }
                            echo "</div>";
                            $result->free();
                          } else {
                            echo "No transactions";
                          }
                        ?>
                    </div>
                </div>
            </div>
        </div>
      
    </div>
</body>
</html>