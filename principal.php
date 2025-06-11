<?php
include 'conexion.inc.php';

session_start();
$usuario = $_SESSION['usuario'] ?? 'msilva'; // usuario de prueba por ahora
$flujo = $_GET['flujo'] ?? 'F1';
$proceso = $_GET['proceso'] ?? 'P1';
$numero_tramite = $_GET['numero_tramite'] ?? 3001;

// Insert into flujo_proceso_seguimiento if not already present for this step
$date = date('Y-m-d');
$time = date('H:i:s');
$sql_check = "SELECT * FROM flujo_proceso_seguimiento WHERE flujo='$flujo' AND proceso='$proceso' AND numero_tramite='$numero_tramite' AND usuario='$usuario' AND fecha_fin IS NULL";
$res_check = mysqli_query($conexion_workflow, $sql_check);
if (mysqli_num_rows($res_check) == 0) {
    $sql_insert = "INSERT INTO flujo_proceso_seguimiento (flujo, proceso, numero_tramite, usuario, fecha_inicio, hora_inicio) VALUES ('$flujo', '$proceso', '$numero_tramite', '$usuario', '$date', '$time')";
    mysqli_query($conexion_workflow, $sql_insert);
}

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

    <form id="workflowForm" action="motor.php" method="get">
        <input type="hidden" name="flujo" value="<?php echo $flujo; ?>">
        <input type="hidden" name="proceso" id="procesoInput" value="">
        <input type="hidden" name="proceso_anterior" value="<?php echo $proceso_anterior; ?>">
        <input type="hidden" name="numero_tramite" value="<?php echo $numero_tramite; ?>">

        <?php include $pantalla_main; ?>
        <?php include $pantalla; ?>

        <div>
            <button type="submit" name="anterior" id="atrasBtn">Atrás</button>
            <button type="submit" name="siguiente" id="siguienteBtn">Siguiente</button>
        </div>
    </form>
    <script>
        const procesoSiguiente = "<?php echo $proceso_siguiente; ?>";
        const procesoActual = "<?php echo $proceso_anterior; ?>";
        document.getElementById('atrasBtn').addEventListener('click', function() {
            document.getElementById('procesoInput').value = procesoActual;
        });
        document.getElementById('siguienteBtn').addEventListener('click', function() {
            document.getElementById('procesoInput').value = procesoSiguiente;
        });
        // Set default for Siguiente (in case user presses Enter)
        document.getElementById('procesoInput').value = procesoSiguiente;
    </script>
</body>
</html>
