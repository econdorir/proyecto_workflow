<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../conexion.inc.php';

if (isset($_GET['siguiente'])) {
    $flujo = $_GET['flujo'] ?? 'F1';
    $proceso = $_GET['proceso_anterior'] ?? '';
    $aprobado = $_SESSION['aprobado'] ?? '';
    $proceso_siguiente = null;
    if ($proceso && $flujo) {
        $sql = "SELECT proceso_si, proceso_no FROM flujo_proceso_condicionante WHERE flujo = '$flujo' AND proceso = '$proceso'";
        $res = mysqli_query($conexion_workflow, $sql);
        if ($row = mysqli_fetch_assoc($res)) {
            if ($aprobado === 'si') {
                $proceso_siguiente = $row['proceso_si'];
            } elseif ($aprobado === 'no') {
                $proceso_siguiente = $row['proceso_no'];
            }
        }
    }
    if ($proceso_siguiente) {
        $_SESSION['proximo_proceso'] = $proceso_siguiente;
    }
}

// $_SESSION['camino'] = 
?> 