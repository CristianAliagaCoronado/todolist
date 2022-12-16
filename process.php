<?php


//crud
require 'conexion.php';

$id = 0;
$update = false;
$update_et = false;
$name = '';
$eti_cont='';
$eti_id=0;
$tarea_cont = '';


if (isset($_POST['save'])){
    //$name = $_POST['name'];
    session_start();
    if($_POST['id_et']!=0){
    $id_et = $_POST['id_et'];
    $tarea_cont = $_POST['tarea_cont'];
    
    $correo= $_SESSION['correo'];
    $mysqli->query("INSERT INTO tarea (tarea_cont, tarea_correo,tarea_id_etiqueta) VALUES('$tarea_cont', '$correo',$id_et)") or die($mysqli->error);

    $_SESSION['message'] = "El registro se ha guardado!";
    $_SESSION['msg_type'] = "success"; 
    }else {
        $_SESSION['message'] = "seleccione una etiqueta existente o cree otra!";
        $_SESSION['msg_type'] = "warning";   
    }
    

    header('Location: indexT.php');
}


if (isset($_GET['delete'])){
    session_start();
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM tarea WHERE tarea_id=$id") or die($mysqli->error);

    $_SESSION['message'] = "El registro ha sido eliminado!";
    $_SESSION['msg_type'] = "danger";

    header('Location: indexT.php');
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT tarea_id,tarea_cont FROM tarea WHERE tarea_id=$id") or die($mysqli->error);
    if ($result){
        $row = $result->fetch_array();
        $name = $row['tarea_id'];
        $tarea_cont = $row['tarea_cont'];
    }
}
if (isset($_POST['update'])){
    session_start();
    $id = $_POST['id'];
    $tarea_cont = $_POST['tarea_cont'];

    $mysqli->query("UPDATE tarea SET tarea_cont='$tarea_cont' WHERE tarea_id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Se actualizó el registro!";
    $_SESSION['msg_type'] = "warning";

    header('Location: indexT.php');
}
//guardar etiqueta
if (isset($_POST['save_etiqueta'])){
    $eti_cont = $_POST['name_eti'];
    session_start();
    $correo= $_SESSION['correo'];
    $mysqli->query("INSERT INTO etiqueta (etiqueta_cont, etiqueta_correo) VALUES('$eti_cont', '$correo')") or die($mysqli->error);

    $_SESSION['message'] = "El registro se ha guardado!";
    $_SESSION['msg_type'] = "success";

    header('Location: indexT.php');
}
if (isset($_GET['delete_etiqueta'])){
    session_start();
    $id = $_GET['delete_etiqueta'];
    $mysqli->query("DELETE FROM etiqueta WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "El registro ha sido eliminado!";
    $_SESSION['msg_type'] = "danger";

    header('Location: indexT.php');
}
if (isset($_GET['edit_etiqueta'])){
    $id = $_GET['edit_etiqueta'];
    $update_et = true;
    $result_eti = $mysqli->query("SELECT id,etiqueta_cont FROM etiqueta WHERE id=$id") or die($mysqli->error);
    if ($result_eti){
        $row = $result_eti->fetch_array();
        $eti_id = $row['id'];
        $eti_cont = $row['etiqueta_cont'];
    }
}
if (isset($_POST['update_etiqueta'])){
    session_start();
    $id = $_POST['eti_id'];
    $etiqueta_cont = $_POST['name_eti'];

    $mysqli->query("UPDATE etiqueta SET etiqueta_cont='$etiqueta_cont' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Se actualizó el registro!";
    $_SESSION['msg_type'] = "warning";

    header('Location: indexT.php');
}