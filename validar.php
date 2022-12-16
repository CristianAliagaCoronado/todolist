<?php
$correo=$_POST['correo'];
$contraseña=$_POST['contraseña'];
session_start();


require 'conexion.php';
$consulta=("SELECT * FROM usuario WHERE  usuario_correo='$correo' and usuario_contra='$contraseña'");
$resultado=$mysqli->query($consulta);

$filas=mysqli_num_rows($resultado);


if($filas){
  $array=mysqli_fetch_array($resultado);
  $_SESSION['correo']=$correo;
  $_SESSION['nombre']=$array[0].' '.$array[1];
    header("location: indexT.php");

}else{
    ?>
    <?php
    //include("index.html");
    $_SESSION['message_l'] = "ERROR DE AUTENTIFICACION";
    $_SESSION['msg_type_l'] = "danger";
    header('Location: login.php');
  ?>
  <!--<h1 class="bad">ERROR DE AUTENTIFICACION</h1>-->
  <?php
}
mysqli_free_result($resultado);
$mysqli->close();