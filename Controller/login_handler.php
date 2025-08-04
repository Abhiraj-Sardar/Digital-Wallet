<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
        echo 'hello';
        echo print_r($_POST['uname']);
        header('Location: ../View/login.html');
    ?>
</body>
</html>