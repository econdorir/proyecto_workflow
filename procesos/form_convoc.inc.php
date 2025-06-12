<?php
session_start();
echo "<h2>Formulario Convocatoria</h2>";
echo "<form method='POST' action='form_convoc.motor.inc.php'>
        <label>Fecha de inicio: <input type='date' name='fecha_inicio' required></label><br>
        <label>Fecha de fin: <input type='date' name='fecha_fin' required></label><br>
        <label>Requisitos: <textarea name='requisitos' required></textarea></label><br>
        <button type='submit' name='siguiente'>Siguiente</button>
    </form>";
?>