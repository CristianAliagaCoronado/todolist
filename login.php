<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">

    <title>Inicio de sesión</title>
</head>
<body >
    <?php
    session_start();
    if (isset($_SESSION['message_l'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type_l']?>">

        <?php
            echo $_SESSION['message_l'];
            unset($_SESSION['message_l']);
        ?>
    </div>
    <?php endif ?>
    <div class="wrap">
        <h1 class="text" style="font-size: 20px;">Para continuar, <br> por favor inicia sesión</h1>
        <div class="container">
            
            <span class="btn pointer"><i class=""></i>crear cuenta</span>

            <div class="line-wrap">
                <div class="line-1"></div>
                <span class="or">o</span>
                <div class="line-2"></div>
            </div>

            <div class="bottom-container">
                <form action="validar.php" method="POST">                
                    <input type="text" name="correo" placeholder="Dirección de Email" required>
                    <input type="password" name="contraseña" placeholder="Contraseña" required>
                    <button class="submit">Siguiente</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>