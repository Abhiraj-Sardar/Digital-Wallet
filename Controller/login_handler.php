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
        $uemail=$_POST['uemail'];
        $upass=$_POST['upass'];

        try {
            $pdo = new PDO($attr, $user, $pass, $opts);
            // echo "Connection successfull..";
        } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }  

        $rs = "SELECT * FROM user WHERE email LIKE '$uemail' and password LIKE '$upass'";
        $result = $pdo->query($rs);
        $row = $result->fetch();

        if($row){
            // echo "Sucessfully Logged In";
            $_SESSION['uid']=$row['id'];
            $_SESSION['uname']=$row['name'];
            $_SESSION['uemail']=$row['email'];
            $_SESSION['amt']=$row['amount'];

            header('Location: http://localhost/Digital-Wallet/View/profile.php');
            // echo $_SESSION['uid'];
        }else{
            echo "error";
        }
        
    ?>
</body>
</html>