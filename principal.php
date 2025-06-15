<?php
include 'conexion.inc.php';

session_start();
$usuario = $_SESSION['usuario']; // usuario de prueba por ahora
$flujo = $_GET['flujo'];
$proceso = $_GET['proceso'];
$numero_tramite = $_GET['numero_tramite'];

// Insert into flujo_proceso_seguimiento if not already present for this step
$date = date('Y-m-d');
$time = date('H:i:s');
$sql_check = "SELECT * FROM flujo_proceso_seguimiento WHERE flujo='$flujo' AND proceso='$proceso' AND numero_tramite='$numero_tramite' AND usuario='$usuario' AND fecha_fin IS NULL";
$res_check = mysqli_query($conexion_workflow, $sql_check);
$res_check_array = mysqli_fetch_array($res_check);
echo "query for inserting:<br><pre>";
print_r($res_check_array);
echo "</pre>";
echo "a" . mysqli_num_rows($res_check) == 0;

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
$tipo_actual = $fila['tipo'];
$rol_siguiente = mysqli_query($conexion_workflow, "SELECT rol FROM workflow_proyecto.flujo_proceso WHERE flujo = '$flujo' AND proceso = '$proceso_siguiente'");
$rol_siguiente = mysqli_fetch_array($rol_siguiente)['rol'];
$rol_usuario = $_SESSION['rol'];

echo $_SESSION['rol'] . " : $rol_siguiente " . " - Flujo: $flujo, Proceso: $proceso, Número de Trámite: $numero_tramite";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sistema de Becas - Flujo</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Sistema de Becas</h1>

        <form id="workflowForm" action="motor.php" method="get">
            <input type="hidden" name="flujo" value="<?php echo $flujo; ?>">
            <input type="hidden" name="proceso" id="procesoInput" value="">
            <input type="hidden" name="proceso_anterior" value="<?php echo $proceso_anterior; ?>">
            <input type="hidden" name="numero_tramite" value="<?php echo $numero_tramite; ?>">
            <input type="hidden" name="rol_usuario" value="<?php echo $rol_usuario; ?>">
            <input type="hidden" name="rol_siguiente" value="<?php echo $rol_siguiente; ?>">

            <?php include $pantalla_main; ?>
            <?php include $pantalla; ?>

            <div class="button-group">
                <?php if ($tipo_actual === 'I' || $tipo_actual === 'C'): ?>
                    <button type="submit" name="anterior" id="atrasBtn"><a href="./bandeja_entrada.php">Atrás</a></button>
                    <button type="submit" name="siguiente" id="siguienteBtn">Siguiente</button>
                <?php elseif ($tipo_actual === 'S' ): ?>
                    <button type="submit" name="anterior" id="atrasBtn">Enviar</button>
                    <button name="siguiente" id="siguienteBtn"><a href="./bandeja_entrada.php">Siguiente</a></button>
                <?php else: ?>
                    <button type="submit" name="anterior" id="atrasBtn">Atrás</button>
                    <button name="siguiente" id="siguienteBtn">Siguiente</button>
                <?php endif; ?>
            </div>
        </form>
        <?php if ($rol_usuario == 'estudiante'): ?>
            <a href="./bandeja_entrada.php">Volver a la bandeja de entrada</a>
        <?php elseif ($rol_usuario == 'administrador'): ?>
            <a href="./bandeja_entrada_admin.php">Volver a la bandeja de entrada</a>
        <?php endif; ?>
    </div>
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