<?php
session_start();
echo "<h2>Aprobar Convocatoria</h2>";
echo "<form method='POST' action='aprobar_convoc.motor.inc.php'>
        <button type='submit' name='respuesta' value='si'>Sí</button>
        <button type='submit' name='respuesta' value='no'>No</button>
    </form>";
?>