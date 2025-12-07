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
        require_once '../Model/db_connect.php';
        $uname=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
            $_SESSION['uname']=$uname;
            $_SESSION['uemail']=$email;
            $_SESSION['upass']=$password;
            $_SESSION['amt']=5000.00;
            $_SESSION['crypto']=0;

        try {
            $pdo = new PDO($attr, $user, $pass, $opts);
            // echo "Connection successfull..";
        } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }    

        $rs = "INSERT INTO user(name, email, password, amount, crypto) VALUES('$uname','$email','$password',5000.00,0)";
        $result = $pdo->query($rs);

        
        header('Location: http://localhost/Digital-Wallet/View/login.php');

    ?>
</body>
</html>