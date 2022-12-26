<?php
session_start();


if (!isset($_SESSION['correo'])) {
    header('Location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList2</title>
    <link rel="stylesheet" href="estilo.css">

    <script>
        "https://code.jquery.com/jquery-3.3.1.slim.min.js"
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></script>
    <?php
    if($_SESSION['tema']=='oscuro'){
        echo '<link rel="stylesheet" href="oscuro.css">';
    }
    ?>
    
</head>

<body background="fondo2.jpg">

    <?php require 'process.php';
    //conexion bd
    require 'conexion.php'; ?>

    <?php

    if (isset($_SESSION['message'])) : ?>

        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">

            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>

    <div class="container" >
        <?php
        require 'conexion.php';
        $correo = $_SESSION['correo'];
        
        if(isset($_GET['selec_id_eti'])){
            $_SESSION['selec_id_eti']=$_GET['selec_id_eti'];
        }
        if(!isset($_GET['selec_id_eti'])&&!isset($_SESSION['selec_id_eti'])){
           // $selec_id_eti=$_GET['selec_id_eti'];
            $_SESSION['selec_id_eti']=0;
        }
        echo $_SESSION['selec_id_eti'];
        $selec_id_eti= $_SESSION['selec_id_eti'];
        $result = $mysqli->query("SELECT tarea_id,tarea_cont FROM tarea where tarea_correo='$correo'and tarea_id_etiqueta=$selec_id_eti") or die($mysqli->error);
        $result_eti=$mysqli->query("SELECT id,etiqueta_cont FROM etiqueta where etiqueta_correo='$correo'") or die($mysqli->error);
        //pre_r($result);
        ?>
        <a href="cerrar_session.php" class="btn btn-danger float-right">cerrar sesion</a>
        <a href="modo_oscuro.php" class="oscuro btn btn-primary float-right">tema</a>
        <p><b>
                <div class="bottom-container"><?php echo $_SESSION['nombre']; ?></div>
            </b></p>
        <div class="row  ">

            <!--etiqueta-->
            <div class=" bordeos d-flex flex-column flex-shrink-0 p-3 " style="width: 280px;" >
                <div class="row justify-content-center">
                    <form action="process.php" method="POST">
                        <input type="hidden" name="eti_id" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label>Etiqueta</label>
                            <input type="text" name="name_eti" class="form-control" value="<?php echo $eti_cont; ?>" placeholder="Etiqueta" required>
                        </div>
                        <div class="form-group">
                            <?php
                            if ($update_et == true) :
                            ?>
                                <button type="submit" class="btn btn-info" name="update_etiqueta">Actualizar</button>
                            <?php else : ?>
                                <button type="submit" class="btn btn-primary" name="save_etiqueta">Crear</button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <?php
                    //etiueta lista
                    while ($row = $result_eti->fetch_assoc()):
                    ?>
                    <li class="nav-item">

                        <div class="row">
                            <div>
                                <a href="indexT.php?selec_id_eti=<?php echo $row['id']; ?>" class="nav-link link-dark border" aria-current="page">
                               <?php echo $row['etiqueta_cont'];?></a>
                            </div>
                            <div>
                                <a href="indexT.php?edit_etiqueta=<?php echo $row['id']; ?>" class="btn btn-info">Editar</a>

                            </div>
                            <div>
                                <a href="process.php?delete_etiqueta=<?php echo $row['id']; ?>" class="btn btn-danger">Eliminar</a>

                            </div>
                        </div>
                       
                    </li>
                    <?php endwhile ;?>
                    
                </ul>
                <hr>
            </div>
            <!--fin etiqueta-->
            <div class="b-example-divider"></div>

            <div class="justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tarea</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['tarea_id']; ?></td>
                            <td><?php echo $row['tarea_cont']; ?></td>
                            <td>
                                <a href="indexT.php?edit=<?php echo $row['tarea_id']; ?>" class="btn btn-info">Editar</a>
                                <a href="process.php?delete=<?php echo $row['tarea_id']; ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <?php

            function pre_r($array)
            {
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
            ?>
            <br>
            <br>
            <div class="b-example-divider"></div>
            <div class="cotenedor_form">

                <div class="row justify-content-right">
                    <form action="process.php" method="POST">
                        <!--id_tarea-->
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <!--id_etiqueta-->
                        <input type="hidden" name="id_et" value="<?php echo $selec_id_eti; ?>">
                        
                    
                    <div class="form-group">
                        <label>Tarea</label>
                        <input type="text" name="tarea_cont" class="form-control" value="<?php echo $tarea_cont; ?>" placeholder="Ingrese su tarea" required>
                    </div>
                    <div class="form-group">
                        <?php
                        if ($update == true) :
                            ?>
                            <button type="submit" class="btn btn-info" name="update">Actualizar</button>
                            <?php else : ?>
                                <button type="submit" class="btn btn-primary" name="save">Crear</button>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
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
    </div>
</div>

</div>
</div>

</section>

</html>