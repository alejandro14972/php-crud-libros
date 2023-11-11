<?php
session_start();

if ($_POST) {
    if($_POST['usuario']=='admin' && $_POST['contraseña']='admin'){
        $_SESSION['usuario']="ok";
        $_SESSION['nombreUsuario']="admin";
        header('location:inicio.php');
    }else{
        $mensaje = "Error contraseña o usuario";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="./../css/bootstrap.css">
    <link rel="stylesheet" href="../css/admisitración/index.css">
</head>

<body>
    <div class="container show">
        <div class="row">
            
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
                <br>
                <div class="card">
                    <div class="card-header">
                        Login admin
                    </div>
                    <div class="card-body contenido-formulario">

                    <?php
                    if(isset($mensaje)){ ?>
                    <div class="alert alert-warning" role="alert">
                         <?php echo $mensaje?>
                    </div>
                    <?php }?>


                        <form method="post" action="">
                            <div class="form-group">
                                <label>User</label>
                                <input type="text" class="form-control" name='usuario' placeholder="Enter email">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name='contraseña'  placeholder="Password">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>


                    </div>

                </div>
            </div>


        </div>
    </div>


</body>

</html>