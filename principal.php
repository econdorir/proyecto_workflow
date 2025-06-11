<?php
include 'conexion.inc.php';

session_start();
$usuario = $_SESSION['usuario'] ?? 'msilva'; // usuario de prueba por ahora
$flujo = $_GET['flujo'] ?? 'F1';
$proceso = $_GET['proceso'] ?? 'P1';
$numero_tramite = $_GET['numero_tramite'] ?? 3001;

// Obtener datos del proceso
$sql = "SELECT * FROM workflow_proyecto.flujo_proceso WHERE flujo = '$flujo' AND proceso = '$proceso'";
$resultado = mysqli_query($conexion_workflow, $sql);
$fila = mysqli_fetch_array($resultado);

$pantalla = "procesos/" . $fila['pantalla'] . ".inc.php";
$pantalla_main = "procesos/" . $fila['pantalla'] . ".main.inc.php";
$proceso_siguiente = $fila['proceso_siguiente'];
$proceso_anterior = $proceso;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Becas - Flujo</title>
</head>
<body>
    <h1>Sistema de Becas</h1>

    <form action="motor.php" method="get">
        <input type="hidden" name="flujo" value="<?php echo $flujo; ?>">
        <input type="hidden" name="proceso" value="<?php echo $proceso_siguiente; ?>">
        <input type="hidden" name="proceso_anterior" value="<?php echo $proceso_anterior; ?>">
        <input type="hidden" name="numero_tramite" value="<?php echo $numero_tramite; ?>">

        <?php include $pantalla_main; ?>
        <?php include $pantalla; ?>

        <div>
            <button type="submit" name="anterior">Atrás</button>
            <button type="submit" name="siguiente">Siguiente</button>
        </div>
    </form>
</body>
</html>
