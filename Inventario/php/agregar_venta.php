<?php
#incluir dependencias
include "conexion_db.php";
include "proteger.php";
session_start();

# Actualizar Los datos de la Cuenta del usuario
if (isset($_POST['regresar'])) {
    header('Location: ventas.php');
}
if (isset($_POST['guardar_venta'])) {
    $serial_p = $_POST['serial_p'];
    $precio_p = $_POST['precio_p'];
    $nombre_c = $_POST['nombre_c'];
    $documento_c = $_POST['documento_c'];
    $usuario = $_SESSION['username'];

    $nombre = limpiar_cadena($serial_p);
    $apellido = limpiar_cadena($precio_p);
    $documento = limpiar_cadena($nombre_c);
    $edad = limpiar_cadena($documento_c);

    $imagen = ''; // Inicializar la variable $imagen

    if (isset($_FILES['txtImg']) && $_FILES['txtImg']['error'] == 0) {
        $nombre_imagen = $_FILES['txtImg']['name'];
        $tmp = $_FILES['txtImg']['tmp_name'];

        $ruta_destino = '../imgs/';
        $imagen = $ruta_destino . $nombre_imagen;
        move_uploaded_file($tmp, $imagen);
    }

    $sql = "INSERT INTO ventas VALUES('','$serial_p','$documento_c','$nombre_c','$imagen','$precio_p')";

$resultado = mysqli_query($conexion,$sql);

    if($resultado){
        echo "<div class='alert alert-success' role='alert'> <center>Producto Guardado Exitosamente! </center></div>";
    }else{
        echo "<div class='alert alert-danger' role='alert'> <center>Producto Ya Vendido</center></div>";
    }
}
?>
<!------ Estructura Basica de la pagina de actualizar Cuenta ------->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .login-container {
            max-width: 500px;
            max-height: 500px;
            margin: 0 auto;
            padding: 15px;
            margin-top: 100px;
        }
        .btn {
            margin-left: 190px;
            margin-top: 20px;
        }
        .btn-primary {
            margin-left: 175px;
        }
        .input-group {
            margin-top: 40px;
        }
        .p {
            text-align: center;
        }
        .form-control {
            margin-top: 15px;
            border-color: transparent;
            border-style: solid;
            border-width: 2px;
        }
        .login-container {
            border-style: solid;
            border-width: 2px;
        }
        h2 {
            margin-bottom: 70px;
            color: #437af0;
            font-size: 36px;
        }
        .alert {
            width: 400px;
            margin-left: 420px;
            margin-top: 30px;
            transition: opacity 0.5s linear;
            animation: fadeOut 5s forwards;
        }
        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }
    </style>
</head>
<div class="container">
    <form action="agregar_venta.php" method="post">
        <button type="submit" class="btn btn-danger" name="regresar">Regresar</button>
    </form>
</div>
<div class="login-container border rounded bg-light p-4 shadow-sm">
    <center><h2>Agregar Venta</h2></center>
    <!------ Formulario de Actualizacion ------->
    <form action="agregar_venta.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
                <label for="form-control">Serial Del Producto</label>
                <input type="text" class="form-control" placeholder="Serial del Producto" name="serial_p" autocomplete="off">
            </div>
            <div class="col">
                <label for="form-control">Imagen Del Producto</label>
                <input type="file" class="form-control" name="txtImg">
            </div>
            <div class="form-group">
                <div class="col">
                    <label for="form-control">Precio</label>
                    <input type="text" class="form-control" placeholder="Precio del Producto" name="precio_p" autocomplete="off">
                </div>
            </div>
            <div class="col">
                <label for="form-control">Nombre del Cliente</label>
                <input type="text" class="form-control" placeholder="Nombre del Cliente" name="nombre_c" autocomplete="off">
            </div>
            <div class="col">
                <label for="form-control">Documento</label>
                <input type="text" class="form-control" placeholder="Documento del Cliente" name="documento_c" autocomplete="off">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="guardar_venta">Guardar</button>
    </form>
</div>
</body>
</html>
