<?php
  session_start();
  include 'Connection.php';
  if(isset($_SESSION['loginSuccessful'])){
    $loginSuccessful = $_SESSION['loginSuccessful']; 
    if ($loginSuccessful == False){
      //echo "<p>login failed!.</p>";
      header('Location: SignIn.html');
      exit();
    }
    else{

    $uid = $_SESSION['id'];
    // Check if the form was submitted 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      //echo "isset([newProfilePic] ".isset($_FILES['newProfilePic'])." [newProfilePic][error]".$_FILES['newProfilePic']['error']. "<br>";
      // Check if file was uploaded without errors    
      if (isset($_FILES["newProfilePic"]) && $_FILES["newProfilePic"]["error"] == 0) 
      { 
        //$file_name       = $_FILES["newProfilePic"]["name"];
        $file_type= $_FILES["newProfilePic"]["type"];
        $imgBlob = base64_encode(file_get_contents($_FILES["newProfilePic"]["tmp_name"]));
        //$imgBlob = (file_get_contents($_FILES["newProfilePic"]["tmp_name"]));
        
        //echo "<br>"."UID: " . $_SESSION['id']. " " ."file name: " . $_FILES["newProfilePic"]["name"]. " file type: " . $_FILES["newProfilePic"]["type"]. "<br>";
        //echo "<div style='text-align: center; background: #4CB974; padding: 10px; font-size: 20px; color: #fff'> ".'<img src = "data:'.$file_type.';base64,'. ($imgBlob).'" width = "100px" height = "100px"/>'."</div>";
        
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

