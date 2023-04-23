<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
</head>

<body>
  <?php
    ini_ set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
      session_start();
      $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "mae9AhH3", "m449n496");
      if ( mysqli_connect_errno() ) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
      }
      if ( !isset($_POST['username'], $_POST['password']) ) {
        exit('Please fill both the username and password fields!');
      }
    $query = "SELECT ID, email, password from Customer ORDER by ID ASC";
    $loggedIn = FALSE;
    if ($result = $mysqli->query($query)) {
      while ($entity = $result->fetch_assoc()) {
        if($entity["email"] == $_POST['email'] and $entity["PASSWORD"] == $_POST['password'])
        {
          $flag = TRUE;
          $_SESSION['loggedin'] = TRUE;
          $_SESSION['id'] = $entity["ID"];
          header('Location: ../home.php');
          exit;
        }
      }
      if(!$loggedIn)
      {
        $_SESSION['loggedin'] = FALSE;   
        echo "<p> You have incorrectly ! </p>";
      }
      $result->free();
    }
    echo "<a href="">Try again</a>";
    $mysqli->close();
  ?>

</body>

</html>