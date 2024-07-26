<?php
#incluir dependecias
include "conexion_db.php";
include "proteger.php";

session_start();

#Buscar en la db si el usuario existe, para dejarlo pasar ala pagina de inicio
if(isset($_POST['iniciars'])){
$username = $_POST['username'];
$password = $_POST['password'];

$username = limpiar_cadena($username);
$password = limpiar_cadena($password);

$sql = "SELECT * FROM usuarios WHERE usuario='$username'";
$result = mysqli_query($conexion, $sql);
$user = mysqli_fetch_assoc($result);
if($_POST['username'] == "" || $_POST['password'] == ""){
    echo "<div class='alert alert-danger' role='alert'> <center>Por favor Ingrese un Usuario o Contrasena Valida </center></div>";
}elseif($user && password_verify($password, $user['passwords'])){
    $_SESSION['username'] = $user['usuario'];
    header('Location: inicio.php');
    exit;
}else{
    echo "<div class='alert alert-danger' role='alert'> <center>Usuario o Contrasena no encontrados </center></div>";
}
}

?>

<!------ Estructura Basica de la pagina de logeo ----->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--estilos para complementar el bootstrap -->
    
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
        .btn-secondary{
            margin-left: 600px;
        }
        .alert{
            width: 400px;
            margin-left: 420px;
            margin-top: 30px;
            transition: display 0.5s linear; /* Transición para la opacidad */
            animation: fadeOut 5s forwards; /* Animación para desvanecer */
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
        @keyframes fadeOut {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
            display: none;
        }
}
    </style>
</head>
<body>
    <!--Formulario de Logeo -->
<div class="container">
        <div class="login-container border rounded bg-light p-4 shadow-sm">
            <h2 class="text-center mb-4">Iniciar Sesion</h2>
        <form action="index2.php" method="post">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="bi-person-plus-fill"></i></span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" name="username" autocomplete="off">
            </div>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-exclamation-circle"></i></span>
                <input type="password" class="form-control" placeholder="Contraseña" aria-label="Password" aria-describedby="addon-wrapping" name="password" autocomplete="off" required>
            </div>
            <div class="col-12">
            <button type="submit" class="btn btn-primary" name="iniciars">Iniciar Sesion</button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>