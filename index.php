<?php
session_start();
$_SESSION['tema']='white';
header('Location: login.php');