<?php
  session_start();
  ob_start();
  session_destroy();
  echo 'You have logged out';
  header('Refresh: 1; URL = ./SignIn.html');
?>