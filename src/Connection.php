<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    global $mysqli;
    //$mysqli = new mysqli("localhost", "id20660139_huyen", "Minhhuyen1235*", "id20660139_eecs447prj");
    //$mysqli = new mysqli("localhost", "manomay", "Password*1", "BankDB");
    $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "mae9AhH3", "m449n496");

    if ( mysqli_connect_errno() ) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
    }
?>