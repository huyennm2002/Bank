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
  <title>Make Transaction</title>
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
  <h1><center>Transaction</center></h1>
  
  <form action="MakeTransaction.php" method="POST">
    <p style="font-size:150%;">To make a transaction, enter the following information:</p> 
    <div class="input">
      <label for="Receiver-id">Receiver Account ID*</label>
      <input type="text" placeholder="Enter the ID here"name="Receiver-id" value="" required>
    </div>
    <div class="input">
      <label for="Note">Message</label>
      <input type="text" placeholder="Please enter your message here"name="Note" value="" required>
    </div> 
    <div class="input">
      <label for="Amount">Amount*</label>
      <input type="text" placeholder="$"name="Amount" value="" required>
    </div>
    <div class="input">
      Choose account:
      <select name="sender-id" id="account-id">
        <?php
          $uid = $_SESSION['id'];
          $query = "SELECT * FROM Accounts WHERE CustomerID = $uid";
          if ($result = $mysqli->query($query)) {
            while ($account = $result->fetch_assoc()) {
              echo "<option value=".$account['ID'].">" . $account["AccountType"] . " - ID: ".$account['ID'] . "</option>";
            }
            $result->free();
          } else {
            echo "No result";
          }
          $mysqli->close();
        ?>
      </select>
    </div>
    <div>
      <button type="submit">Send</button>
    </div>
  </form>
</body>
</html>