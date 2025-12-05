<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        include "../View/loader.html"; 
        $cnt=$_GET['cnt'];
        $tot=$GET['tot'];
        $uid = $_SESSION['uid'];
        require_once '../Model/db_connect.php';            
        try {
                $pdo = new PDO($attr, $user, $pass, $opts);
            //  echo "Connection successfull..";
        } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
        }   
    ?>
    <?php
                
        $crpt = "update user set crypto = crypto + '$cnt' where id like '$uid'";
        $stmt=$pdo->query($crpt);
        $crptu = $stmt->fetch();
        
    ?>
    <script>
        setTimeout(()=>{
            location.href= 'http://localhost/Digital-Wallet/View/cryptoStore.php';
        },2000);

    </script>


</body>
</html>