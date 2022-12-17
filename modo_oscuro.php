<?php
session_start();
if($_SESSION['tema']=='white'){
    $_SESSION['tema']='oscuro';
}else{
    $_SESSION['tema']='white';
}
header('Location: indexT.php');
