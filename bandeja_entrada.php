<?php
include './conexion.inc.php';
session_start();

// Use the logged-in user
$usuario = $_SESSION['usuario'] ?? '';
$rol = $_SESSION['rol'] ?? '';
if (!$usuario) {
    echo '<p>Debes iniciar sesión para ver tu bandeja de entrada.</p>';
    exit;
}

// Get pending processes for the user
$sql = "SELECT * FROM flujo_proceso_seguimiento WHERE usuario = '$usuario' AND hora_fin IS NULL";
$resultado = mysqli_query($conexion_workflow, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bandeja de Entrada</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .btn-group { margin-bottom: 20px; }
        .btn { padding: 8px 16px; margin-right: 10px; }
        #nuevoFlujoForm { display: none; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Bandeja de Entrada</h2>
    <div class="btn-group">
        <button class="btn" onclick="mostrarNuevoFlujo()">+ Nuevo</button>
        <a href="./login.php" class="btn">Cerrar Sesión</a>
    </div>
    <form id="nuevoFlujoForm" action="./principal.php" method="post">
        <label for="flujo">Seleccione el flujo a iniciar:</label>
        <select name="flujo" id="flujo" required>
            <?php if ($rol === 'estudiante'): ?>
                <option value="F1">Solicitud de Beca</option>
                <option value="F2">Renovación de Beca</option>
            <?php elseif ($rol === 'evaluador'): ?>
                <option value="F3">Evaluación de Solicitudes</option>
            <?php elseif ($rol === 'administrador'): ?>
                <option value="F4">Gestión de Usuarios</option>
                <option value="F5">Reportes</option>
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
                <td>
                    <a href="principal.php?flujo=<?= urlencode($fila['flujo']) ?>&proceso=<?= urlencode($fila['proceso']) ?>&numero_tramite=<?= urlencode($fila['numero_tramite']) ?>">Editar</a>
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
