<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // session_start();
        $_SESSION['name']=$_POST['name'];
        require_once '../Model/db_connect.php';
        $uid=$_POST['username'];
        $uname=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        
       

        try {
            $pdo = new PDO($attr, $user, $pass, $opts);
            // echo "Connection successfull..";
        } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }    

        $rs = "INSERT INTO user VALUES('$uid','$uname','$email','$password',2000.00,0)";
        $result = $pdo->query($rs);

        
        header('Location: http://localhost/Digital-Wallet/View/Profile.php');

    ?>
</body>
</html>