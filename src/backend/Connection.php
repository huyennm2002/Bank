<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    global $mysqli;
    $mysqli = new mysqli("localhost", "id20660139_huyen", "Minhhuyen1235*", "id20660139_eecs447prj");
    if ( mysqli_connect_errno() ) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
    }
?>