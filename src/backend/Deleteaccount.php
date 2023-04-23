<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All accounts</title>
</head>

<body>
  <?php
    $delete = $_POST['check_list'];
    $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "mae9AhH3", "m449n496");
    if($mysqli -> connect_errno){
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
    }

    if(empty($delete)){
      echo "<br>";
      echo "<div class='noti'>";
      echo "<span> No accounts were selected! </span>";
      echo "<br>";
      echo "<button><a href='DeleteAccount.html'>Delete Account</a></button>";
      echo "</div>";
    }

    else{
      foreach($delete as $id) {
        $sql = "DELETE FROM Accounts WHERE ID = '$id'";
        if ($mysqli->query($sql) === TRUE) {
          echo "<br>";
          echo "<div 'noti'>";
          echo "<span> Account with $id was deleted!</span>";
          echo "<br>";
          echo "</div>";
        }
        else {
          echo "Error deleting record: " . $mysqli->error;
        }
      }
      echo "<button><a href='DeleteAccount.html'>Delete Account</a></button>";
    }                
    
    $mysqli->close();
  ?>  
</body>
</html>