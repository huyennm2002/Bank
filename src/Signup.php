<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create New User</title>
</head>

<body>
  <?php
    include 'Connection.php';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pw = $_POST['password'];
    $phone = $_POST['phone'];
    $ssn = $_POST['ssn'];
    $address = $_POST['address'];
    $acc_type = $_POST['accountType'];
    if($name == '' || $email == ''|| $pw == '' || $ssn == '') {
      error("Please enter all required fields");
    } else {
      $sql = "INSERT INTO Customers (Name, Email, Password, SSN, ADDRESS, Phone) VALUES ('$name', '$email', '$pw', '$ssn', '$address', '$phone');";
      if ($mysqli->query($sql) === TRUE) {
        echo "<p>User was successfully created</p>";

        //create user bank account
        $get_uid_query = "SELECT ID FROM Customers WHERE email = '$email'";
        $result = $mysqli->query($get_uid_query);
        while ($uids = $result->fetch_assoc()) {
          foreach ($uids as $uid) {
            $create_acc_query = "INSERT INTO Accounts (CustomerID, AccountType, Balance) VALUES ('$uid', '$acc_type', '0');";
            if ($mysqli->query($create_acc_query) === TRUE) {
              echo "<p>" .$acc_type. "account successfully created</p>";
              
            } else {
              echo "<p>" .$acc_type. "account cannot be created</p>";
            }
          }
        }
        signInBtn();
        $mysqli->close();
      } else {
        error("An error has occurred");
      }
    }

  function error($msg) {
  ?>
      <form method="GET" action="SignUp.html">
        <div class="container">
          <span>Error: <?= $msg ?></span>
          <button class="backbtn" type="submits">Try again!</button>
        </div>
      </form>
    <?php
  }

  function signInBtn() {
  ?>
      <form method="GET" action="SignIn.html">
        <div class="container">
          <button class="backbtn" type="submits">Sign In</button>
        </div>
      </form>
    <?php
  }
  ?>

</body>

</html>