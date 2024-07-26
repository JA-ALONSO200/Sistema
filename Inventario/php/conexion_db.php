<?php

#declaracion de parametros de la conexion de la base de datos

$username = "root";
$password = "";
$host = "127.0.0.1";
$database = "inventario";

#conexion de la base de datos
$conexion = mysqli_connect($host,$username,$password,$database);


?>