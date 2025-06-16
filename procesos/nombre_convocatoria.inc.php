<!-- nombre_convocatoria.inc.php -->
<div>
    <h3>Nombre de la Convocatoria</h3>
    <label for="nombre_beca">Ingrese el nombre de la beca:</label>
    <input type="text" name="nombre_beca" id="nombre_beca" value="<?= htmlspecialchars($_SESSION['nombre_beca'] ?? '') ?>">
</div>
