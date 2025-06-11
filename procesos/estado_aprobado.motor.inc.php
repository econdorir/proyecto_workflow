<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';

$success = false;
if (isset($_GET['siguiente'])) {
    $numero_tramite = $_SESSION['numero_tramite'];
    if (!empty($_SESSION['confirm_aprobado'])) {
        $sql = "UPDATE aplicacion SET estado = 'aprobado' WHERE numero_tramite = ?";
        $stmt = mysqli_prepare($conexion_sistema, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $numero_tramite);
        mysqli_stmt_execute($stmt);
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $success = true;
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<?php if ($success): ?>
    <div style="color: green;">¡Estado actualizado a aprobado!</div>
<?php endif; ?> 