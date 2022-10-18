<?php
$correo=$_POST['correo'];
$contraseña=$_POST['contraseña'];
session_start();
$_SESSION['correo']=$correo;


$conexion=mysqli_connect("localhost", "root", "", "registro");

$consulta=("SELECT * FROM usuario WHERE  correo='$correo' and contraseña='$contraseña'");
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
  
    header("location: indexT.php");

}else{
    ?>
    <?php
    include("index.html");

  ?>
  <h1 class="bad">ERROR DE AUTENTIFICACION</h1>
  <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);