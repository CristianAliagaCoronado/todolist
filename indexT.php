<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList2</title>
    <script>"https://code.jquery.com/jquery-3.3.1.slim.min.js"</script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></script>
</head>
<body background="fondo2.jpg">
    
    <?php require_once 'process.php'; ?>

    <?php

    if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php endif ?>
    <div class="container">
    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        //pre_r($result);
        ?>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tarea</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
        <?php
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td>
                        <a href="indexT.php?edit=<?php echo $row['id']; ?>"
                            class="btn btn-info">Editar</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>"
                            class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>   
            </table>
        </div>
        <?php

        function pre_r( $array ) {
            echo '<pre>';
            print_r($array);
            echo '</pre';
        }
    ?>
    <div class="row justify-content-center">
    <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Ingresa tu nombre" required>
        </div>
        <div class="form-group">
        <label>Tarea</label>
        <input type="text" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="Ingrese su tarea" required>
        </div>
        <div class="form-group">
        <?php
        if ($update == true):
        ?>
        <button type="submit" class="btn btn-info" name="update">Actualizar</button>
        <?php else: ?>   
        <button type="submit" class="btn btn-primary" name="save">Crear</button>
        <?php endif; ?>
        </div>        
    </form>
    </div>
    </div>
</body>
<div class="col-md-4 col-sm-4">
                   <div class="google-map">
<!-- How to change your own map point
      1. Go to Google Maps
      2. Click on your location point
      3. Click "Share" and choose "Embed map" tab
      4. Copy only URL and paste it within the src="" field below
-->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d197.2124047324771!2d-72.8827741876743!3d-13.63623890395675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x916d02decc4e058d%3A0xdf1b91644e72bc66!2sJr.%20Lima%2C%20Abancay%2003001!5e1!3m2!1ses!2spe!4v1628640993998!5m2!1ses!2spe" width="200" height="200" rigth="200"style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                   </div>
              </div>

         </div>
    </div>

</section>
</html>