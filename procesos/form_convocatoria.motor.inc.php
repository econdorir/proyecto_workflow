<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';

$success = false;

if (isset($_GET['siguiente'])) {
    $numero_tramite = $_GET['numero_tramite'];

    $descripcion = trim($_GET['descripcion'] ?? '');
    $fecha_inicio = $_GET['fecha_inicio'] ?? '';
    $fecha_fin = $_GET['fecha_fin'] ?? '';
    $requisitos = trim($_GET['requisitos'] ?? '');
    $monto = floatval($_GET['monto'] ?? 0);

    // Guardar en sesión
    $_SESSION['descripcion'] = $descripcion;
    $_SESSION['fecha_inicio'] = $fecha_inicio;
    $_SESSION['fecha_fin'] = $fecha_fin;
    $_SESSION['requisitos'] = $requisitos;
    $_SESSION['monto'] = $monto;

    // Actualizar convocatoria
    $sql = "UPDATE convocatoria 
            SET descripcion = ?, fecha_inicio = ?, fecha_fin = ?, requisitos = ?, monto = ?
            WHERE id = ?";
    $stmt = mysqli_prepare($conexion_sistema, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssdi', $descripcion, $fecha_inicio, $fecha_fin, $requisitos, $monto, $numero_tramite);
    mysqli_stmt_execute($stmt);

    $success = (mysqli_stmt_affected_rows($stmt) >= 0); // puede ser 0 si no cambió nada, pero está bien
    mysqli_stmt_close($stmt);
}
?>
<?php if ($success): ?>
    <div style="color: green;">¡Datos de convocatoria guardados correctamente!</div>
<?php endif; ?>
