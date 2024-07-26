<?php
    #incluir dependencias
    include "conexion_db.php";
    #incluir el PDO
    try {
        $pdo = new PDO("mysql:host=127.0.0.1;dbname=inventario;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error al conectar a la base de datos: " . $e->getMessage());
    }

    $resultadosPorPagina = 5;

    $stmt = $pdo->query("SELECT COUNT(*) FROM productos");
    $totalResultados = $stmt->fetchColumn();
    
    $totalPaginas = ceil($totalResultados / $resultadosPorPagina);
    
    $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    
    $indiceInicio = ($paginaActual - 1) * $resultadosPorPagina;

    $stmt = $pdo->prepare("SELECT * FROM productos LIMIT :indiceInicio, :resultadosPorPagina");
    $stmt->bindParam(':indiceInicio', $indiceInicio, PDO::PARAM_INT);
    $stmt->bindParam(':resultadosPorPagina', $resultadosPorPagina, PDO::PARAM_INT);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
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


?>
<!---- Estructura Basica de La pagina de productos -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <!-- Añadir Bootstrap para mejorar el diseño -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .text-align{
            text-align: center;
            margin-bottom: 30px;
        }
        .letras{
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-weight: 900;
            font-size: 20px;
        }
        .item-table{
            text-align: center;
        }
        .btn-danger{
            margin-top: 20px;
        }
        .btn{
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="col-6">
        <form action="lista_productos.php" method="post">
            <button type="submit" class="btn btn-danger" name="pagina_p">Regresar</button>
        </form>
        <!----- Redigir con los botones de acciones ---->
        <?php
            if(isset($_POST['pagina_p'])){
                header("Location: inicio.php");
            }
            if(isset($_POST['editar'])){
                header("Location: actualizar_producto.php");
            }
        ?>
    </div>
    <h1 class="text-align">Lista de Productos</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="item-table">Imagen del producto</th>
                <th class="item-table">Serial del producto</th>
                <th class="item-table">Nombre</th>
                <th class="item-table">Precio</th>
                <th class="item-table">ID del que añadio</th>
                <th class="item-table">Botones</th>
            </tr>
        </thead>
        <tbody>
            <!------ Recorrer los valores que hay en los resultados de la consulta PDO ----->
            <?php foreach ($resultados as $producto): ?>
                <tr>
                <td>
                        <?php if (!empty($producto['img_producto'])): ?>
                            <center><img src="<?php echo htmlspecialchars($producto['img_producto']); ?>" style="width: 70px; height: 70px;"></center>
                        <?php else: ?>
                            <span>No hay imagen disponible</span>
                        <?php endif; ?>
                </td>
                    <td><center><span class="letras"><?php echo htmlspecialchars($producto['serial_producto']); ?></span></td></center>
                    <td><center><span class="letras"><?php echo htmlspecialchars($producto['nombre_producto']); ?></span></td></center>
                    <td><center><span class="letras"><?php echo htmlspecialchars($producto['precio']).'$'; ?></td></span></center>
                    <td><center><span class="letras"><?php echo htmlspecialchars($producto['documento']); ?></td></span></center>
<td><center>
    <form action='eliminar.php' method='post' class="form">
        <input type='hidden' name='id' value='<?php echo htmlspecialchars($producto['ID']); ?>'>
        <input type='submit' name="eliminar" class="btn btn-danger" value="Eliminar">
    </form>
    <form action="lista_productos.php" method="post" class="form">
        <input type="hidden" name="id" value='<?php echo htmlspecialchars($producto['ID']); ?>'>
        <input type="submit" value="Editar" class="btn btn-warning" name="editar">
    </form>
</center></td>
</tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Paginador -->
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?php if ($i === $paginaActual) echo 'active'; ?>">
                    <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
<!-- Añadir Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>