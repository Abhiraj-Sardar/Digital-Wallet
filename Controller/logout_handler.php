<?php
    session_start();
    session_destroy();
    header('Location: http://localhost/Digital-Wallet/View/index.php');
?>