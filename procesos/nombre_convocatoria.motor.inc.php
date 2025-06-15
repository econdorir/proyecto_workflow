<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';

$success = false;

if (isset($_GET['siguiente'])) {
    $nombre_beca = trim($_GET['nombre_beca'] ?? '');
    $_SESSION['nombre_beca'] = $nombre_beca;
    $numero_tramite = $_GET['numero_tramite'];

    // Comprobar si ya existe registro para este trámite
    $sql_check = "SELECT id FROM convocatoria WHERE id = ?";
    $stmt_check = mysqli_prepare($conexion_sistema, $sql_check);
    mysqli_stmt_bind_param($stmt_check, 'i', $numero_tramite);
    mysqli_stmt_execute($stmt_check);
    $res_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($res_check) > 0) {
        // Actualizar
        $sql_update = "UPDATE convocatoria SET nombre_beca = ? WHERE id = ?";
        $stmt_update = mysqli_prepare($conexion_sistema, $sql_update);
        mysqli_stmt_bind_param($stmt_update, 'si', $nombre_beca, $numero_tramite);
        mysqli_stmt_execute($stmt_update);
        $success = (mysqli_stmt_affected_rows($stmt_update) > 0);
        mysqli_stmt_close($stmt_update);
    } else {
        // Insertar nuevo
        $sql_insert = "INSERT INTO convocatoria (id, nombre_beca) VALUES (?, ?)";
        $stmt_insert = mysqli_prepare($conexion_sistema, $sql_insert);
        mysqli_stmt_bind_param($stmt_insert, 'is', $numero_tramite, $nombre_beca);
        mysqli_stmt_execute($stmt_insert);
        $success = (mysqli_stmt_affected_rows($stmt_insert) > 0);
        mysqli_stmt_close($stmt_insert);
    }

    mysqli_stmt_close($stmt_check);
}
?>
<?php if ($success): ?>
    <div style="color: green;">¡Nombre de convocatoria guardado correctamente!</div>
<?php endif; ?>
