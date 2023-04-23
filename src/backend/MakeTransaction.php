<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Make Transaction</title>
</head>

<body>
  <?php
    $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "mae9AhH3", "m449n496");
    $note = $_POST['Note'];
    $amount = $_POST['Amount'];
    $transactiondate = $_POST['Date'];

    if($note == '' || $amount == ''|| $transactiondate == '') {
      error("Please enter all required fields");
    } else{
      if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
      } else{
        $sql = "INSERT INTO TRANSACTIONS (Note, Amount, TransactionDate) VALUES ('$note', '$amount', '$transactiondate');";
        if ($mysqli->query($sql) === TRUE) {
          echo "<p>Transaction was successfully created</p>";
        }
      $mysqli->close();
    }
	}

  function error($msg) {
  ?>
      <form method="GET" action="/src/frontend/Transactions.html">
        <div class="container">
          <span>Error: <?= $msg ?></span>
          <button class="backbtn" type="submits">Try again!</button>
        </div>
      </form>
    <?php
  }
  ?>

</body>

</html>