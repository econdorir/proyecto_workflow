<?php
session_start();
include 'conexion.inc.php'; // conexión a workflow_proyecto
include '../conexion.inc.php'; // nueva conexión a sistema_proyecto

$usuario = $_GET['usuario'] ?? '';
$contrasena = $_GET['contrasena'] ?? '';

// Lista de roles y sus respectivas tablas
$roles = [
    'estudiante' => 'estudiante',
    'administrador' => 'administrador',
    'evaluador' => 'evaluador'
];

foreach ($roles as $rol => $tabla) {
    $sql = "SELECT * FROM $tabla WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conexion_sistema, $sql);
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila && password_verify($contrasena, $fila['contrasena'])) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['rol'] = $rol;
        $_SESSION['id'] = $fila['id'];

        if ($rol === 'estudiante') {
            // Obtener número de trámite o asignar uno
            $sqlTramite = "SELECT numero_tramite FROM aplicacion WHERE estudiante_id = {$fila['id']} ORDER BY id DESC LIMIT 1";
            $resTramite = mysqli_query($conexion_sistema, $sqlTramite);
            $app = mysqli_fetch_assoc($resTramite);
            $_SESSION['numero_tramite'] = $app ? $app['numero_tramite'] : (3000 + $fila['id']);
        }

        break;
    }
}
?>
