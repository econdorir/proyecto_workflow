<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estudiante_id = $_SESSION['id'];
    $numero_tramite = $_SESSION['numero_tramite'];
    $tipo_beca = $_POST['tipo_beca'] ?? '';
    $motivo = $_POST['motivo'] ?? '';
    $monto_solicitado = $_POST['monto_solicitado'] ?? 0;
    $observaciones = $_POST['observaciones'] ?? '';

    $stmt = mysqli_prepare($conexion_sistema, "UPDATE aplicacion SET tipo_beca = ?, motivo = ?, monto_solicitado = ?, observaciones = ? WHERE estudiante_id = ? AND numero_tramite = ?");
    mysqli_stmt_bind_param($stmt, 'ssdssi', $tipo_beca, $motivo, $monto_solicitado, $observaciones, $estudiante_id, $numero_tramite);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
?> 