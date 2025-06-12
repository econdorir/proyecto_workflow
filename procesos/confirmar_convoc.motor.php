<?php
session_start();
// Aquí normalmente guardarías en la BD...
// Supongamos que insertamos en convocatoria y guardamos ID en session
$_SESSION['convocatoria_id'] = 1;
header('Location: aprobar_convoc.inc.php');
exit();
?>