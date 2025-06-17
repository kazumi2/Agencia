<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location:../index.php");
}else{
    if($_SESSION ['usuario']=="OK"){
        $nombreUsuario=$_SESSION ["nombreUsuario"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/muebleria/CSS/bootstrap.min.css"/>

    <title>inicio</title>
</head>
<body>
    <?php $url="http://".$_SERVER['HTTP_HOST']."/muebleria"?>
    
    </div>
<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
        <a class="nav-item nav-link active" href="<?php echo $url; ?>/administrador/inicio.php">inicio</a> 
        <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/seccion/productos.php">muebles</a>
        <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/seccion/cerrar.php">cerrar</a>
        <a class="nav-item nav-link" href="<?php echo $url; ?>">ver sitio web</a>
    </div>
</nav>
<div class="contanier">
        <div class="row">