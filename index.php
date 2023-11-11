<?php include("template/cabecera.php") ?>
<div class="row">
  <div class="rounded-3 block-info col-md-8">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">Material de programación</h1>
      <p class="col-md-8 fs-4">Descarga material gratuito y disfruta</p>
      <button class="btn btn-primary btn-lg" type="button">Example button</button>
    </div>
  </div>
  <div class="col-md-4">
    <h1 id="hora"></h1>
  </div>
</div>
<!-- 3 bloques -->

<?php
include("administrador/config/bd.php");
$sentenciaSQL = $conexion->prepare("select * from libros limit 2");
$sentenciaSQL->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>



<?php foreach ($listaLibros as $libro) { ?>
  <div class="col-md-6">
    <div class="card">
      <img class="card-img-top librosPortada" src="./img/<?php echo $libro['imagen']; ?>" alt="Title">
      <div class="card-body text-center">
        <h4 class="card-title"><?php echo $libro['nombre'] ?></h4>
        <a name="" id="" class="btn btn-primary" href="#" role="button">Ver enlace</a>
      </div>
    </div>
  </div>
<?php } ?>

<!-- tabla de contenido de material-->


<div class="table-responsive">
<br>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Autor</th>
        <th scope="col">Descripción</th>
        <th scope="col">descargar</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($listaLibros as $libro) { ?>
        <tr class="">
          <td><?php echo $libro['nombre'] ?></td>
          <td>Juanito</td>
          <td>Muy bueno</td>
          <td><a name="" id="" class="btn btn-primary" href="#" role="button">Descargar</a></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>


<!-- 2 bloque sin fondo -->
<div class="row">
  <div class="p-5 mb-4 rounded-3 block-info col-md-6">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold text-center">Material de programación</h1>
      <p class="fs-5 text-center">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
    </div>
  </div>

  <div class="p-5 mb-4 rounded-3 block-info col-md-6">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold text-center">Material de programación</h1>
      <p class="fs-5 text-center">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
    </div>
  </div>
</div>
<?php include("template/pie.php") ?>