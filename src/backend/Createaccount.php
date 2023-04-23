<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account</title>
</head>

<body>
  <?php
    ini_ set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "mae9AhH3", "m449n496");
    if ( mysqli_connect_errno() ) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
    }
    $type = $_POST['acc-type'];
    $uid = $_SESSION['id'];
    if($type == '') {
      error("Please enter all required fields");
    } else {
      if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
      } else {
          $sql = "INSERT INTO Accounts (CustomerID, AccountType, Balance) VALUES ('$uid', '$type', '0');";
          if ($mysqli->query($sql) === TRUE) {
            echo "<p>New account was successfully created</p>";
          }
        $mysqli->close();
      }
    }

    function error($msg) {
      ?>
          <form method="GET" action="/src/frontend/Createaccount.html">
            <div class="container">
              <span>Error: <?= $msg ?></span>
              <button class="backbtn" type="submit">Try again!</button>
            </div>
          </form>
        <?php
      }
  ?>
</body>

</html>