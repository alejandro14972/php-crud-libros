<?php include('./templates/cabecera.php') ?>

<?php
//print_r($_POST);
//print_r($_FILES);

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtImage = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$txtAutor = (isset($_POST['txtAutor'])) ? $_POST['txtAutor'] : "";
$txtDescripcion = (isset($_POST['txtDescription'])) ? $_POST['txtDescription'] : "";
$txtURL = (isset($_POST['txtURL'])) ? $_POST['txtURL'] : "";
$txtArchivoPDF = (isset($_FILES['txtArchivo']['name'])) ? $_FILES['txtArchivo']['name'] : "";

$accion = (isset($_POST['action'])) ? $_POST['action'] : "";

include("../config/bd.php");

switch ($accion) {
    case 'agregar':
        $sentenciaSQL = $conexion->prepare("INSERT INTO libros (nombre, imagen, autor, descripcion, urlArchivo, archivo) VALUES 
        (:nombre, :imagen, :autor, :descripcion, :urlArchivo, :archivo);");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':autor', $txtAutor);
        $sentenciaSQL->bindParam(':descripcion', $txtDescripcion);
        $sentenciaSQL->bindParam(':urlArchivo', $txtURL); /* enlace de internet */

        /* imagen */
        $fecha = new DateTime();
        $nombreArchivo = ($txtImage = !"") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";

        $tmpImg = $_FILES['txtImagen']['tmp_name'];

        if ($tmpImg != "") {
            move_uploaded_file($tmpImg, "../../img/" . $nombreArchivo);
        }

        $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
       /*  $sentenciaSQL->execute(); */


        /* AGREGAR ARCHIVO PDF */

        $nombreArchivoPDF = ($txtArchivoPDF = !"") ? $fecha->getTimestamp() . "_" . $_FILES["txtArchivo"]["name"] : "archivo.pdf";

        $tmpArch = $_FILES['txtArchivo']['tmp_name'];

        if ($tmpArch != "") {
            move_uploaded_file($tmpArch, "../../documentosPDF/" . $nombreArchivoPDF);
        }

        $sentenciaSQL->bindParam(':archivo', $nombreArchivoPDF);
        $sentenciaSQL->execute();

      //  header("location:productos.php");
        break;

    case 'modificar':
        $sentenciaSQL = $conexion->prepare("update libros set nombre=:nombre where id=:id");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        /* controlar la modificacion de la imagen siempre que se distinto a vacio  */
        if ($txtImage != "") {
            $fecha = new DateTime();
            $nombreArchivo = ($txtImage != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg"; /* comprobar */

            $tmpImg = $_FILES['txtImagen']['tmp_name'];

            move_uploaded_file($tmpImg, "../../img/" . $nombreArchivo);

            /* buscar la imagen antigua y borrarla */

            $sentenciaSQL = $conexion->prepare("select imagen from libros where id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($libro["imagen"]) && ($libro["imagen"] != "imagen.jpg")) {
                if (file_exists("../../img/" . $libro["imagen"])) {
                    unlink("../../img/" . $libro["imagen"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("update libros set imagen=:imagen where id=:id");
            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }

        header("location:productos.php");
        break;

    case 'cancelar':
        header("location:productos.php");
        break;

    case 'seleccionar':
        $sentenciaSQL = $conexion->prepare("select * from libros where id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtNombre = $libro['nombre'];
        $txtImage = $libro['imagen'];
        break;

    case 'borrar':

        $sentenciaSQL = $conexion->prepare("select imagen from libros where id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($libro["imagen"]) && ($libro["imagen"] != "imagen.jpg")) {
            if (file_exists("../../img/" . $libro["imagen"])) {
                unlink("../../img/" . $libro["imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("delete from libros where id =:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        header("location:productos.php");
        break;
}

/* consulta para mostralos libros en la tabla */
$sentenciaSQL = $conexion->prepare("select * from libros");
$sentenciaSQL->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="col-md-5">

    <div class="card">
        <div class="card-header">
            Datos de Libros
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">ID</label>
                    <input type="text" class="form-control" id="" name='txtID' value="<?php echo $txtID ?>" placeholder="Código" required readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre libro</label>
                    <input type="text" class="form-control" id="" name='txtNombre' value="<?php echo $txtNombre ?>" placeholder="Nombre libro">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre autor</label>
                    <input type="text" class="form-control" id="" name='txtAutor' value="" placeholder="Nombre autor">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Imagen</label>
                    <br>
                    <?php
                    if ($txtImage != "") { ?>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImage; ?>" width="50" alt="">
                    <?php  } ?>
                    <input type="file" class="form-control" id="" name='txtImagen' placeholder="Enter email">
                    <br>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Descripción</label>
                    <input type="text" class="form-control" id="" name='txtDescription' value="" placeholder="Descripción + 300 carácteres">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">URL</label>
                    <input type="text" class="form-control" id="" name='txtURL' value="" placeholder="Dirección de descarga">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Archivo pdf</label>
                    <br>
                    <input type="file" class="form-control" id="" name='txtArchivo' placeholder="Enter email">
                    <br>
                </div>

                <br>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" class="btn btn-success" value="agregar" name="action" <?php echo ($accion == "seleccionar") ? "disabled" : "" ?>>Agregar</button>
                    <button type="submit" class="btn btn-warning" value="modificar" name="action" <?php echo ($accion != "seleccionar") ? "disabled" : "" ?>>Modificar</button>
                    <button type="submit" class="btn btn-info" value="cancelar" name="action" <?php echo ($accion != "seleccionar") ? "disabled" : "" ?>>Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <br>
</div>

<div class="col-md-7">
    <br>
    <table class="table table-secondary table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>AUTOR</th>
                <th>DESCRIPCIÓN</th>
                <th>IMAGEN</th>
                <th>urlArchivo</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($listaLibros as $libro) { ?>
                <tr>
                    <td><?php echo $libro['id'] ?></td>
                    <td><?php echo $libro['nombre'] ?></td>
                    <td><?php echo $libro['autor'] ?></td>
                    <td><?php echo $libro['descripcion'] ?></td>
                    <td>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $libro['imagen']; ?>" width="50" alt="">
                    </td>
                    <td><?php echo $libro['urlArchivo'] ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id'] ?>">
                            <input type="submit" name='action' value="seleccionar" class='btn-primary'>
                            <input type="submit" name='action' value="borrar" class='btn-danger'>
                            <input type="submit" name='action' value="descargar" class='btn-secondary'>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('./templates/pie.php') ?>