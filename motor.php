<?php
include 'conexion.inc.php';
session_start();
$flujo = $_GET['flujo'] ?? 'F1';
$proceso = $_GET['proceso_anterior'] ?? 'P1';
$proceso_siguiente = $_GET['proceso'] ?? 'P2';

// get database
$sql = "SELECT * FROM flujo_proceso WHERE flujo = '$flujo' AND proceso = '$proceso'";
$resultado = mysqli_query($con, $sql);
$fila = mysqli_fetch_array($resultado);
$pantalla = $fila['pantalla'];
$pantalla = "pantallas/" . $pantalla . ".motor.inc.php";

include $pantalla;

if (isset($_GET['anterior'])) 
{
    $sql = "SELECT * FROM flujo_proceso WHERE flujo = '$flujo' AND proceso_siguiente = '$proceso'";
    $resultado1 = mysqli_query($con, $sql);
    $fila1 = mysqli_fetch_array($resultado1);
    // $proceso = $fila1['proceso'];
    $proceso_siguiente = $fila1['proceso'];
    // echo $proceso_siguiente;
}


header("Location: index.php?flujo=$flujo&proceso=$proceso_siguiente");
?>