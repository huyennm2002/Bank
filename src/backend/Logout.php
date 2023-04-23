<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
</head>

<body>
    <?php
        session_start();
        session_destroy();
        echo 'You have logged out';
        header('URL ./Login.html');
    ?>
</body>

</html>