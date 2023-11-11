<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location:../index.php");/* redirigir al login */
}else{
    if($_SESSION['usuario']="ok"){
        $nombreUsuario=$_SESSION["nombreUsuario"];
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="./../css/bootstrap.css" rel="stylesheet">
    <link href="./../../css/bootstrap.css" rel="stylesheet">
</head>

<?php
$url = "http://" . $_SERVER['HTTP_HOST'] . "/sitioWebPHP";
?>

<body>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#" aria-current="page">Administración del sitio web</a>
            <a class="nav-item nav-link" href="<?php echo $url ?>/administrador/inicio.php">Inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url ?>/administrador/seccion/productos.php">Libros admin</a>
            <a class="nav-item nav-link" href="<?php echo $url ?>/administrador/seccion/cerrar.php">Cerrar sesion</a>
            <a class="nav-item nav-link" href="<?php echo $url ?>">ver sitio web</a>
        </div>
    </nav>
    <div class="container">
        <br>
        <div class="row">