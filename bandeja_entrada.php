<?php
include 'conexion.inc.php';
session_start();

// Use the logged-in user
$usuario = $_SESSION['usuario'] ?? '';
if (!$usuario) {
    echo '<p>Debes iniciar sesión para ver tu bandeja de entrada.</p>';
    exit;
}

// Get pending processes for the user
$sql = "SELECT * FROM flujo_proceso_seguimiento WHERE usuario = '$usuario' AND hora_fin IS NULL";
$resultado = mysqli_query($conexion_workflow, $sql);
?>

<h2>Bandeja de Entrada</h2>
<table border="1" cellpadding="6" cellspacing="0">
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
