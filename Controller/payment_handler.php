<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
        
        require_once '../Model/db_connect.php';
        session_start();
        $sender_id=$_SESSION['sender_id'];
        $amount=$_POST['amount'];
        $receiver_id=$_POST['userId'];

        try {
            $pdo = new PDO($attr, $user, $pass, $opts);
            // echo "Connection successfull..";
        } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }    
        
        // credit money to receiver
        $rs = "UPDATE User SET amount = amount + '$amount' where id LIKE '$receiver_id'";
        $result1 = $pdo->query($rs);
        $row1 = $result1->fetch();

        // debiting money from sender
        $ss = "UPDATE User SET amount = amount - '$amount' WHERE id LIKE '$sender_id'";
        $result2 = $pdo->query($ss);
        $row2 = $result2->fetch();

        // echo '<pre>';
        // print_r($row2);
        // echo '</pre>';

        echo 'Payment is Done Successfully';
    ?>
</body>
</html>