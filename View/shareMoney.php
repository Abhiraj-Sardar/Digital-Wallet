<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Css/shareMoney.css">

</head>

<body>
    <?php
        include "./navbar.php";
        require_once '../Model/db_connect.php';
        
        try {
            $pdo = new PDO($attr, $user, $pass, $opts);
            // echo "Connection successfull..";
        } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }

        $stmnt = 'SELECT * FROM user WHERE id = 1';
        $result = $pdo->query($stmnt);
        $row = $result->fetch();
        session_start();
        $_SESSION['sender_id']=$row['id'];
        // echo '<pre>';
        // print_r($row);
        // echo '</pre>';
    ?>
    
    <div class="analytic-container">
        <div class="wallet">
            <div class="left">
                <div class="img-container">
                    
                </div>
                <h1></h1>
            </div>
            <div class="right"></div>
        </div>
    </div>

    <form action='../Controller/payment_handler.php' method='post'>

    <input type='text' name='amount'/>
    <input type='text' name='id'/>
    <button type='submit'>Pay</button>
    </form>

</body>
</html>