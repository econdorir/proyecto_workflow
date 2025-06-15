<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';

$numero_tramite = $_GET['numero_tramite'] ?? null;

if ($numero_tramite) {
    $sql = "SELECT nombre_beca FROM convocatoria WHERE id = ?";
    $stmt = mysqli_prepare($conexion_sistema, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $numero_tramite);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    if ($fila = mysqli_fetch_assoc($resultado)) {
        $_SESSION['nombre_beca'] = $fila['nombre_beca'];
    }
    mysqli_stmt_close($stmt);
}
?>
