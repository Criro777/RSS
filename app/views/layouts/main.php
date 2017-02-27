<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MAIN</title>
        <link rel="stylesheet" type="text/css" href="/public/css/main.css"/>
        <link href="/public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/public/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

        <![endif]-->
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
    

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="/public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/public/js/main.js"></script>
    </body>
</html>