<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <?php include "../View/loader.html"; 
    ?>

<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const paramValue = urlParams.get('src');

    console.log(paramValue);

    setTimeout(() => {
        renderPage();
    }, 2000);

    function renderPage(){
        if(paramValue=='profile'){
            location.href='http://localhost/Digital-Wallet/View/profile.php';
        }
        if(paramValue=='transactions'){
            location.href='http://localhost/Digital-Wallet/View/transactions.php';
        }
        else if(paramValue=='shareMoney'){
            location.href='http://localhost/Digital-Wallet/View/shareMoney.php';
        }else if(paramValue=='crypto'){
            location.href='http://localhost/Digital-Wallet/View/cryptoStore.php';
        }
        else{
            location.href='http://localhost/Digital-Wallet/View/Profile.php';
        }
    }
    


</script>

</body>
</html>