<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';

$success = false;
if (isset($_GET['siguiente'])) {
    $numero_tramite = $_SESSION['numero_tramite'];
    $fecha_aprobacion = $_SESSION['fecha_aprobacion'] ?? '';
    if (!empty($fecha_aprobacion)) {
        $sql = "UPDATE aplicacion SET fecha_aprobacion = ? WHERE numero_tramite = ?";
        $stmt = mysqli_prepare($conexion_sistema, $sql);
        mysqli_stmt_bind_param($stmt, 'si', $fecha_aprobacion, $numero_tramite);
        mysqli_stmt_execute($stmt);
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $success = true;
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<?php if ($success): ?>
    <div style=\"color: green;\">¡Fecha guardada correctamente!</div>
<?php endif; ?> 