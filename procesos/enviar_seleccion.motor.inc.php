<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';

$success = false;
if (isset($_GET['siguiente'])) {
    $numero_tramite = $_GET['numero_tramite'];
    $anio_inicio = $_SESSION['anio_inicio'] ?? '';
    $anio_fin = $_SESSION['anio_fin'] ?? '';
    $semestre_inicio = $_SESSION['semestre_inicio'] ?? '';
    $semestre_fin = $_SESSION['semestre_fin'] ?? '';
    // Add columns if not present in DB
    $sql = "UPDATE aplicacion SET anio_inicio = ?, anio_fin = ?, semestre_inicio = ?, semestre_fin = ? WHERE numero_tramite = ?";
    $stmt = mysqli_prepare($conexion_sistema, $sql);
    mysqli_stmt_bind_param($stmt, 'iissi', $anio_inicio, $anio_fin, $semestre_inicio, $semestre_fin, $numero_tramite);
    mysqli_stmt_execute($stmt);
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $success = true;
    }
    mysqli_stmt_close($stmt);
}
?>
<?php if ($success): ?>
    <div style="color: green;">¡Selección guardada correctamente!</div>
<?php endif; ?> 