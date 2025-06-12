<?php
session_start();
echo "<h2>Nombrar Convocatoria</h2>";
echo "<form method='POST' action='nombre_convoc.motor.inc.php'>
        <label>Nombre de la convocatoria: <input type='text' name='nombre_convocatoria' required></label><br>
        <button type='submit' name='siguiente'>Siguiente</button>
    </form>";
?>