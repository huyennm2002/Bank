<?php
    session_start();
    ob_start();
    include 'Connection.php';
    if ( !isset($_POST['email'], $_POST['password']) ) {
      exit('Please fill both the username and password fields!');
    }
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * from Customers WHERE email='$email';";
    if ($result = $mysqli->query($query)) {
      while ($entity = $result->fetch_assoc()) {
        if($entity["Password"] == $password) {
          $flag = TRUE;
          $_SESSION['loginSuccessful'] = True;
          $_SESSION['id'] = $entity["ID"];
          $_SESSION['name'] = $entity["Name"];
          if (isset($_SESSION['loginSuccessful'])) {
            echo "<p> You have successfully logged in! </p>";
            header('Location: http://eecs447prj.000webhostapp.com/Dashboard.php');
            exit;
          }
        }
      }
      $result->free();
    }
    echo "<p> Failed Authentication! </p>";
    echo "<a href='./SignIn.html'>Try again</a>";
    $mysqli->close();
?>
