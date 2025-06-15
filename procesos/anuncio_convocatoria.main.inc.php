<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';

$numero_tramite = $_GET['numero_tramite'] ?? null;

if ($numero_tramite) {
    $sql = "SELECT nombre_beca, descripcion, fecha_inicio, fecha_fin, requisitos, monto FROM convocatoria WHERE id = ? AND estado = 'anunciada'";
    $stmt = mysqli_prepare($conexion_sistema, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $numero_tramite);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($fila = mysqli_fetch_assoc($res)) {
        $_SESSION['nombre_beca'] = $fila['nombre_beca'];
        $_SESSION['descripcion'] = $fila['descripcion'];
        $_SESSION['fecha_inicio'] = $fila['fecha_inicio'];
        $_SESSION['fecha_fin'] = $fila['fecha_fin'];
        $_SESSION['requisitos'] = $fila['requisitos'];
        $_SESSION['monto'] = $fila['monto'];
    }
    mysqli_stmt_close($stmt);
}
?>
