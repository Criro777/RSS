<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MAIN</title>
        <link href="/public/font-awesome/css/font-awesome.min.css"  type="text/css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/public/css/main.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
    </head>
    <body>

    <div class="container">

        <h3>Система обработки RSS-ленты NASA</h3>
        <?php if (!isset($_SESSION['user'])): ?>
        <div style="margin-left: 96%;"><b><a class ="back" href="/user/login">Войти</a></b></div>
        <?php else: ?>
            <div style="margin-left: 80%;"><b>Привет, <i style="color: #398439;"><?php echo $_SESSION['user'];?></i></b><a class ="back" href ="/user/logout"> (Выход)</a></div>
        <?php endif; ?>
        <hr>
        
        <?=$content?>

        <footer><hr><p style="text-align: center;">2017@ All Rights Reserved</p></footer>
    </div>
    

        <script type="text/javascript" src="/public/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="/public/js/validator.min.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/public/js/main.js"></script>
    </body>
</html>