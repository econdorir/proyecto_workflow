<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include './conexion.inc.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    $tipo_usuario = $_POST['tipo_usuario'] ?? '';

    // Definir la tabla según el tipo de usuario
    $tablas = [
        'estudiante' => 'estudiante',
        'administrador' => 'administrador',
        'evaluador' => 'evaluador'
    ];

    if (isset($tablas[$tipo_usuario])) {
        $tabla = $tablas[$tipo_usuario];
        $sql = "SELECT * FROM $tabla WHERE usuario = ?";
        $stmt = mysqli_prepare($conexion_sistema, $sql);
        mysqli_stmt_bind_param($stmt, 's', $usuario);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $fila = mysqli_fetch_assoc($res);
        mysqli_stmt_close($stmt);

        if ($fila && password_verify($contrasena, $fila['contrasena'])) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['rol'] = $tipo_usuario;
            $_SESSION['id'] = $fila['id'] ?? null;
            header('Location: bandeja_entrada.php');
            exit;
        }
        $error = 'Usuario o contraseña incorrectos.';
    } else {
        $error = 'Tipo de usuario inválido.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Inicio de Sesión</h2>
    <?php if ($error): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="login.php" method="post" class="login-form">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>

        <label for="tipo_usuario">Tipo de usuario:</label>
        <select name="tipo_usuario" id="tipo_usuario" required>
            <option value="">Seleccione...</option>
            <option value="estudiante">Estudiante</option>
            <option value="administrador">Administrador</option>
            <option value="evaluador">Evaluador</option>
        </select>

        <button type="submit" style="margin-top: 22px;">Iniciar Sesión</button>
    </form>
</div>
</body>
</html>