<?php
session_start();
include '../conexion.inc.php';

$id = $_SESSION['id'];
$sql = "SELECT CONCAT(nombre, ' ', apellido) AS nombre_completo FROM estudiante WHERE id = $id";
$resultado = mysqli_query($conexion_sistema, $sql);
$fila = mysqli_fetch_assoc($resultado);

$nombre_completo = $fila['nombre_completo'];
?>
