<?php
echo password_hash("123456", PASSWORD_BCRYPT);

include 'conexion.inc.php';
$flujo = $_GET['flujo'] ?? 'F1';
$proceso = $_GET['proceso'] ?? 'P1';


$sql = "SELECT * FROM flujo_proceso WHERE flujo = '$flujo' AND proceso = '$proceso'";
$resultado = mysqli_query($con, $sql);
$fila = mysqli_fetch_array($resultado);

$pantalla = $fila['pantalla'];
$pantalla = "pantallas/" . $pantalla . ".inc.php";

$pantalla_main = $fila['pantalla'];
$pantalla_main = "pantallas/" . $pantalla_main . ".main.inc.php";

$proceso_anterior = $proceso;
$proceso_siguiente = $fila['proceso_siguiente'];

include $pantalla_main;

echo $pantalla;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro de Becas</title>
</head>

<body>
    <h1>Index Inicio</h1>
    <form action="motor.php" method="get">
        <input type="hidden" name="flujo" value="<?php echo $flujo; ?>">
        <input type="hidden" name="proceso" value="<?php echo $proceso_siguiente; ?>">
        <input type="hidden" name="proceso_anterior" value="<?php echo $proceso_anterior; ?>">
        <?php
        include $pantalla;
        ?>
        <div>
            <button type="submit">Atras</button>
            <button type="submit">Siguiente</button>
        </div>
    </form>
</body>

</html>