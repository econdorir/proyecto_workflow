<?php
session_start();
if (isset($_POST['nombre_convocatoria'])) {
    $_SESSION['nombre_convocatoria'] = $_POST['nombre_convocatoria'];
    header('Location: form_convoc.inc.php');
    exit();
}
?>