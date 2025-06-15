<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';

$success = false;
if (isset($_GET['siguiente'])) {
    $estudiante_id = $_SESSION['id'];
    $numero_tramite = $_GET['numero_tramite'];
    $tipo_beca = $_SESSION['tipo_beca'] ?? '';
    $motivo = $_SESSION['motivo'] ?? '';
    $monto_solicitado = $_SESSION['monto_solicitado'] ?? 0;
    $observaciones = $_SESSION['observaciones'] ?? '';
    $stmt = mysqli_prepare($conexion_sistema, "UPDATE aplicacion SET tipo_beca = ?, motivo = ?, monto_solicitado = ?, observaciones = ?, estado = 'enviado' WHERE estudiante_id = ? AND numero_tramite = ?");
    mysqli_stmt_bind_param($stmt, 'ssdssi', $tipo_beca, $motivo, $monto_solicitado, $observaciones, $estudiante_id, $numero_tramite);
    mysqli_stmt_execute($stmt);
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $success = true;
    }
    mysqli_stmt_close($stmt);
    echo "num en el motor aqui" . $numero_tramite;

}
?>
<?php if ($success): ?>
    <div style="color: green;">¡Solicitud enviada correctamente!</div>
<?php endif; ?> 