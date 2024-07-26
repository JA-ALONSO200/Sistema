<?php
    #incluir dependencias
    session_start();
    include "conexion_db.php";
    include "proteger.php";
    
    #Anadir Un nuevo Producto en la DB
    if (isset($_POST['guardar'])) {
        $nombre_producto = $_POST['nombre_producto'];
        $precio_producto = $_POST['precio_producto'];
        $documento_producto = $_POST['documento'];
        $serial_producto = $_POST['serial_producto'];

        $nombre_producto = limpiar_cadena($nombre_producto);
        $precio_producto = limpiar_cadena($precio_producto);
        $documento_producto = limpiar_cadena($documento_producto);
        $serial_producto = limpiar_cadena($serial_producto);
        if (isset($_FILES['txtImg'])) {
            $nombre_imagen = $_FILES['txtImg']['name'];
            $tmp = $_FILES['txtImg']['tmp_name'];
            
            $ruta_destino = '../imgs/';
            $imagen = $ruta_destino . $nombre_imagen;
            move_uploaded_file($tmp, $imagen);
        }
        
        $sql = "INSERT INTO productos(nombre_producto,serial_producto,precio,documento,img_producto) VALUES('$nombre_producto','$serial_producto','$precio_producto','$documento_producto','$imagen')";
        $INSERT = mysqli_query($conexion,$sql);
        if($INSERT){
            echo "<div class='alert alert-success' role='alert'> <center>Venta Registrada Con Exito! </center></div>";
        }
        
    }
    
    if (isset($_POST['regresar'])) {
        header("Location: inicio.php");
    }
?>
<!------ Estructura basica de la pagina de anadir producto ------->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Producto</title>
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
        .btn{
            margin-left: 190px;
            margin-top: 20px;
        }
        .btn-primary{
            margin-left: 175px;
        }
        .input-group{
            margin-top: 40px;
        }
        .input-group{
            margin-top: 40px;
        }
        .p{
            text-align: center;
        }
        .form-control{
            margin-top: 15px;
            border-color: transparent;
            border-style: solid;
            border-width: 2px;
        }
        .login-container{
            border-style: solid;
            border-width: 2px;
        }
        h2{
            margin-bottom: 70px;
            color: #437af0;
            font-size: 36px;
        }
        .alert{
            width: 400px;
            margin-left: 420px;
            margin-top: 30px;
            transition: opacity 0.5s linear; /* Transición para la opacidad */
            animation: fadeOut 5s forwards; /* Animación para desvanecer */
        }
        @keyframes fadeOut {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
        }
        .label{
            margin-top: 20px;
            margin-right: 10px;
        }
    </style>
</head>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
    <button type="submit" class="btn btn-danger" name="regresar">Regresar</button>
    </form>
    </div>
        <div class="login-container border rounded bg-light p-4 shadow-sm">
            <center><h2>Nuevo Producto</h2></center>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
    <div class="col">
    <label for="form-control">Nombre del Producto</label>
        <input type="text" class="form-control" placeholder="Nombre del Producto" name="nombre_producto" autocomplete="off" required>
    </div>
    <div class="col">
    <label for="form-control">Serial del Producto</label>
        <input type="text" class="form-control" placeholder="Serial del Producto" name="serial_producto" autocomplete="off" required>
    </div>
    <div class="input-group mb-3">
    <label for="form-control" class="label">Imagen del Producto</label>
        <input type="file" class="form-control" name="txtImg">
</div>

<div class="col">
    <label for="form-control">Precio del Producto</label>
        <input type="number" class="form-control" placeholder="Precio del Producto" name="precio_producto" autocomplete="off" required>
    </div>
    <div class="col">
    <label for="form-control">Documento de Empleado</label>
        <input type="text" class="form-control" placeholder="Documento del Empleado" name="documento" autocomplete="off" required>
    </div>
    </div>
        <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
    </form>
    </div>
</body>
</html>