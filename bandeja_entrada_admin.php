<?php
include './conexion.inc.php';
session_start();

$usuario = $_SESSION['usuario'] ?? '';
$rol = $_SESSION['rol'] ?? '';
if (!$usuario) {
    echo '<p>Debes iniciar sesión para ver tu bandeja de entrada.</p>';
    exit;
}

// Si el usuario envió un flujo nuevo
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['flujo']) && isset($_GET['iniciar'])) {
    $flujo = $_GET['flujo'];
    $proceso = 'P1';

    // Obtener el mayor numero_tramite para el flujo seleccionado
    $sql_max = "SELECT MAX(numero_tramite) AS max_tramite FROM flujo_proceso_seguimiento WHERE flujo = ?";
    $stmt_max = mysqli_prepare($conexion_workflow, $sql_max);
    mysqli_stmt_bind_param($stmt_max, 's', $flujo);
    mysqli_stmt_execute($stmt_max);
    $res_max = mysqli_stmt_get_result($stmt_max);
    $row_max = mysqli_fetch_assoc($res_max);
    $max_tramite = $row_max['max_tramite'] ?? 0;
    $nuevo_tramite = $max_tramite ? $max_tramite + 1 : 3001;
    mysqli_stmt_close($stmt_max);

    // Insertar nuevo registro en flujo_proceso_seguimiento
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $sql_insert = "INSERT INTO flujo_proceso_seguimiento (flujo, proceso, numero_tramite, usuario, fecha_inicio, hora_inicio) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion_workflow, $sql_insert);
    mysqli_stmt_bind_param($stmt, 'ssisss', $flujo, $proceso, $nuevo_tramite, $usuario, $fecha, $hora);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirigir a principal.php con los parámetros
    header("Location: principal.php?flujo=$flujo&proceso=$proceso&numero_tramite=$nuevo_tramite");
    exit;
}


// Rango permitido de procesos por rol
$rango_flujo_proceso = [
    'estudiante' => ['F1' => ['P1', 'P2', 'P3', 'P4', 'P13'], 'F2' => ['P7']], 
    'administrador' => ['F1' => ['P5', 'P6', 'P7', 'P8', 'P9', 'P9', 'P10', 'P11', 'P12'], 'F2' => ['P1', 'P2', 'P3', 'P4', 'P5', 'P6']],
];


// Obtener procesos pendientes para la bandeja
$sql = "SELECT * FROM flujo_proceso_seguimiento WHERE hora_fin IS NULL GROUP BY numero_tramite, flujo, proceso";
$resultado = mysqli_query($conexion_workflow, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Bandeja de Entrada</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .btn-group {
            margin-bottom: 20px;
        }

        .btn {
            padding: 8px 16px;
            margin-right: 10px;
        }

        #nuevoFlujoForm {
            display: none;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Bandeja de Entrada de Administrador</h2>
        <div class="btn-group">
            <button class="btn" onclick="mostrarNuevoFlujo()">+ Nuevo</button>
            <a href="./login.php" class="btn">Cerrar Sesión</a>
        </div>
        <form id="nuevoFlujoForm" method="get">
            <input type="hidden" name="proceso" value="P1">
            <input type="hidden" name="iniciar" value="1">
            <label for="flujo">Seleccione el flujo a iniciar:</label>

            <select name="flujo" id="flujo" required>
                <?php if ($rol === 'estudiante'): ?>
                    <option value="F1">Solicitud de Beca</option>
                <?php elseif ($rol === 'evaluador'): ?>
                    <option value="F4">Evaluación de Solicitudes</option>
                <?php elseif ($rol === 'administrador'): ?>
                    <option value="F2">Creación de convocatoria</option>
                <?php else: ?>
                    <option value="">No hay flujos disponibles</option>
                <?php endif; ?>
            </select>

            <button type="submit">Iniciar</button>
            <button type="button" onclick="ocultarNuevoFlujo()">Cancelar</button>
        </form>

        <table>
            <tr>
                <th>Nro Trámite</th>
                <th>Flujo</th>
                <th>Proceso</th>
                <th>Operación</th>
            </tr>
            <?php while ($fila = mysqli_fetch_array($resultado)) : ?>
                <tr>
                    <td><?= htmlspecialchars($fila['numero_tramite']) ?></td>
                    <td><?= htmlspecialchars($fila['flujo']) ?></td>
                    <td><?= htmlspecialchars($fila['proceso']) ?></td>
                    <?php
                    $flujo = $fila['flujo'];
                    $proceso = $fila['proceso'];

                    $puede_editar = in_array($proceso, $rango_flujo_proceso[$rol][$flujo] ?? []);
                    ?>
                    <td>
                        <?php if ($puede_editar): ?>
                            <a href="principal.php?flujo=<?= urlencode($flujo) ?>&proceso=<?= urlencode($proceso) ?>&numero_tramite=<?= urlencode($fila['numero_tramite']) ?>">Editar</a>
                        <?php else: ?>
                            <span style="color: gray;">En proceso</span>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <script>
        function mostrarNuevoFlujo() {
            document.getElementById('nuevoFlujoForm').style.display = 'block';
        }

        function ocultarNuevoFlujo() {
            document.getElementById('nuevoFlujoForm').style.display = 'none';
        }
    </script>
</body>

</html>