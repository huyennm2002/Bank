<?php
  session_start();
  include 'Connection.php';
  if(isset($_SESSION['loginSuccessful'])){
    $loginSuccessful = $_SESSION['loginSuccessful']; 
    if ($loginSuccessful == False){
      header('Location: SignIn.html');
      exit();
    }
    else{

    $uid = $_SESSION['id'];
    // Check if the form was submitted 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Check if file was uploaded without errors
      if (isset($_FILES["newProfilePic"]) && $_FILES["newProfilePic"]["error"] == 0) 
      { 
        $file_type= $_FILES["newProfilePic"]["type"];
        $imgBlob = base64_encode(file_get_contents($_FILES["newProfilePic"]["tmp_name"]));
        
        $query = "UPDATE Customers SET imageType = '$file_type',profileImage = '$imgBlob' WHERE ID = '$uid'"; 
        if ($mysqli->query($query) === TRUE ) {
          $_SESSION['profileImage'] = $imgBlob;
          $_SESSION['imageType'] = $file_type;

          header("Location: Dashboard.php");
          exit();
        } else {
          echo "<p>Error, cannot update profile picture!.</p>";
        }
        $mysqli->close();   
      } 
      else{
        header("Location: Dashboard.php");
        exit();
      }
    }
    header("Location: Dashboard.php");
    exit();
  }
}
?>
