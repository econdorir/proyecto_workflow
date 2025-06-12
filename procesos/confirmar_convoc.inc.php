<?php
session_start();
echo "<h2>Confirmar Convocatoria</h2>";
echo "<p><strong>Nombre:</strong> " . $_SESSION['nombre_convocatoria'] . "</p>";
echo "<p><strong>Inicio:</strong> " . $_SESSION['fecha_inicio'] . "</p>";
echo "<p><strong>Fin:</strong> " . $_SESSION['fecha_fin'] . "</p>";
echo "<p><strong>Requisitos:</strong> " . $_SESSION['requisitos'] . "</p>";
echo "<form method='POST' action='confirmar_convoc.motor.inc.php'>
        <button type='submit' name='confirmar'>Confirmar</button>
    </form>";
?>