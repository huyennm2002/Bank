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
  <title>Dashboard</title>
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
    form {
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
  </style>
</head>
<body>
<div><center>
  <div class="input">
    <a href="Logout.php" class="backbtn">Log Out</a>
  </div>
  <h1><center>Lawrence Public Bank Dashboard</center></h1>

  <div>
    <div class="input">
      Name:
      <?php
         if(isset($_SESSION['name'])){
          echo $_SESSION['name']; 
         }
        ?>
    </div>
    <?php
        $uid = $_SESSION['id'];
        $query = "SELECT * FROM Accounts WHERE CustomerID = '$uid' ORDER by ID ASC";
        if ($result = $mysqli->query($query)) {
          echo "<div class='container'>";
          while ($account = $result->fetch_assoc()) {
            echo "<p> Account Type: " . $account["AccountType"] . "</p>";
            echo "<p> Balance: " . $account["Balance"] . "</p>";
          }
          echo "</div>";
          $result->free();
        } else {
          echo "No result";
        }
        $mysqli->close();
    ?>
    <br> <br
  <p>If you would like to deposit or withdraw money, click here:</p>    
  <div>
    <a href="Action.html" class="backbtn">Action</a>
  </div><br>
  
    <p>If you would like to send money to someone, click here:</p> 
  <div>
    <a href="Transaction.html" class="backbtn">Transaction</a>
  </div><br>

  <p>If you would like to view your Transactions, click here:</p> 
  <div>
    <a href="Show-Transaction.php" class="backbtn">Show Transaction</a>
  </div><br>
    
        <p>If you would like to create another account, click here:</p> 
  <div>
   <div class="input">
  <label for="accountType">Choose account type*:</label>
  <select name="accountType" id="accountType">
    <option value="checkings">Checkings</option>
    <option value="savings">Savings</option>
  </select>
  </div><br>
  
    <div>
      <button type="submit">Create New Account</button>
    </div>

    <div>
      <button type="submit">Delete Account</button>
    </div>
</center></div>  
 
</body>
</html>
