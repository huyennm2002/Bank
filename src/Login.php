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

        $_SESSION['profileImage'] = $entity["profileImage"];
        $_SESSION['imageType'] = $entity["imageType"];

        if($_SESSION['imageType'] == null ) {

          $file_info = new finfo(FILEINFO_MIME_TYPE);
          $_SESSION['profileImage'] = base64_encode(file_get_contents("profilePic.png" ));
          $_SESSION['imageType'] = $file_info->buffer(file_get_contents("profilePic.png" ));
        }


        if (isset($_SESSION['loginSuccessful'])) {
          echo "<p> You have successfully logged in! </p>";
          header('Location: ./Dashboard.php');
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