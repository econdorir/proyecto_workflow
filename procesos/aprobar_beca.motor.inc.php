<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';

if (isset($_GET['siguiente'])) {
    $estudiante_id = $_SESSION['id'];
    $numero_tramite = $_SESSION['numero_tramite'];
    $aprobado = $_SESSION['aprobado'] ?? '';
    if ($aprobado === 'si') {
        $nuevo_estado = 'aprobado';
    } elseif ($aprobado === 'no') {
        $nuevo_estado = 'rechazado';
    } else {
        $nuevo_estado = null;
    }
    if ($nuevo_estado) {
        $stmt = mysqli_prepare($conexion_sistema, "UPDATE aplicacion SET estado = ? WHERE estudiante_id = ? AND numero_tramite = ?");
        mysqli_stmt_bind_param($stmt, 'sii', $nuevo_estado, $estudiante_id, $numero_tramite);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
?> 