<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';

$success = false;
if (isset($_GET['siguiente'])) {
    $estudiante_id = $_SESSION['id'];
    $numero_tramite = $_SESSION['numero_tramite'];
    $stmt = mysqli_prepare($conexion_sistema, "UPDATE aplicacion SET estado = 'enviado' WHERE estudiante_id = ? AND numero_tramite = ?");
    mysqli_stmt_bind_param($stmt, 'ii', $estudiante_id, $numero_tramite);
    mysqli_stmt_execute($stmt);
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $success = true;
    }
    mysqli_stmt_close($stmt);
}
?>
<?php if ($success): ?>
    <div style="color: green;">¡Solicitud enviada correctamente!</div>
<?php endif; ?> 