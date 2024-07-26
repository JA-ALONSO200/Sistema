<?php
#incluir dependencias
include "conexion_db.php";
include "proteger.php";
session_start();

    # Actualizar Los datos de la Cuenta del usuario
    if(isset($_POST['regresar'])){
        header('Location: inicio.php');
    }
    if(isset($_POST['guardar'])){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $tipo_documento = $_POST['tipo_documento'];
        $documento = $_POST['documento'];
        $edad = $_POST['edad'];
        $usuario = $_SESSION['username'];

        $nombre = limpiar_cadena($nombre);
        $apellido = limpiar_cadena($apellido);
        $edad = limpiar_cadena($edad);
        $documento = limpiar_cadena($documento);

        $sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', tipo_documento = '$tipo_documento', documento = '$documento', edad = '$edad' WHERE usuario = '$usuario'";
        if($_POST['nombre'] == "" || $_POST['apellido'] == "" || $_POST['tipo_documento'] == "" || $_POST['documento'] == "" || $_POST['edad'] == ""){
            echo "<div class='alert alert-danger' role='alert'> <center>Por favor Ingrese los Datos Del Usuario Validos</center></div>";

        }else if($_POST['nombre'] != "" || $_POST['apellido'] != "" || $_POST['tipo_documento'] != "" || $_POST['documento'] != "" || $_POST['edad'] != ""){
            echo "<div class='alert alert-success' role='alert'> <center>Datos del Usuario Guardado Exitosamente! </center></div>";
            $INSERTARD = mysqli_query($conexion,$sql);
        }
    }
?>
<!------ Estructura Basica de la pagina de actualizar Cuenta ------->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta</title>
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
    </style>
</head>
<div class="container">
    <form action="micuenta.php" method="post">
    <button type="submit" class="btn btn-danger" name="regresar">Regresar</button>
    </form>
    </div>
        <div class="login-container border rounded bg-light p-4 shadow-sm">
            <center><h2>Actualizar Datos Del Usuario</h2></center>
            <!------ Formulario de Actualizacion ------->
        <form action="micuenta.php" method="post">
        <div class="row">
    <div class="col">
    <label for="form-control">Nombre</label>
        <input type="text" class="form-control" placeholder="Tu Nombre" name="nombre" autocomplete="off">
    </div>
    <div class="col">
    <label for="form-control">Apellidos</label>
        <input type="text" class="form-control" placeholder="Tu Apellido" name="apellido" autocomplete="off">
    </div>
    <div class="form-group">
    <label for="exampleFormControlSelect1">Tipo de Documento</label>
    <select class="form-control" id="exampleFormControlSelect1" name="tipo_documento" autocomplete="off">
    <option>Cedula de Ciudadania</option>
    <option>Tarjeta de Identidad</option>
    <option>Registro Civil</option>
    <option>Documento Extranjero</option>
    <option>Otro</option>
    </select>
    </div>
<div class="col">
    <label for="form-control">No. Documento</label>
        <input type="text" class="form-control" placeholder="Tu Numero de Documento" name="documento" autocomplete="off">
    </div>
    <div class="col">
    <label for="form-control">Edad</label>
        <input type="number" class="form-control" placeholder="Tu Edad" name="edad" autocomplete="off">
    </div>
    </div>
        <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
        </form>
    </div>
</body>
</html>