<?php

#incluir dependencias
include 'conexion_db.php';

#eliminar un producto de la DB
if (isset($_POST['eliminar'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM productos WHERE ID=$id";
    $eliminar_p = mysqli_query($conexion,$sql);
    if ($eliminar_p) {
        echo "Registro eliminado exitosamente";
        header("Location: lista_productos.php");
    }
}

if (isset($_POST['eliminar_v'])) {
    $id_venta = $_POST['id_ventas'];
    $sql2 = "DELETE FROM ventas WHERE id_ventas=$id_venta";
    $eliminar_v = mysqli_query($conexion,$sql2);
    if ($eliminar_v) {
        echo "Registro eliminado exitosamente";
        header("Location: ventas.php");
    }
    
}

exit();
?>