<?php
    #incluir Dependecias
    include "conexion_db.php";
    include "proteger.php";

    #guardar usuario y contrasena en la db
    if(isset($_POST['registro'])){
        $usuario = $_POST['username'];
        $contrasena = password_hash($_POST['password'],PASSWORD_BCRYPT);
        $usuario = limpiar_cadena($usuario);
        $contrasena = limpiar_cadena($contrasena);
        $sql = "INSERT INTO usuarios (usuario ,passwords) VALUES('$usuario','$contrasena')";

        if($_POST['username'] == "" || $_POST['password'] == ""){
            echo "<div class='alert alert-danger' role='alert'> <center>Por favor Ingrese un Usuario o Contrasena Valida </center></div>";
        }else{
            echo "<div class='alert alert-success' role='alert'> <center>Registro Exitoso </center></div>";
            $INSERTAR = mysqli_query($conexion,$sql);
        }
    # dirigir a la pagina de logeo
    }
    if(isset($_POST['iniciar'])){
        header ("Location: index2.php");
    }
?>
<!------ Estructura Principal del sistema de registro ----->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!estilos para complementar el bootstrap --!>
    
    <style>
        .login-container {
            max-width: 500px;
            max-height: 500px;
            margin: 0 auto;
            padding: 15px;
            margin-top: 200px;
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
        .col-12{
            display: flex;
            align-items: center;
            margin-top: 10px;
            flex-direction: column;
        }
        .btn{
            margin-left: 0px;
            margin-top: 15px;
        }
        @media (max-width: 500px) {
        .col-12{
            display: flex;
            align-items: center;
            margin-top: 10px;
            flex-direction: column;
        }
        .btn{
            margin-left: 0px;
            margin-top: 15px;
        }
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
<body>
    <!---Formulario de Registro ----->
<div class="container">
        <div class="login-container border rounded bg-light p-4 shadow-sm">
            <h2 class="text-center mb-4">Registrarse</h2>
        <form action="index.php" method="post">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">@</span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" name="username" autocomplete="off">
            </div>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="bi-person-plus-fill"></i></span>
                <input type="password" class="form-control" placeholder="Contraseña" aria-label="Password" aria-describedby="addon-wrapping" name="password" autocomplete="off">
            </div>
            <div class="col-12">
            <button type="submit" class="btn btn-success" name="registro">Registrar</button>
            <button type="submit" class="btn btn-primary" name="iniciar">Iniciar Sesion</button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>
