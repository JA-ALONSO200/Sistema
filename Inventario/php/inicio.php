<?php

include "conexion_db.php";
include "proteger.php";
session_start();

$dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo 'Conexión fallida: ' . $e->getMessage();
    exit;
}

$usuario = $_SESSION['username'];
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

$stmt = $pdo->prepare("SELECT admin FROM usuarios WHERE usuario = :usuario");
$stmt->execute(['usuario' => $usuario]);
$result = $stmt->fetch();

if(isset($_POST['micuenta'])){
    header('Location: micuenta.php');
}
if(isset($_POST['salir'])){
    session_start();
    session_destroy();
    header('Location: index.php');
} 

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
        .logo{
            font-size: 30px;
            font-weight: 500;
            margin-left: 30px;
            margin-right: 30px;
            margin-top: 30px;
            width: 120px;
        }
        .nav-link{
            margin-top: 10px;
        }
        @media (max-width: 500px) {
        .nav{
            align-items: center;
            flex-direction: column
        }
        .container{
            
            display: flex;
            justify-self: center;
            align-items: center;
        }
        .col-12{
            margin-top: 70px;
        }
        }
        .logo{
            margin-top: 5px;
        }
        .welcome{
            font-size: 30px;
            font-weight: 600;
            color: gray;
        }
        .pagina{
            font-weight: 600;
            margin-top: 40px
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
        .user{
            font-weight: 900;
            color: #437af0;
        }
        .btn-outline-primary{
            height: 40px;
            margin-top: 7px;
        }
        .btn-outline-danger{
            height: 40px;
            margin-top: 7px;
            margin-left: 20px;
        }
        form{
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            flex: 20%;
        }
        @media (max-width: 480px) {
    /* Estilos para celulares */
    form{
            display: flex;
            flex-direction: row;
            justify-content: center;
            flex: 20%;
        }
    }
    @media (min-width: 481px) and (max-width: 768px)  {
    /* Estilos para tablets */
    form{
            display: flex;
            flex-direction: row;
            justify-content: center;
            flex: 20%;
        }
    }
    h1{
        color: gray;
    }

</style>

</head>

<body>

<header>
    <ul class="nav nav-tabs">
    <li class="nav-item">
    <a href="inicio.php"><img src="../imgs/SGI.jpeg" alt="" width="50px" class="logo"></a>
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Productos</a>
    <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="nuevo_producto.php">Agregar Producto</a></li>
    <?php
        if($result && $result['admin'] == 1){
        echo '
        <li><a class="dropdown-item" href="lista_productos.php">Ver Productos</a></li>';
        }elseif($result && $result['admin'] == 0){
            echo '
            <li><a class="dropdown-item" href="ver_inventario.php">Ver Productos</a></li>';
            }
        ?>
    </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Ventas</a>
        <ul class="dropdown-menu">
        <?php
        if($result && $result['admin'] == 1){
        echo '
        <li><a class="dropdown-item" href="ventas.php">Ver Ventas</a></li>';
        }elseif($result && $result['admin'] == 0){
            echo '
            <li><a class="dropdown-item" href="ver_ventas.php">Ver Ventas</a></li>';
            }
        ?>
        </ul>
    </li>
    <form action="#" method="post">
        <div class="contenedor">
            <ul class="navbar-nav">
                <li class="nav-item right-item"><button type="submit" class="btn btn-outline-primary" name="micuenta">Mi Cuenta</button></li>
                <li class="nav-item right-item"><button type="submit" class="btn btn-outline-danger" name="salir">Salir</button></li>
            </ul>
        </div>
    </form>
    </ul>
</header>

<section>
        <div class="container">
        <div class="col-12">
            <h1 class="pagina">Home</h1>
            <p class="welcome">!Bienvenido <span class="user"><?php echo $_SESSION['username']; ?></span></p>
        </div>
        </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
