<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';

$success = false;

if (isset($_GET['siguiente']) && $_GET['confirmar_anuncio'] === '1') {
    $numero_tramite = $_GET['numero_tramite'];

    $sql = "UPDATE convocatoria SET estado = 'anunciada' WHERE id = ?";
    $stmt = mysqli_prepare($conexion_sistema, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $numero_tramite);
    mysqli_stmt_execute($stmt);

    $success = (mysqli_stmt_affected_rows($stmt) >= 0);
    mysqli_stmt_close($stmt);
}
?>
<?php if ($success): ?>
    <div style="color: green;">¡Convocatoria anunciada exitosamente!</div>
<?php else: ?>
    <div style="color: red;">Error al anunciar la convocatoria. Intente nuevamente.</div>
<?php endif; ?>
