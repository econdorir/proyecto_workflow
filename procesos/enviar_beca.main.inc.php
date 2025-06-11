<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';

$id = $_SESSION['id'];
$numero_tramite = $_SESSION['numero_tramite'];

// Get student name
$sql = "SELECT CONCAT(nombre, ' ', apellido) AS nombre_completo FROM estudiante WHERE id = $id";
$resultado = mysqli_query($conexion_sistema, $sql);
$fila = mysqli_fetch_assoc($resultado);
$nombre_completo = $fila['nombre_completo'];

// Get application data
$sql_app = "SELECT tipo_beca, motivo, monto_solicitado, observaciones FROM aplicacion WHERE estudiante_id = $id AND numero_tramite = $numero_tramite";
$res_app = mysqli_query($conexion_sistema, $sql_app);
$app = mysqli_fetch_assoc($res_app);
?> 