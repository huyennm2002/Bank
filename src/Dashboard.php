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
    .avatar {
      vertical-align: middle;
      width: 50px;
      height: 50px;
      border-radius: 50%;
    }
    .container {
        border-style: solid;
        width: 50%;
        padding: 10px;
    }
    .account-item {
        border-style: groove;
        width: 25%;
    }
  </style>
</head>
<body>
    <img align=right src="profilePic.png" id="profilePic" alt="Profile Picture" class="avatar">
<div><center>
  <div class="input">
    <a href="Logout.php" class="backbtn">Log Out</a>
  </div>
  <h1><center>Lawrence Public Bank Dashboard</center></h1>

<div class="profile-pic">
 
<center><img src="profilePic.png" id="blankProfilePic" height="100" width="100" /><br><br>
<span>Change profile image</span>
<input type="file" name="newProfilePic" id="newProfilePic" accept="image/*" onchange="loadFile(event)"><br><br>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('blankProfilePic');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
</center></div>
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
            echo "<div class='account-item'>";
            echo "<p> Account ID: ". $account["ID"] . "</p>";
            echo "<p> Account Type: " . $account["AccountType"] . "</p>";
            echo "<p> Balance: " . $account["Balance"] . "</p>";
            echo "</div>";
          }
          echo "</div>";
          $result->free();
        } else {
          echo "No result";
        }
        $mysqli->close();
    ?>
    <br> <br>
  <p>If you would like to deposit or withdraw money, click here:</p>    
  <div>
    <a href="Action.php" class="backbtn">Action</a>
  </div><br>
    <p>If you would like to send money to someone, click here:</p> 
  <div>
    <a href="Make-Transaction.php" class="backbtn">Transaction</a>
  </div><br>

  <p>If you would like to view your Transactions, click here:</p> 
  <div>
    <a href="Show-Transaction.php" class="backbtn">Show Transaction</a>
  </div><br>
    <p>If you would like to create another account, click here:</p> 
    <form action="Createaccount.php" method="POST">
        <label for="accountType">Choose account type:</label>
        <select name="accountType" id="accountType">
            <option value="checkings">Checkings</option>
            <option value="savings">Savings</option>
        </select>
        <br/>
        <button  type="submit" class="backbtn">Create New Account</button>
    </form>
    <div>
      <button type="submit">Delete Account</button>
    </div>
</center> 
 
</body>
</html>