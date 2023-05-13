<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Profile Info</title>
</head>

<body>
  <?php
    session_start();
    include 'Connection.php';
    $name= $_POST ['name'];
    $email = $_POST['email'];
    $phone= $_POST ['phone'];
    $adress = $_POST['address'];
    $uid = $_SESSION['id'];

    if($name != "") {
      $sql = "UPDATE Customers SET Name='$name' WHERE ID=$uid";
      if ($mysqli->query($sql) === TRUE) {
        echo "<p>User's name has been updated</p>";
      } else {
        echo "<p>Error, User's name is not updated</p>";
      }
    }

    if($email != "") {
      $sql = "UPDATE Customers SET Email='$email' WHERE ID=$uid";
      if ($mysqli->query($sql) === TRUE) {
        echo "<p>User's email has been updated</p>";
      } else {
        echo "<p>Error, User's email is not updated</p>";
      }
    }
    if($phone != "") {
      $sql = "UPDATE Customers SET Phone='$phone' WHERE ID=$uid";
      if ($mysqli->query($sql) === TRUE) {
        echo "<p>User's phone has been updated</p>";
      } else {
        echo "<p>Error, User's phone is not updated</p>";
      }
    }
    if($address != "") {
      $sql = "UPDATE Customers SET Address='$address' WHERE ID=$uid";
      if ($mysqli->query($sql) === TRUE) {
        echo "<p>User's address has been updated</p>";
      } else {
        echo "<p>Error, User's address is not updated</p>";
      }
    }
    $mysqli->close();
  ?>
</body>

</html>