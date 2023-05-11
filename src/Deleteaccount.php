<?php
  session_start();
  include 'Connection.php';
  $delete = $_POST['toDelete'];
  if(empty($delete)){
    echo "<br>";
    echo "<div class='noti'>";
    echo "<span> No accounts were selected! </span>";
    echo "<br>";
    echo "<button><a href='Dashboard.php'>Back to dashboard</a></button>";
    echo "</div>";
  }

  else {
    $sql = "DELETE FROM Accounts WHERE ID = '$delete'";
    if ($mysqli->query($sql) === TRUE) {
      echo "<br>";
      echo "<div 'noti'>";
      echo "<span> Account with ID $delete was deleted!</span>";
      echo "<br>";
      echo "</div>";
    }
    else {
      echo "Error deleting record: " . $mysqli->error;
    }
    echo "<button><a href='Dashboard.php'>Back to dashboard</a></button>";
  }                
  $mysqli->close();
?>