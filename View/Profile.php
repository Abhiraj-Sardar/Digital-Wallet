<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include 'navbar.php';
        require_once '../Model/db_connect.php';
        try {
            $pdo = new PDO($attr, $user, $pass, $opts);
            echo "Connection successfull..";
        } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }


        $stmnt = 'SELECT * FROM user';

        $result = $pdo->query($stmnt);

        while ($row = $result->fetch()) {
        echo '<pre>';
        print_r($row);
        echo '</pre>';
    }
    ?>
</body>
</html>