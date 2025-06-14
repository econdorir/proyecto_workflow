<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';


$_SESSION['numero_tramite'] = $_GET['numero_tramite'];
$numero_tramite = $_SESSION['numero_tramite'];
// Get application and student data
$sql = "SELECT a.*, CONCAT(e.nombre, ' ', e.apellido) AS nombre_completo FROM aplicacion a JOIN estudiante e ON a.estudiante_id = e.id WHERE a.numero_tramite = $numero_tramite";
$resultado = mysqli_query($conexion_sistema, $sql);
$app = mysqli_fetch_assoc($resultado);
$nombre_completo = $app['nombre_completo'] ?? '';
?> 