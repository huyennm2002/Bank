<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create New User</title>
</head>

<body>
  <?php
    $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "mae9AhH3", "m449n496");
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pw = $_POST['password'];
    $phone = $_POST['phone'];
    $ssn = $_POST['ssn'];
    $address = $_POST['address'];
    if($name == '' || $email == ''|| $pw == '' || $ssn == '') {
      error("Please enter all required fields");
    } else{
      if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
      } else{
        $sql = "INSERT INTO USERS (NAME, EMAIL, PASSWORD, SSN, ADDRESS, PHONE) VALUES ('$name', '$email', '$pw', '$ssn', '$address', '$phone');";
        if ($mysqli->query($sql) === TRUE) {
          echo "<p>User was successfully created</p>";
        }
      $mysqli->close();
    }
	}

  function error($msg) {
  ?>
      <form method="GET" action="/src/frontend/Signup.html">
        <div class="container">
          <span>Error: <?= $msg ?></span>
          <button class="backbtn" type="submits">Try again!</button>
        </div>
      </form>
    <?php
  }
  ?>

</body>

</html>