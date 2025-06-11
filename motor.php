<?php
include 'conexion.inc.php';
session_start();

$flujo = $_GET['flujo'] ?? 'F1';
$proceso = $_GET['proceso_anterior'] ?? 'P1';
$proceso_siguiente = $_GET['proceso'] ?? 'P2';
$numero_tramite = $_GET['numero_tramite'] ?? 3001;
$usuario = $_SESSION['usuario'] ?? 'msilva';

// Obtener pantalla del proceso actual
$sql = "SELECT * FROM workflow_proyecto.flujo_proceso WHERE flujo = '$flujo' AND proceso = '$proceso'";
$resultado = mysqli_query($conexion_workflow, $sql);
$fila = mysqli_fetch_array($resultado);

$pantalla_motor = "procesos/" . $fila['pantalla'] . ".motor.inc.php";

// Ejecutar lógica de pantalla
if (file_exists($pantalla_motor)) {
    include $pantalla_motor;
}

// Si se presionó "Atrás", buscar el proceso anterior
if (isset($_GET['anterior'])) {
    $sql = "SELECT * FROM workflow_proyecto.flujo_proceso WHERE flujo = '$flujo' AND proceso_siguiente = '$proceso'";
    $resultado1 = mysqli_query($conexion_workflow, $sql);
    if ($fila1 = mysqli_fetch_array($resultado1)) {
        $proceso_siguiente = $fila1['proceso'];
    }
}

// TODO: agregar condición condicional si el proceso actual tiene bifurcación

header("Location: principal.php?flujo=$flujo&proceso=$proceso_siguiente&numero_tramite=$numero_tramite");
