<?php
include('seccion/templates/cabecera.php');
?>
            <div class="col-md-12">
                <div class="p-5 mb-4 bg-light rounded-3">
                    <div class="container-fluid py-5">
                        <h1 class="display-5 fw-bold">Bienvenido <?php echo $_SESSION['nombreUsuario'] ?></h1>
                        <p class="col-md-8 fs-4">Administración de documentación.</p>
                        <a class="btn btn-primary btn-lg" type="button" href="seccion/productos.php">Mi material</a>
                    </div>
                </div>
            </div>
<?php
include('seccion/templates/pie.php');
?>