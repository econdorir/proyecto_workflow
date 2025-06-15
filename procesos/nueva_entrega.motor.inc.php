<?php
session_start();
include '../conexion.inc.php';

$estudiante_id = $_SESSION['id'];

// Verificar si ya tiene una aplicación activa
$sql_check = "SELECT * FROM aplicacion WHERE estudiante_id = $estudiante_id AND estado = 'en_proceso'";
$resultado = mysqli_query($conexion_sistema, $sql_check);
$fila = mysqli_fetch_assoc($resultado);

if (!$fila) {
    // Si no hay, crear una nueva aplicación
    $numero_tramite = $_GET['numero_tramite'];
    $sql_insert = "INSERT INTO aplicacion (numero_tramite, estudiante_id, estado, observaciones)
                   VALUES ($numero_tramite, $estudiante_id, 'en_proceso', 'Nueva postulación iniciada')";
    mysqli_query($conexion_sistema, $sql_insert);

    $_SESSION['numero_tramite'] = $numero_tramite;
} else {
    // Si ya tiene una en proceso, reutilizamos esa
    $_SESSION['numero_tramite'] = $fila['numero_tramite'];
}
?>
