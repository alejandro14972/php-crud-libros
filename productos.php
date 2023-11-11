<?php include("template/cabecera.php") ?>

<?php 
include("administrador/config/bd.php"); /* incrustar archivo de la bd para recuperar los libros */


$sentenciaSQL = $conexion->prepare("select * from libros");
$sentenciaSQL->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<?php  foreach($listaLibros as $libro) { ?>

<div class="col-md-3">
    <div class="card">
        <img class="card-img-top librosPortada" src="./img/<?php echo $libro['imagen'];?>" alt="Title">
        <div class="card-body text-center">
            <h4 class="card-title"><?php echo $libro['nombre'] ?></h4>
            <a name="" id="" class="btn btn-primary" href="#" role="button">Ver enlace</a>
        </div>
    </div>
</div>

<?php } ?>

<?php include("template/pie.php") ?>