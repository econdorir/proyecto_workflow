<?php
session_start();
if (isset($_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['requisitos'])) {
    $_SESSION['fecha_inicio'] = $_POST['fecha_inicio'];
    $_SESSION['fecha_fin'] = $_POST['fecha_fin'];
    $_SESSION['requisitos'] = $_POST['requisitos'];
    header('Location: confirmar_convoc.inc.php');
    exit();
}
?>