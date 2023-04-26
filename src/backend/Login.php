<?php
    session_start();
    include 'Connection.php';
    ob_start();
    if ( !isset($_POST['email'], $_POST['password']) ) {
      exit('Please fill both the username and password fields!');
    }
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT ID, Password from Customers WHERE email='$email';";
    if ($result = $mysqli->query($query)) {
      while ($entity = $result->fetch_assoc()) {
        if($entity["Password"] == $password) {
          $flag = TRUE;
          $_SESSION['loginSuccessful'] = True;
          $_SESSION['id'] = $entity["ID"];
          echo "<p> You have successfully logged in! </p>";
            header('Location: http://eecs447prj.000webhostapp.com/Dashboard.html');
          exit;
        }
      }
      $result->free();
    }
    echo "<p> Failed Authentication! </p>";
    echo "<a href='./SignIn.html'>Try again</a>";
    $mysqli->close();
?>
