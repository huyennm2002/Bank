<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Make Transaction</title>
</head>

<body>
 
  <?php
/*    $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "mae9AhH3", "m449n496");
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
*/


/*  function error($msg) {
  ?>
      <form method="GET" action="/src/frontend/Transactions.html">
        <div class="container">
          <span>Error: <?= $msg ?></span>
          <button class="backbtn" type="submits">Try again!</button>
        </div>
      </form>
    <?php
  } 
*/


class makeTransaction {

    /**
     * Open the database connection
     */
    public function __construct() {
        // open database connection
        $mysqli = new mysqli("mysql.eecs.ku.edu", "m449n496", "mae9AhH3", "m449n496");
    }

    /**
     * PDO instance
     * @var PDO 
     */
    private $pdo = null;

    /**
     * Transfer money between two accounts
     * @param int $from
     * @param int $to
     * @param float $amount
     * @return true on success or false on failure.
     */
    public function transfer($from, $to, $amount) {

        try {
            $this->pdo->beginTransaction();

            // get available amount of the transferer account
            $sql = 'SELECT amount FROM accounts WHERE id=:from';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array(":from" => $from));
            $availableAmount = (int) $stmt->fetchColumn();
            $stmt->closeCursor();

            if ($availableAmount < $amount) {
                echo 'Insufficient amount to transfer';
                return false;
            }
            // deduct from the transferred account
            $sql_update_from = 'UPDATE accounts
				SET amount = amount - :amount
				WHERE id = :from';
            $stmt = $this->pdo->prepare($sql_update_from);
            $stmt->execute(array(":from" => $from, ":amount" => $amount));
            $stmt->closeCursor();

            // add to the receiving account
            $sql_update_to = 'UPDATE accounts
                                SET amount = amount + :amount
                                WHERE id = :to';
            $stmt = $this->pdo->prepare($sql_update_to);
            $stmt->execute(array(":to" => $to, ":amount" => $amount));

            // commit the transaction
            $this->pdo->commit();

            echo 'The amount has been transferred successfully';

            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            die($e->getMessage());
        }
    }

    /**
     * close the database connection
     */
    public function __destruct() {
        // close the database connection
        $this->pdo = null;
    }

}


  ?>

</body>

</html>

